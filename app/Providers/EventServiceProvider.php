<?php

declare(strict_types=1);

namespace App\Providers;

use App\Events\TagCreated;
use App\Events\TagUpdated;
use App\Listeners\DispatchTagEmbeddingGeneration;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

final class EventServiceProvider extends ServiceProvider
{
    /**
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        TagCreated::class => [
            DispatchTagEmbeddingGeneration::class,
        ],
        TagUpdated::class => [
            DispatchTagEmbeddingGeneration::class,
        ],
    ];
}
