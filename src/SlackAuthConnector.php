<?php

declare(strict_types=1);

namespace FlourishLabs\SaloonSlack;

use Saloon\Contracts\OAuthAuthenticator;
use Saloon\Http\Response;
use Saloon\Helpers\OAuth2\OAuthConfig;
use Saloon\Http\Auth\AccessTokenAuthenticator;
use Saloon\Http\Connector;
use Saloon\Http\OAuth2\GetUserRequest;
use Saloon\Traits\OAuth2\AuthorizationCodeGrant;

class SlackAuthConnector extends Connector
{
    use AuthorizationCodeGrant;

    public function __construct(
        private string $clientId,
        private string $clientSecret,
        private string $redirectUri,
    ) {
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

    public function createBotOAuthAuthenticatorFromResponse(Response $response, string $fallbackRefreshToken = null): OAuthAuthenticator
    {
        return new AccessTokenAuthenticator($response->json('access_token'));
    }

    public function createUserOAuthAuthenticatorFromResponse(Response $response, string $fallbackRefreshToken = null): OAuthAuthenticator
    {
        // The base method is protected for some reason, so we have to replicate the code for now for simplicity
        return new AccessTokenAuthenticator($response->json('authed_user.access_token'));
    }

    public function getSlackAuthorizationUrl(array $botScopes = [], array $userScopes = [], string $state = null, array $additionalQueryParameters = []): string
    {
        $queryParams = $additionalQueryParameters;
        if ($userScopes) {
            $queryParams['user_scope'] = implode(',', $userScopes);
        }

        return $this->getAuthorizationUrl(
            $botScopes,
            $state,
            ',',
            $queryParams,
        );
    }

    public function getSlackUser(OAuthAuthenticator $oauthAuthenticator, string $slackUserId): Response
    {
        // Need to override the request to add the slack user id as it's required - https://api.slack.com/methods/users.info
        return $this->getUser($oauthAuthenticator, function (GetUserRequest $request) use ($slackUserId) {
            $request->query()->add('user', $slackUserId);
        });
    }
}
