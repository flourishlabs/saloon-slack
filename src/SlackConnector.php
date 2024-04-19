<?php

declare(strict_types=1);

namespace FlourishLabs\SaloonSlack;

use FlourishLabs\SaloonSlack\Requests\GenericGetRequest;
use FlourishLabs\SaloonSlack\Requests\GenericPostRequest;
use FlourishLabs\SaloonSlack\Requests\UsersInfoRequest;
use FlourishLabs\SaloonSlack\Responses\SlackResponse;
use Saloon\Http\Connector;
use Saloon\Http\Response;

class SlackConnector extends Connector
{
    protected ?string $response = SlackResponse::class;

    public function __construct(private string $token)
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

    public function usersInfo(string $slackUserId): Response
    {
        return $this->send(new UsersInfoRequest($slackUserId));
    }

    public function simpleMessage(string $channel, string $message): Response
    {
        return $this->post('chat.postMessage', [
            'channel' => $channel,
            'text' => $message,
        ]);
    }

    public function ephemeralMessage(string $channel, string $user, string $message): Response
    {
        return $this->post('chat.postEphemeral', [
            'channel' => $channel,
            'user' => $user,
            'text' => $message,
        ]);
    }

    public function message(string $channel, array $blocks): Response
    {
        return $this->post('chat.postMessage', [
            'channel' => $channel,
            'blocks' => json_encode($blocks),
        ]);
    }

    /**
     * @param  string  $slackMethod  - Dot notation, e.g. 'users.info'
     * @param  array  $data  - Array of key value pairs to pass to the API
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
     * @param  string  $slackMethod  - Dot notation, e.g. 'users.info'
     * @param  array  $data  - Array of key value pairs to pass as JSON
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
