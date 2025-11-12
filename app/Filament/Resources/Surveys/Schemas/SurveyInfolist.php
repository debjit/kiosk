<?php

declare(strict_types=1);

namespace App\Filament\Resources\Surveys\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

final class SurveyInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('slug')
                    ->label('Slug'),
                TextEntry::make('title')
                    ->label('Title'),
                TextEntry::make('description')
                    ->label('Description')
                    ->columnSpanFull(),
                IconEntry::make('is_active')
                    ->label('Active')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->label('Created')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->label('Updated')
                    ->dateTime(),
            ]);
    }
}
