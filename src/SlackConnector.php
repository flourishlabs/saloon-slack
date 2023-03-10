<?php

declare(strict_types=1);

namespace FlourishLabs\SaloonSlack;

use FlourishLabs\SaloonSlack\Requests\GenericGetRequest;
use FlourishLabs\SaloonSlack\Requests\GenericPostRequest;
use FlourishLabs\SaloonSlack\Responses\SlackResponse;
use Saloon\Contracts\Response;
use Saloon\Http\Connector;

class SlackConnector extends Connector
{
    protected ?string $response = SlackResponse::class;

    public function __construct(private readonly string $token)
    {
        $this->withTokenAuth($this->token);
    }

    /**
     * View all available methods here: https://api.slack.com/methods
     */
    public function resolveBaseUrl(): string
    {
        return 'https://slack.com/api/';
    }

    /**
     * @param  string  $slackMethod - Dot notation, e.g. 'users.info'
     * @param  array  $data - Array of key value pairs to be converted to form-urlencoded
     *
     * @throws \ReflectionException
     * @throws \Saloon\Exceptions\InvalidResponseClassException
     * @throws \Saloon\Exceptions\PendingRequestException
     */
    public function get(string $slackMethod, array $data = []): Response
    {
        return $this->send(new GenericGetRequest($slackMethod, $data));
    }

    /**
     * @param  string  $slackMethod - Dot notation, e.g. 'users.info'
     * @param  array  $data - Array of key value pairs to pass as JSON
     *
     * @throws \ReflectionException
     * @throws \Saloon\Exceptions\InvalidResponseClassException
     * @throws \Saloon\Exceptions\PendingRequestException
     */
    public function post(string $slackMethod, array $data = []): Response
    {
        return $this->send(new GenericPostRequest($slackMethod, $data));
    }
}
