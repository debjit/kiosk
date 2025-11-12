<?php

declare(strict_types=1);

namespace App\Filament\Resources\SurveyQuestions\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class SurveyQuestionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('survey.title')
                    ->label('Survey')
                    ->sortable(),
                TextColumn::make('title')
                    ->label('Title')
                    ->searchable(),
                TextColumn::make('question_text')
                    ->label('Question')
                    ->limit(50),
                TextColumn::make('type')
                    ->label('Type'),
                TextColumn::make('position')
                    ->label('Position')
                    ->sortable(),
            ])
            ->defaultSort('position');
    }
}
