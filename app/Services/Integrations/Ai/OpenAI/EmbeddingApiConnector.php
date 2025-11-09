<?php

declare(strict_types=1);

namespace App\Services\Integration\Ai\OpenAI;

use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;

final class EmbeddingApiConnector extends Connector
{
    use AcceptsJson;

    public function resolveBaseUrl(): string
    {
        return config('ai.api.base_url');
    }

    protected function defaultHeaders(): array
    {
        return [
            'Authorization' => 'Bearer '.$this->getApiToken(),
            'Content-Type' => 'application/json',
        ];
    }

    protected function defaultConfig(): array
    {
        return [
            'timeout' => config('ai.api.timeout'),
        ];
    }

    private function getApiToken(): string
    {
        return config('ai.api.api_key');
    }
}
