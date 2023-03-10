<?php

declare(strict_types=1);

namespace FlourishLabs\SaloonSlack\Requests;

use Saloon\Contracts\Body\HasBody as HasBodyContract;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasFormBody;

class GenericGetRequest extends Request implements HasBodyContract
{
    use HasFormBody;

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


    public function defaultBody(): array
    {
        return $this->data;
    }
}
