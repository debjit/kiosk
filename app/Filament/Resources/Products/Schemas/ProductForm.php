<?php

declare(strict_types=1);

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

final class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->step(0.01)
                    ->prefix('$')
                    ->suffix('(e.g., 12.99)'),
                Select::make('type_id')
                    ->relationship('type', 'name')
                    ->required(),
                Toggle::make('featured')
                    ->required(),
                Select::make('recommendation_score')
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
                    ->required()
                    ->default(5)
                    ->helperText('Recommendation score from 1-10'),
                TextInput::make('category'),
                TextInput::make('sku')
                    ->label('SKU'),
                TextInput::make('stock_quantity')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
