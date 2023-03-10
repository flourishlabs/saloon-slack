# Saloon for Slack

[![Latest Version on Packagist](https://img.shields.io/packagist/v/flourishlabs/saloon-slack?color=f28d1a&style=flat-square)](https://packagist.org/packages/flourishlabs/saloon-slack)
[![Tests](https://img.shields.io/github/actions/workflow/status/flourishlabs/saloon-slack/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/flourishlabs/saloon-slack/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/flourishlabs/saloon-slack.svg?color=f28d1a&style=flat-square)](https://packagist.org/packages/flourishlabs/saloon-slack)

# Introduction
The power of Slack powered by [Saloon](https://docs.saloon.dev/)


# Installation
Install the package via composer:

```bash
composer require flourishlabs/saloon-slack
```

# Usage

## Instance
Create an instance

```php
use FlourishLabs\SaloonSlack\SlackConnector;

$slack = new SlackConnector('token');
```

### Generic GET
```php
$response = $slack->get('users.info', ['user' => 'W1234567890']);

$response = $slack->get('admin.emoji.add', [
    'name' => 'pikachu_wave',
    'url' => 'https://emojis.slackmojis.com/emojis/images/1643514747/7550/pikachu_wave.gif?1643514747',
]);
```

### Generic POST
```php
$slack->post('chat.postEphemeral', [
    'channel' => 'C1234567890',
    'text' => 'Well howdy!',
    'user' => 'U0HH0WDY',
]);
```

---

### Responses
Saloon's documentation is best for responses, but there are extra Slack specific methods available too.

The most useful method you'll need is `json`:
```php
$response->json('channel_id');
$response->json('message_ts')
```

<br/>

- `hasWarning(): bool` & `warning(): string`
    From [Slack docs](https://api.slack.com/web#slack-web-api__evaluating-responses): In the case of problematic calls that could still be completed successfully, ok will be true and the warning property will contain a short machine-readable warning code (or comma-separated list of them, in the case of multiple warnings).
    ```php
    if ($response->hasWarning()) {
        Log::warning($response->warning());
    }
    ```
- `hasError(): bool` & `error(): string`
From [Slack docs](https://api.slack.com/web#slack-web-api__evaluating-responses) For failure results, the error property will contain a short machine-readable error code.
  ```php
  if ($response->hasError()) {
      Log::error("Ah poo! {$response->error()}");
  }
    ```

## Testing

```bash
vendor/bin/pest
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Ashley Hindle](https://github.com/ashleyhindle)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
