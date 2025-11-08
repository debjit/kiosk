<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\Tag;
use App\Services\EmbeddingService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

final class GenerateTagEmbeddingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public int $tagId,
    ) {}

    public function handle(): void
    {
        $tag = Tag::query()->find($this->tagId);

        if (! $tag) {
            return;
        }

        $text = trim($tag->name.($tag->description ? ' '.$tag->description : ''));

        if ($text === '') {
            return;
        }

        $embedding = app(EmbeddingService::class)->generateEmbedding($text);

        if ($embedding !== null) {
            $tag->update([
                'embedding' => $embedding,
            ]);
        }
    }
}
