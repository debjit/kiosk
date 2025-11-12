<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Customer;
use App\Models\CustomerVector;
use App\Models\SurveyResponse;
use App\Models\Tag;
use App\Services\EmbeddingService;
use Illuminate\Support\Facades\DB;
use RuntimeException;

final readonly class GenerateCustomerVectorAction
{
    public function __construct(
        private EmbeddingService $embeddingService,
    ) {}

    /**
     * Generate and store customer vector from survey response, normalized survey data, and selected tags.
     *
     * @param array{
     *     survey_id: int,
     *     customer_id: int,
     *     answers: array<int, array{
     *         question_id: int,
     *         question: string,
     *         type: string,
     *         options: array<string>|null,
     *         value: string|float|null
     *     }>
     * } $normalizedSurvey
     * @param  array<int, int|string>  $selectedTagIds
     */
    public function handle(SurveyResponse $surveyResponse, array $normalizedSurvey, array $selectedTagIds): CustomerVector
    {
        return DB::transaction(function () use ($surveyResponse, $normalizedSurvey, $selectedTagIds) {
            $customerText = $this->buildCustomerText($normalizedSurvey, $selectedTagIds);

            $embedding = $this->embeddingService->generateEmbedding($customerText);

            throw_if($embedding === null, RuntimeException::class, 'Failed to generate embedding for customer preferences');

            return CustomerVector::query()->create([
                'customer_id' => $surveyResponse->customer_id,
                'survey_response_id' => $surveyResponse->id,
                'style_vector' => $embedding,
                'metadata' => [
                    'customer_text' => $customerText,
                    'survey' => $normalizedSurvey,
                    'selected_tag_ids' => $selectedTagIds,
                    'generated_at' => now()->toISOString(),
                ],
            ]);
        });
    }

    /**
     * Build customer text representation from normalized survey answers and selected tags.
     */
    private function buildCustomerText(array $normalizedSurvey, array $selectedTagIds): string
    {
        $parts = [];

        $parts[] = sprintf(
            'Survey response for customer %d (survey %d).',
            $normalizedSurvey['customer_id'],
            $normalizedSurvey['survey_id'],
        );

        foreach ($normalizedSurvey['answers'] as $answer) {
            $segment = $answer['question'].': ';

            if (! empty($answer['options'])) {
                $segment .= implode(', ', $answer['options']);
            } elseif ($answer['value'] !== null) {
                $segment .= (string) $answer['value'];
            } else {
                $segment .= 'no answer';
            }

            $parts[] = $segment;
        }

        if ($selectedTagIds !== []) {
            $tags = Tag::query()
                ->whereIn('id', $selectedTagIds)
                ->pluck('name')
                ->all();

            if (! empty($tags)) {
                $parts[] = 'Selected preference tags: '.implode(', ', $tags);
            }
        }

        return implode(' ', $parts);
    }
}
