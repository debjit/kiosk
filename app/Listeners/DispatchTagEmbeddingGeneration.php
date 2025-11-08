<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\TagCreated;
use App\Events\TagUpdated;
use App\Jobs\GenerateTagEmbeddingJob;
use Illuminate\Contracts\Queue\ShouldQueue;

final class DispatchTagEmbeddingGeneration implements ShouldQueue
{
    public function handle(TagCreated|TagUpdated $event): void
    {
        dispatch(new GenerateTagEmbeddingJob($event->tagId));
    }
}
