<?php

declare(strict_types=1);

namespace App\Filament\Resources\SurveyQuestions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

final class SurveyQuestionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('survey.title')
                    ->label('Survey'),
                TextEntry::make('title')
                    ->label('Title'),
                TextEntry::make('question_text')
                    ->label('Question Text'),
                TextEntry::make('type')
                    ->label('Type'),
                TextEntry::make('position')
                    ->label('Position'),
            ]);
    }
}
