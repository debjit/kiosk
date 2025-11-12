<?php

declare(strict_types=1);

namespace App\Filament\Resources\SurveyQuestions\Pages;

use App\Filament\Resources\SurveyQuestions\SurveyQuestionResource;
use Filament\Resources\Pages\EditRecord;

final class EditSurveyQuestion extends EditRecord
{
    protected static string $resource = SurveyQuestionResource::class;
}
