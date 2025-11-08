<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Embedding API Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for the embedding service using OpenAI-compatible API
    | endpoints. Used for generating BAAI BGE-M3 embeddings for tags.
    |
    */

    'api' => [
        'base_url' => env('LLM_API_BASE_URL', 'https://api.openai.com/v1'),
        'api_key' => env('LLM_API_KEY'),
        'model' => env('LLM_MODEL', 'gpt-4.1-mini'),
        'dimensions' => env('LLM_EMBEDDING_DIMENSIONS', 1024),
        'timeout' => env('LLM_REQUEST_TIMEOUT', 30),
        'retries' => env('LLM_REQUEST_RETRIES', 3),
    ],

    /*
    |--------------------------------------------------------------------------
    | Model Definitions
    |--------------------------------------------------------------------------
    |
    | Centralized model configuration for different LLM capabilities.
    |
    */

    'models' => [
        'general' => env('LLM_MODEL', 'gpt-4.1-mini'),
        'embedding' => env('LLM_EMBEDDING_MODEL', 'baai/bge-m3'),
        'audio' => env('LLM_AUDIO_MODEL'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Embedding Service Settings
    |--------------------------------------------------------------------------
    |
    | Additional settings for the embedding service behavior.
    |
    */

    'service' => [
        'cache_embeddings' => env('LLM_EMBEDDING_CACHE_ENABLED', true),
        'cache_ttl' => env('LLM_EMBEDDING_CACHE_TTL', 3600),
        'batch_size' => env('LLM_EMBEDDING_BATCH_SIZE', 10),
    ],
];
