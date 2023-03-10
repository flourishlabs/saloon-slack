<?php

use FlourishLabs\SaloonSlack\Requests\GenericGetRequest;
use FlourishLabs\SaloonSlack\Responses\SlackResponse;
use FlourishLabs\SaloonSlack\SlackConnector;

test('connector can be instantiated', function () {
    expect(new SlackConnector('token-goes-here'))->toBeInstanceOf(SlackConnector::class);
});

test('generic get request can be sent', function () {
    expect(new SlackConnector('token-goes-here'))->toBeInstanceOf(SlackConnector::class);
    expect(new GenericGetRequest('users.info'))->toBeInstanceOf(class: GenericGetRequest::class);
});

// Actually calls the real API though :(
it('returns a custom response object', function () {
   expect((new SlackConnector('token-goes-here'))->send(new GenericGetRequest('users.info')))
       ->toBeInstanceOf(SlackResponse::class);
});
