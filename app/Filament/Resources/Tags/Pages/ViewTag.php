<?php

declare(strict_types=1);

namespace App\Filament\Resources\Tags\Pages;

use App\Filament\Resources\Tags\TagResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

final class ViewTag extends ViewRecord
{
    protected static string $resource = TagResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Remove embedding before filling the form
        unset($data['embedding']);

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
