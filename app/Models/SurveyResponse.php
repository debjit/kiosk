<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

final class SurveyResponse extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'survey_id',
        'customer_id',
        'status',
        'started_at',
        'completed_at',
        'metadata',
    ];

    protected $casts = [
        'survey_id' => 'integer',
        'customer_id' => 'integer',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'metadata' => 'array',
    ];

    public function survey(): BelongsTo
    {
        return $this->belongsTo(Survey::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function surveyAnswers(): HasMany
    {
        return $this->hasMany(SurveyAnswer::class, 'response_id');
    }

    public function customerVector(): HasOne
    {
        return $this->hasOne(CustomerVector::class);
    }
}
