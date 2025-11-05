<?php

declare(strict_types=1);

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

final class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('price')
                    ->money()
                    ->sortable(),
                TextColumn::make('type.name')
                    ->searchable(),
                IconColumn::make('featured')
                    ->boolean(),
                TextColumn::make('recommendation_score')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('category')
                    ->searchable(),
                TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable(),
                TextColumn::make('stock_quantity')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('featured')
                    ->label('Featured Products'),
                TernaryFilter::make('is_active')
                    ->label('Active Products'),
                SelectFilter::make('type')
                    ->relationship('type', 'name')
                    ->label('Product Type'),
                SelectFilter::make('recommendation_score')
                    ->options([
                        1 => '1 - Poor',
                        2 => '2 - Below Average',
                        3 => '3 - Average',
                        4 => '4 - Good',
                        5 => '5 - Very Good',
                        6 => '6 - Excellent',
                        7 => '7 - Outstanding',
                        8 => '8 - Exceptional',
                        9 => '9 - Superior',
                        10 => '10 - Perfect',
                    ])
                    ->label('Recommendation Score'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
