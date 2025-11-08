<?php

declare(strict_types=1);

namespace App\Events;

final readonly class TagUpdated
{
    public function __construct(
        public int $tagId,
    ) {}
}
