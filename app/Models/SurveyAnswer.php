<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class SurveyAnswer extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'response_id',
        'question_id',
        'question_option_id',
        'value_text',
        'value_number',
        'value_json',
    ];

    protected $casts = [
        'response_id' => 'integer',
        'question_id' => 'integer',
        'question_option_id' => 'integer',
        'value_number' => 'decimal:2',
        'value_json' => 'array',
    ];

    public function surveyResponse(): BelongsTo
    {
        return $this->belongsTo(SurveyResponse::class, 'response_id');
    }

    public function surveyQuestion(): BelongsTo
    {
        return $this->belongsTo(SurveyQuestion::class, 'question_id');
    }

    public function questionOption(): BelongsTo
    {
        return $this->belongsTo(QuestionOption::class, 'question_option_id');
    }
}
