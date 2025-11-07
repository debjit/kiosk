<?php

declare(strict_types=1);

namespace App\Enums;

enum ProductCategory: string
{
    case Gold = 'gold';
    case Silver = 'silver';
    case Platinum = 'platinum';
    case Diamond = 'diamond';
    case Gemstone = 'gemstone';

    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $case): array => [$case->value => $case->getLabel()])
            ->all();
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::Gold => 'Gold',
            self::Silver => 'Silver',
            self::Platinum => 'Platinum',
            self::Diamond => 'Diamond',
            self::Gemstone => 'Gemstone',
        };
    }
}
