<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\SurveyResponse;

final readonly class BuildSurveyPreferencesAction
{
    /**
     * Build a normalized structure of all survey questions and answers for AI processing.
     *
     * @return array{
     *     survey_id: int,
     *     customer_id: int,
     *     answers: array<int, array{
     *         question_id: int,
     *         question: string,
     *         type: string,
     *         options: array<string>|null,
     *         value: string|float|null
     *     }>
     * }
     */
    public function handle(SurveyResponse $surveyResponse): array
    {
        $answers = $surveyResponse->surveyAnswers()
            ->with(['surveyQuestion', 'surveyOption'])
            ->get();

        $normalizedAnswers = [];

        foreach ($answers as $answer) {
            $question = $answer->surveyQuestion;

            if ($question === null) {
                continue;
            }

            $options = null;

            if ($answer->surveyOption) {
                $options = [$answer->surveyOption->value];
            }

            $value = $answer->value_text ?? $answer->value_number ?? null;

            $normalizedAnswers[] = [
                'question_id' => $question->id,
                'question' => $question->title,
                'type' => (string) $question->type,
                'options' => $options,
                'value' => $value,
            ];
        }

        return [
            'survey_id' => $surveyResponse->survey_id,
            'customer_id' => $surveyResponse->customer_id,
            'answers' => $normalizedAnswers,
        ];
    }
}
