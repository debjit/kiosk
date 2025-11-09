<?php

declare(strict_types=1);

namespace App\Services\Integrations\Ai\OpenAI\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

final class GenerateEmbeddingsRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        private array $texts,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/embeddings';
    }

    protected function defaultBody(): array
    {
        return [
            'model' => config('ai.models.embedding'),
            'input' => $this->texts,
            // 'encoding_format' => 'float',
        ];
    }
}
