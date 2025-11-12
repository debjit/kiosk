<?php

declare(strict_types=1);

namespace App\Filament\Resources\Surveys\Relations;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

final class SurveyQuestionsRelationManager extends RelationManager
{
    protected static string $relationship = 'surveyQuestions';

    public function isReadOnly(): bool
    {
        return false;
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->helperText('Maps to preference structure (e.g., style_keywords, occasions, budget_range)'),

                \Filament\Forms\Components\Textarea::make('question_text')
                    ->label('Question Text')
                    ->required()
                    ->rows(3),

                \Filament\Forms\Components\Select::make('type')
                    ->label('Question Type')
                    ->options([
                        'single_choice' => 'Single Choice',
                        'multiple_choice' => 'Multiple Choice',
                        'slider' => 'Slider/Range',
                        'text' => 'Free Text',
                        'tags' => 'Tags',
                    ])
                    ->required(),

                \Filament\Forms\Components\Toggle::make('is_required')
                    ->label('Required')
                    ->default(true),

                \Filament\Forms\Components\TextInput::make('position')
                    ->label('Position')
                    ->numeric()
                    ->default(0)
                    ->helperText('Order of questions in survey'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('question_text')
                    ->label('Question')
                    ->limit(50),
                Tables\Columns\TextColumn::make('type')
                    ->label('Type'),
                Tables\Columns\IconColumn::make('is_required')
                    ->label('Required')
                    ->boolean(),
                Tables\Columns\TextColumn::make('position')
                    ->label('Position')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('position');
    }

    protected function getListeners(): array
    {
        return [
            'open-survey-question-create-modal' => 'create',
        ];
    }
}
