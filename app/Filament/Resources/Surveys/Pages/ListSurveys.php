<?php

declare(strict_types=1);

namespace App\Filament\Resources\Surveys\Pages;

use App\Filament\Resources\Surveys\SurveyResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListSurveys extends ListRecords
{
    protected static string $resource = SurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
