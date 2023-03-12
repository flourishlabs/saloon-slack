<?php

declare(strict_types=1);

namespace FlourishLabs\SaloonSlack\Requests;

class UsersInfoRequest extends GenericGetRequest
{
    public function __construct(private readonly string $slackUserId)
    {
    }

    public function resolveEndpoint(): string
    {
        return 'users.info';
    }

    public function defaultQuery(): array
    {
        return ['user' => $this->slackUserId];
    }
}
