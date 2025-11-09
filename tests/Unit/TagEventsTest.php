<?php

declare(strict_types=1);

use App\Events\TagCreated;
use App\Events\TagUpdated;
use App\Jobs\GenerateTagEmbeddingJob;
use App\Listeners\DispatchTagEmbeddingGeneration;
use Illuminate\Support\Facades\Queue;

// Test basic event and job creation without database
test('TagCreated event can be instantiated', function (): void {
    $event = new TagCreated(1);
    expect($event->tagId)->toBe(1);
});

test('TagUpdated event can be instantiated', function (): void {
    $event = new TagUpdated(2);
    expect($event->tagId)->toBe(2);
});

test('GenerateTagEmbeddingJob can be instantiated', function (): void {
    $job = new GenerateTagEmbeddingJob(3);
    expect($job->tagId)->toBe(3);
});

test('DispatchTagEmbeddingGeneration listener handles TagCreated', function (): void {
    Queue::fake();

    $listener = new DispatchTagEmbeddingGeneration();
    $event = new TagCreated(4);

    $listener->handle($event);

    Queue::assertPushed(GenerateTagEmbeddingJob::class, fn ($job): bool => $job->tagId === 4);
});

test('DispatchTagEmbeddingGeneration listener handles TagUpdated', function (): void {
    Queue::fake();

    $listener = new DispatchTagEmbeddingGeneration();
    $event = new TagUpdated(5);

    $listener->handle($event);

    Queue::assertPushed(GenerateTagEmbeddingJob::class, fn ($job): bool => $job->tagId === 5);
});
