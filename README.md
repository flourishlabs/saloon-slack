# Saloon for Slack

[![Latest Version on Packagist](https://img.shields.io/packagist/v/flourishlabs/saloon-slack?color=f28d1a&style=flat-square)](https://packagist.org/packages/flourishlabs/saloon-slack)
[![Tests](https://img.shields.io/github/actions/workflow/status/flourishlabs/saloon-slack/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/flourishlabs/saloon-slack/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/flourishlabs/saloon-slack.svg?color=f28d1a&style=flat-square)](https://packagist.org/packages/flourishlabs/saloon-slack)

## Installation

You can install the package via composer:

```bash
composer require flourishlabs/saloon-slack
```

## Usage

```php
$slack = new FlourishLabs\SaloonSlack\SlackConnector('token');
$response = $slack->get('users.info', ['user' => 'W1234567890']);

$response = $slack->get('admin.emoji.add', [
    'name' => 'pikachu_wave',
    'url' => 'https://emojis.slackmojis.com/emojis/images/1643514747/7550/pikachu_wave.gif?1643514747',
]);

$slack->post('chat.postEphemeral', [
    'channel' => 'C1234567890',
    'text' => 'Well howdy!',
    'user' => 'U0HH0WDY',
]);
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
