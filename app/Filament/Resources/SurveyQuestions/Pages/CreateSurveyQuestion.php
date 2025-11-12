<?php

declare(strict_types=1);

namespace App\Filament\Resources\SurveyQuestions\Pages;

use App\Filament\Resources\SurveyQuestions\SurveyQuestionResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateSurveyQuestion extends CreateRecord
{
    protected static string $resource = SurveyQuestionResource::class;
}
