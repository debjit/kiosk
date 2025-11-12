<?php

declare(strict_types=1);

namespace App\Filament\Resources\Surveys\Pages;

use App\Filament\Resources\Surveys\SurveyResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

final class ViewSurvey extends ViewRecord
{
    protected static string $resource = SurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
