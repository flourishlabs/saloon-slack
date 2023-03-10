<?php

declare(strict_types=1);

namespace FlourishLabs\SaloonSlack;

use FlourishLabs\SaloonSlack\Requests\GenericGetRequest;
use FlourishLabs\SaloonSlack\Requests\GenericPostRequest;
use FlourishLabs\SaloonSlack\Responses\SlackResponse;
use Saloon\Contracts\OAuthAuthenticator;
use Saloon\Helpers\OAuth2\OAuthConfig;
use Saloon\Http\Connector;
use Saloon\Contracts\Response;
use Saloon\Http\OAuth2\GetUserRequest;
use Saloon\Traits\OAuth2\AuthorizationCodeGrant;

class SlackAuthConnector extends Connector
{
    use AuthorizationCodeGrant;

    public function __construct(
        private readonly string $clientId,
        private readonly string $clientSecret,
        private readonly string $redirectUri,
    )
    {
    }

    // MAKE SURE YOU CALL DEFAULT SCOPES
    public function resolveBaseUrl(): string
    {
        return 'https://slack.com/oauth/v2/';
    }

    protected function defaultOauthConfig(): OAuthConfig
    {
        return OAuthConfig::make()
            ->setClientId($this->clientId)
            ->setClientSecret($this->clientSecret)
            ->setRedirectUri($this->redirectUri)
            ->setTokenEndpoint('https://slack.com/api/oauth.v2.access')
            ->setUserEndpoint('https://slack.com/api/users.info');
    }

    public function getSlackUser(OAuthAuthenticator $oauthAuthenticator, string $slackUserId): Response
    {
        // Need to override the request to add the slack user id as it's required - https://api.slack.com/methods/users.info
        return $this->getUser($oauthAuthenticator, function (GetUserRequest &$request) use ($slackUserId) {
            $request->body()->add('user', $slackUserId);
        });
    }
}
