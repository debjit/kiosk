<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\SurveyQuestionType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class SurveyQuestion extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'survey_id',
        'title',
        'question_text',
        'type',
        'is_required',
        'position',
        'metadata',
    ];

    protected $casts = [
        'survey_id' => 'integer',
        'is_required' => 'boolean',
        'position' => 'integer',
        'metadata' => 'array',
        'type' => SurveyQuestionType::class,
    ];

    public function survey(): BelongsTo
    {
        return $this->belongsTo(Survey::class);
    }

    public function questionOptions(): HasMany
    {
        return $this->hasMany(QuestionOption::class, 'survey_question_id')->orderBy('position');
    }

    public function surveyAnswers(): HasMany
    {
        return $this->hasMany(SurveyAnswer::class);
    }
}
