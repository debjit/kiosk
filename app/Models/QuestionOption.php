<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class QuestionOption extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $table = 'question_options';

    protected $fillable = [
        'survey_question_id',
        'label',
        'value',
        'position',
        'metadata',
    ];

    protected $casts = [
        'survey_question_id' => 'integer',
        'position' => 'integer',
        'metadata' => 'array',
    ];

    public function surveyQuestion(): BelongsTo
    {
        return $this->belongsTo(SurveyQuestion::class, 'survey_question_id');
    }

    public function surveyAnswers(): HasMany
    {
        return $this->hasMany(SurveyAnswer::class, 'question_option_id');
    }
}
