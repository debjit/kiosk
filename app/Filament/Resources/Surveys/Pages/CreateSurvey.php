<?php

declare(strict_types=1);

namespace App\Filament\Resources\Surveys\Pages;

use App\Filament\Resources\Surveys\SurveyResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateSurvey extends CreateRecord
{
    protected static string $resource = SurveyResource::class;
}
