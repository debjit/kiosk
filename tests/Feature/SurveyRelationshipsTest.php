<?php

declare(strict_types=1);

use App\Models\Customer;
use App\Models\Survey;
use App\Models\SurveyAnswer;
use App\Models\SurveyOption;
use App\Models\SurveyQuestion;
use App\Models\SurveyResponse;

test('customer has many survey responses', function (): void {
    $customer = Customer::factory()->create();
    $survey = Survey::factory()->create();

    $response1 = SurveyResponse::factory()->create([
        'customer_id' => $customer->id,
        'survey_id' => $survey->id,
    ]);
    $response2 = SurveyResponse::factory()->create([
        'customer_id' => $customer->id,
        'survey_id' => $survey->id,
    ]);

    expect($customer->surveyResponses)->toHaveCount(2);
    expect($customer->surveyResponses->pluck('id'))->toContain($response1->id, $response2->id);
});

test('survey has many survey responses', function (): void {
    $survey = Survey::factory()->create();
    $customer = Customer::factory()->create();

    $response1 = SurveyResponse::factory()->create([
        'survey_id' => $survey->id,
        'customer_id' => $customer->id,
    ]);
    $response2 = SurveyResponse::factory()->create([
        'survey_id' => $survey->id,
        'customer_id' => $customer->id,
    ]);

    expect($survey->surveyResponses)->toHaveCount(2);
    expect($survey->surveyResponses->pluck('id'))->toContain($response1->id, $response2->id);
});

test('survey response belongs to customer and survey', function (): void {
    $customer = Customer::factory()->create();
    $survey = Survey::factory()->create();

    $response = SurveyResponse::factory()->create([
        'customer_id' => $customer->id,
        'survey_id' => $survey->id,
    ]);

    expect($response->customer->id)->toBe($customer->id);
    expect($response->survey->id)->toBe($survey->id);
});

test('survey response has many survey answers', function (): void {
    $customer = Customer::factory()->create();
    $survey = Survey::factory()->create();
    $response = SurveyResponse::factory()->create([
        'customer_id' => $customer->id,
        'survey_id' => $survey->id,
    ]);

    $question = SurveyQuestion::factory()->create(['survey_id' => $survey->id]);
    $option = SurveyOption::factory()->create(['question_id' => $question->id]);

    $answer1 = SurveyAnswer::factory()->create([
        'response_id' => $response->id,
        'question_id' => $question->id,
        'option_id' => $option->id,
    ]);
    $answer2 = SurveyAnswer::factory()->create([
        'response_id' => $response->id,
        'question_id' => $question->id,
        'option_id' => $option->id,
    ]);

    expect($response->surveyAnswers)->toHaveCount(2);
    expect($response->surveyAnswers->pluck('id'))->toContain($answer1->id, $answer2->id);
});

test('survey answer belongs to survey response, question, and option', function (): void {
    $customer = Customer::factory()->create();
    $survey = Survey::factory()->create();
    $response = SurveyResponse::factory()->create([
        'customer_id' => $customer->id,
        'survey_id' => $survey->id,
    ]);
    $question = SurveyQuestion::factory()->create(['survey_id' => $survey->id]);
    $option = SurveyOption::factory()->create(['question_id' => $question->id]);

    $answer = SurveyAnswer::factory()->create([
        'response_id' => $response->id,
        'question_id' => $question->id,
        'option_id' => $option->id,
    ]);

    expect($answer->surveyResponse->id)->toBe($response->id);
    expect($answer->surveyQuestion->id)->toBe($question->id);
    expect($answer->surveyOption->id)->toBe($option->id);
});

test('survey question has many survey options ordered by position', function (): void {
    $survey = Survey::factory()->create();
    $question = SurveyQuestion::factory()->create(['survey_id' => $survey->id]);

    $option1 = SurveyOption::factory()->create([
        'question_id' => $question->id,
        'position' => 2,
    ]);
    $option2 = SurveyOption::factory()->create([
        'question_id' => $question->id,
        'position' => 1,
    ]);

    $options = $question->surveyOptions;
    expect($options)->toHaveCount(2);
    expect($options->first()->id)->toBe($option2->id); // position 1 first
    expect($options->last()->id)->toBe($option1->id);  // position 2 last
});
