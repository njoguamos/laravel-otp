# "A package for generating onetime password for emails and mobile number"

[![Latest Version on Packagist](https://img.shields.io/packagist/v/njoguamos/laravel-otp.svg?style=flat-square)](https://packagist.org/packages/njoguamos/laravel-otp)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/njoguamos/laravel-otp/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/njoguamos/laravel-otp/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/njoguamos/laravel-otp/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/njoguamos/laravel-otp/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/njoguamos/laravel-otp.svg?style=flat-square)](https://packagist.org/packages/njoguamos/laravel-otp)

@TODO

## Installation

You can install the package via composer:

```bash
composer require njoguamos/laravel-otp
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="otp-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="otp-config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$otp = new NjoguAmos\Otp();
echo $otp->echoPhrase('Hello, NjoguAmos!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Njogu Amos](https://github.com/njoguamos)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
