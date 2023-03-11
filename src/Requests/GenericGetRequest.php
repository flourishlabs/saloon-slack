<?php

declare(strict_types=1);

namespace FlourishLabs\SaloonSlack\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GenericGetRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * @param  string  $slackMethod - dot notation, such as `users.info`
     */
    public function __construct(private string $slackMethod, private array $data = [])
    {
    }

    public function resolveEndpoint(): string
    {
        return $this->slackMethod;
    }

    public function defaultQuery(): array
    {
        return $this->data;
    }
}
