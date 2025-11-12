<?php

declare(strict_types=1);

use App\Actions\BuildSurveyPreferencesAction;
use App\Actions\GenerateCustomerVectorAction;
use App\Models\Customer;
use App\Models\Survey;
use App\Models\SurveyAnswer;
use App\Models\SurveyOption;
use App\Models\SurveyQuestion;
use App\Models\SurveyResponse;
use App\Services\EmbeddingService;

test('build survey preferences action extracts preferences from answers', function (): void {
    $customer = Customer::factory()->create();
    $survey = Survey::factory()->create();
    $response = SurveyResponse::factory()->create([
        'customer_id' => $customer->id,
        'survey_id' => $survey->id,
    ]);

    // Create questions
    $styleQuestion = SurveyQuestion::factory()->create([
        'survey_id' => $survey->id,
        'title' => 'style_keywords',
    ]);
    $occasionQuestion = SurveyQuestion::factory()->create([
        'survey_id' => $survey->id,
        'title' => 'occasions',
    ]);
    $budgetQuestion = SurveyQuestion::factory()->create([
        'survey_id' => $survey->id,
        'title' => 'budget_range',
    ]);

    // Create options
    $elegantOption = SurveyOption::factory()->create([
        'question_id' => $styleQuestion->id,
        'value' => 'elegant',
    ]);
    $partyOption = SurveyOption::factory()->create([
        'question_id' => $occasionQuestion->id,
        'value' => 'parties',
    ]);

    // Create answers
    SurveyAnswer::factory()->create([
        'response_id' => $response->id,
        'question_id' => $styleQuestion->id,
        'option_id' => $elegantOption->id,
    ]);
    SurveyAnswer::factory()->create([
        'response_id' => $response->id,
        'question_id' => $occasionQuestion->id,
        'option_id' => $partyOption->id,
    ]);
    SurveyAnswer::factory()->create([
        'response_id' => $response->id,
        'question_id' => $budgetQuestion->id,
        'value_number' => 250000.00,
    ]);

    $action = new BuildSurveyPreferencesAction();
    $preferences = $action->handle($response);

    expect($preferences)->toBe([
        'style_keywords' => ['elegant'],
        'occasions' => ['parties'],
        'budget_range' => 250000.0,
        'material_preferences' => [],
        'celebrity_inspiration' => null,
        'frequency' => null,
    ]);
});

test('generate customer vector action creates vector from preferences', function (): void {
    $customer = Customer::factory()->create();
    $survey = Survey::factory()->create();
    $response = SurveyResponse::factory()->create([
        'customer_id' => $customer->id,
        'survey_id' => $survey->id,
    ]);

    $preferences = [
        'style_keywords' => ['elegant', 'minimal'],
        'occasions' => ['parties'],
        'budget_range' => 250000.0,
        'material_preferences' => ['gold'],
        'celebrity_inspiration' => 'Deepika Padukone',
        'frequency' => 'often',
    ];

    // Mock the embedding service
    $mockEmbedding = [0.1, 0.2, 0.3]; // Simplified for testing
    $embeddingService = Mockery::mock(EmbeddingService::class);
    $embeddingService->shouldReceive('generateEmbedding')
        ->once()
        ->andReturn($mockEmbedding);

    $action = new GenerateCustomerVectorAction($embeddingService);
    $vector = $action->handle($response, $preferences);

    expect($vector->customer_id)->toBe($customer->id);
    expect($vector->survey_response_id)->toBe($response->id);
    expect($vector->style_vector)->toBe($mockEmbedding);
    expect($vector->metadata)->toHaveKey('customer_text');
    expect($vector->metadata)->toHaveKey('preferences');
    expect($vector->metadata['customer_text'])->toContain('style preferences: elegant, minimal');
    expect($vector->metadata['customer_text'])->toContain('budget range: ₹250,000');
});

test('generate customer vector action throws exception on embedding failure', function (): void {
    $customer = Customer::factory()->create();
    $survey = Survey::factory()->create();
    $response = SurveyResponse::factory()->create([
        'customer_id' => $customer->id,
        'survey_id' => $survey->id,
    ]);

    $normalizedSurvey = [
        'survey_id' => $survey->id,
        'customer_id' => $customer->id,
        'answers' => [
            [
                'question_id' => 1,
                'question' => 'What styles do you like?',
                'type' => 'multi_select',
                'options' => ['elegant'],
                'value' => null,
            ],
        ],
    ];

    $selectedTagIds = [1];

    // Mock the embedding service to return null (failure)
    $embeddingService = Mockery::mock(EmbeddingService::class);
    $embeddingService->shouldReceive('generateEmbedding')
        ->once()
        ->andReturn(null);

    $action = new GenerateCustomerVectorAction($embeddingService);

    expect(fn (): App\Models\CustomerVector => $action->handle($response, $normalizedSurvey, $selectedTagIds))
        ->toThrow(RuntimeException::class, 'Failed to generate embedding for customer preferences');
});
