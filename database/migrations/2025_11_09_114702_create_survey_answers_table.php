<?php

declare(strict_types=1);

use App\Models\QuestionOption;
use App\Models\SurveyQuestion;
use App\Models\SurveyResponse;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('survey_answers', function (Blueprint $table): void {
            $table->id();

            $table->foreignIdFor(SurveyResponse::class, 'response_id')
                ->constrained('survey_responses')
                ->cascadeOnDelete();

            $table->foreignIdFor(SurveyQuestion::class, 'question_id')
                ->constrained('survey_questions')
                ->cascadeOnDelete();

            $table->foreignIdFor(QuestionOption::class, 'question_option_id')
                ->nullable()
                ->constrained('question_options')
                ->cascadeOnDelete();

            $table->text('value_text')->nullable();
            $table->decimal('value_number', 10, 2)->nullable();
            $table->json('value_json')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('survey_answers');
    }
};
