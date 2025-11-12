<?php

declare(strict_types=1);

namespace App\Filament\Resources\Surveys\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

final class SurveyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->helperText('Unique identifier for the survey (e.g., evol-style-v1)'),

                TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->helperText('Display name for the survey'),

                Textarea::make('description')
                    ->label('Description')
                    ->rows(3)
                    ->helperText('Optional description of the survey'),

                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true)
                    ->helperText('Whether this survey is available for responses'),
            ]);
    }
}
