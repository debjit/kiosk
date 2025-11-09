<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\Integration\Ai\OpenAI\EmbeddingApiConnector;
use App\Services\Integrations\Ai\OpenAI\Requests\GenerateEmbeddingsRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;

final readonly class EmbeddingService
{
    public function __construct(
        private EmbeddingApiConnector $connector,
    ) {}

    /**
     * Generate embeddings for the given texts.
     *
     * @param  array<string>  $texts
     * @return array<array<float>>|null
     */
    public function generateEmbeddings(array $texts): ?array
    {
        if ($texts === []) {
            return null;
        }

        // Check cache first if enabled
        if (config('ai.service.cache_embeddings')) {
            $cacheKey = $this->getCacheKey($texts);
            $cached = Cache::get($cacheKey);
            if ($cached !== null) {
                return $cached;
            }
        }

        try {
            $request = new GenerateEmbeddingsRequest($texts);
            $response = $this->connector->send($request);

            if (! $response->successful()) {
                Log::warning('Embedding API request failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return null;
            }

            $data = $response->json();
            $embeddings = $this->extractEmbeddings($data);

            // Cache the result if enabled
            if (config('ai.service.cache_embeddings') && $embeddings !== null) {
                Cache::put(
                    $this->getCacheKey($texts),
                    $embeddings,
                    config('ai.service.cache_ttl')
                );
            }

            return $embeddings;

        } catch (FatalRequestException|RequestException $e) {
            Log::error('Embedding API request exception', [
                'exception' => $e->getMessage(),
                'texts_count' => count($texts),
            ]);

            return null;
        }
    }

    /**
     * Generate a single embedding for the given text.
     *
     * @return array<float>|null
     */
    public function generateEmbedding(string $text): ?array
    {
        $embeddings = $this->generateEmbeddings([$text]);

        return $embeddings !== null && $embeddings !== [] ? $embeddings[0] : null;
    }

    /**
     * Extract embeddings from API response.
     *
     * @return array<array<float>>|null
     */
    private function extractEmbeddings(array $data): ?array
    {
        if (! isset($data['data']) || ! is_array($data['data'])) {
            Log::warning('Invalid embedding API response structure', ['data' => $data]);

            return null;
        }

        $embeddings = [];
        foreach ($data['data'] as $item) {
            if (isset($item['embedding']) && is_array($item['embedding'])) {
                $embeddings[] = $item['embedding'];
            }
        }

        return $embeddings;
    }

    /**
     * Generate cache key for texts.
     *
     * @param  array<string>  $texts
     */
    private function getCacheKey(array $texts): string
    {
        return 'embedding:'.config('ai.models.embedding').':'.md5(implode('|', $texts));
    }
}
