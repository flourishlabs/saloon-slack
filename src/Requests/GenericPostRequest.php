<?php

declare(strict_types=1);

namespace FlourishLabs\SaloonSlack\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class GenericPostRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $slackMethod - dot notation, such as `users.info`
     * @param  array  $data - will be converted to JSON
     */
    public function __construct(private string $slackMethod, private array $data = [])
    {
    }

    public function resolveEndpoint(): string
    {
        return $this->slackMethod;
    }

    public function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
        ];
    }

    public function defaultBody(): array
    {
        return $this->data;
    }
}
