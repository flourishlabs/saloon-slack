<?php

use FlourishLabs\SaloonSlack\SlackAuthConnector;
use Saloon\Http\Auth\AccessTokenAuthenticator;

test('auth connector can be instantiated', function () {
    expect(new SlackAuthConnector('clientId', 'clientSecret', 'redirectUri'))->toBeInstanceOf(SlackAuthConnector::class);
});

it('overrides getUser request with slack user_id successfully', function () {
    $auth = new SlackAuthConnector('clientId', 'clientSecret', 'redirectUri');
    $authenticator = new AccessTokenAuthenticator('token');
    $user = $auth->getSlackUser($authenticator, 'W1234567890');
    expect($user->getRequest()->body()->get('user'))->toBe('W1234567890');
});
