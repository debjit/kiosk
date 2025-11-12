<?php

declare(strict_types=1);

namespace App\Filament\Resources\SurveyResponses;

use App\Actions\BuildSurveyPreferencesAction;
use App\Actions\GenerateCustomerVectorAction;
use App\Filament\Resources\SurveyResponses\Pages\ListSurveyResponses;
use App\Filament\Resources\SurveyResponses\Pages\ViewSurveyResponse;
use App\Models\SurveyResponse;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

final class SurveyResponseResource extends Resource
{
    protected static ?string $model = SurveyResponse::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static string|UnitEnum|null $navigationGroup = 'Surveys';

    protected static ?int $navigationSort = 4;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('customer.name')
                    ->label('Customer')
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('survey.title')
                    ->label('Survey'),
                \Filament\Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'completed' => 'success',
                        'in_progress' => 'warning',
                        'aborted' => 'danger',
                        default => 'gray',
                    }),
                \Filament\Tables\Columns\TextColumn::make('completed_at')
                    ->label('Completed')
                    ->dateTime()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('customerVector.id')
                    ->label('Vector Generated')
                    ->badge()
                    ->formatStateUsing(fn ($state): string => $state ? 'Yes' : 'No')
                    ->color(fn ($state): string => $state ? 'success' : 'warning'),
            ])
            ->recordActions([
                Action::make('generate_vector')
                    ->label('Generate Vector')
                    ->icon('heroicon-o-sparkles')
                    ->color('success')
                    ->visible(fn (SurveyResponse $record): bool => $record->status === 'completed' && ! $record->customerVector)
                    ->action(function (SurveyResponse $record): void {
                        $preferencesAction = new BuildSurveyPreferencesAction();
                        $preferences = $preferencesAction->handle($record);

                        $vectorAction = app(GenerateCustomerVectorAction::class);
                        $vectorAction->handle($record, $preferences);
                    })
                    ->successNotificationTitle('Vector generated successfully'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSurveyResponses::route('/'),
            'view' => ViewSurveyResponse::route('/{record}'),
        ];
    }
}
