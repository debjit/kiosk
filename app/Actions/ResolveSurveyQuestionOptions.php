<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\SurveyQuestionType;
use App\Models\ProductType;
use App\Models\QuestionOption;
use App\Models\SurveyQuestion;

final readonly class ResolveSurveyQuestionOptions
{
    /**
     * @return list<array{label: string, value: string}>
     */
    public function handle(SurveyQuestion $question): array
    {
        return match ($question->type) {
            SurveyQuestionType::ProductTypeSelect => $this->fromProductTypes(),
            default => $this->fromQuestionOptions($question),
        };
    }

    /**
     * @return list<array{label: string, value: string}>
     */
    private function fromProductTypes(): array
    {
        return ProductType::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get()
            ->map(static fn (ProductType $type): array => [
                'label' => $type->name,
                'value' => $type->slug,
            ])
            ->values()
            ->all();
    }

    /**
     * @return list<array{label: string, value: string}>
     */
    private function fromQuestionOptions(SurveyQuestion $question): array
    {
        return $question->questionOptions
            ->map(static function (QuestionOption $option): array {
                $value = $option->value ?: $option->label;

                return [
                    'label' => $option->label,
                    'value' => (string) $value,
                ];
            })
            ->values()
            ->all();
    }
}
