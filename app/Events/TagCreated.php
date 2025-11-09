<?php

declare(strict_types=1);

namespace App\Events;

final readonly class TagCreated
{
    public function __construct(
        public int $tagId,
    ) {}
}
