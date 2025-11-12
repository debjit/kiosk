<?php

declare(strict_types=1);

namespace App\Filament\Resources\SurveyQuestions\Schemas;

use App\Enums\SurveyQuestionType;
use App\Models\Survey;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

final class SurveyQuestionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('survey_id')
                    ->label('Survey')
                    ->options(Survey::query()->pluck('title', 'id'))
                    ->required()
                    ->searchable(),

                TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->helperText('Human readable title used as the unique question identifier per survey'),

                Textarea::make('question_text')
                    ->label('Question Text')
                    ->required()
                    ->rows(3)
                    ->helperText('The question shown to the user.'),

                Select::make('type')
                    ->label('Question Type')
                    ->options(SurveyQuestionType::options())
                    ->required(),

                Repeater::make('questionOptions')
                    ->label('Options')
                    ->relationship('questionOptions')
                    ->schema([
                        TextInput::make('label')
                            ->label('Label')
                            ->required(),
                        TextInput::make('value')
                            ->label('Value')
                            ->helperText('Optional machine value. Defaults to label if left empty.')
                            ->nullable(),
                        TextInput::make('position')
                            ->label('Position')
                            ->numeric()
                            ->default(0),
                    ])
                    ->orderColumn('position')
                    ->collapsed()
                    ->addActionLabel('Add option')
                    ->visible(fn (callable $get): bool => in_array($get('type'), [
                        SurveyQuestionType::SingleChoice->value,
                        SurveyQuestionType::MultipleChoice->value,
                        'multiple_selection',
                    ], true)),

                Toggle::make('is_required')
                    ->label('Required')
                    ->default(true),

                TextInput::make('position')
                    ->label('Position')
                    ->numeric()
                    ->default(0)
                    ->helperText('Order of questions in survey'),
            ]);
    }
}
