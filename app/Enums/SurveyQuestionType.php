<?php

declare(strict_types=1);

namespace App\Enums;

enum SurveyQuestionType: string
{
    case SingleChoice = 'single_choice';
    case MultipleChoice = 'multiple_choice';
    case Slider = 'slider';
    case Text = 'text';
    case Tags = 'tags';
    case ProductTypeSelect = 'product_type_select';

    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        $options = [];

        foreach (self::cases() as $case) {
            $options[$case->value] = $case->label();
        }

        return $options;
    }

    public function label(): string
    {
        return match ($this) {
            self::SingleChoice => 'Single Choice',
            self::MultipleChoice => 'Multiple Choice',
            self::Slider => 'Slider / Range',
            self::Text => 'Free Text',
            self::Tags => 'Tags',
            self::ProductTypeSelect => 'Product Types',
        };
    }
}
