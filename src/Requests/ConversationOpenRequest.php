<?php

declare(strict_types=1);

namespace FlourishLabs\SaloonSlack\Requests;

class ConversationOpenRequest extends GenericPostRequest
{
    /**
     * Refs: https://api.slack.com/methods/conversations.open
     *
     * Pass either a channel as the `im` or `mpim` ID, or an array of Slack user IDs (W1234,W1419)
     */
    public function __construct(private ?string $channel = null, private ?array $users = null, private array $extraData = [])
    {
    }

    public function resolveEndpoint(): string
    {
        return 'conversations.open';
    }

    public function defaultBody(): array
    {
        $body = [];
        if ($this->channel) {
            $body['channel'] = $this->channel;
        } elseif ($this->users) {
            $body['users'] = implode(',', $this->users);
        }

        return array_merge($body, $this->extraData);
    }
}
