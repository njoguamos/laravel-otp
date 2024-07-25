# A composer package for generating and verifying One Time Passwords (OTP) in Laravel 11+.

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

<details>

<summary>This is the contents of the published config file:</summary>

```php
return [

    /*
    |--------------------------------------------------------------------------
    |  OTP Length
    |--------------------------------------------------------------------------
    |
    | This is the length of the generated OTP token. By default it is set to
    | 6 digits. The length of the OTP must be at least 4 digits to ensure
    | that the OTP is not easily guessable
    |
    */

    'length' => env(key: 'OPT_LENGTH', default: 6),

    /*
    |--------------------------------------------------------------------------
    | OTP Validity time by minutes
    |--------------------------------------------------------------------------
    |
    | This is the validity time of the generated OTP token. By default it is
    | set to 10 minutes. This means that the OTP will be valid for 10 minutes
    | after it is generated. You can change this value to suit your needs.
    |
    */

    'validity' => env(key: 'OTP_VALIDITY', default: 10),

    /*
    |--------------------------------------------------------------------------
    | Digits Only
    |-------------------------------------------------------------------------
    |
    | When set to true, the generated OTP will only contain digits. When set
    | to false, the generated OTP will contain both digits and alphanumeric
    | characters which makes it more difficult to guess the OTP.
    |
    */

    'digits_only' => env(key: 'OTP_DIGITS_ONLY', default: true),
];

```
</details>

## Usage

### Generate OTP

To generate an OTP, you can use the `generate()` method on the `Otp` class. . This method takes an `identifier` as a parameter. The `identifier` can be and email address, phone number, or any other unique identifier that you want to use to identify the user.

```php
use NjoguAmos\Otp\Otp;

$otp = Otp::generate(identifier: 'example@gmail.com');

$otp->identifier; # example@gmail.com
$otp->token; # 123456
$otp->expires_in; # 10 minutes
```

The `generate()` method returns an instance of the `\NjoguAmos\Otp\Models\Otp` Eloquent Models class. You can access the `identifier`, `token`, and `expires_at` properties of the `Otp` class. 

For example: you can use the `token` property to send the OTP to the user's email address.

```php
use NjoguAmos\Otp\Otp;
use App\Mail\OTPMail;
use Illuminate\Support\Facades\Mail;

$email = 'example@gmail.com';

$otp = Otp::generate(identifier: $email);

Mail::to($email)->send(new OTPMail($order));
```

### Verify OTP

To verify an OTP, you can use the `validate()` method on the `Otp` class. This method takes an `identifier` and `token` as parameters. 

If the OTP is valid, the method will return `true`. Otherwise, it will return `false`.

```php
use NjoguAmos\Otp\Otp;

$email = 'example@gmail.com';
$otp = '123456';

$validated = Otp::validate(identifier: $email, token: $otp->token);

$validated // True or False
```

> [!NOTE]
> It is advisable not to let the user know if the OTP does not match, or does not exist or expired. 
> You can return a generic message to the user instead.

### Delete Expired OTPs

To periodically delete expired OTPs, you can use the `model:prune` Artisan command. This command will delete all expired OTPs from the database.

To do so, add `model:prune` to your `routes/console.php` file:

```php
use Illuminate\Support\Facades\Schedule;
use NjoguAmos\Otp\Models\Otp as OtpModel;

Schedule::command('model:prune', ['--model' => [OtpModel:class]])->everyFiveMinutes();

````
> [!TIP]
> Make sure the duration is greater than the validity time of the OTP.

### Security

> [!TIP]
> To prevent brute force attacks, rate limit the number of attempts to `generate` or `verify` an OTP tokens. This can be done by using the Laravel `RateLimit` middleware.
> User can verify tokens as long as they are valid. This means that the user can have multiple valid tokens. 
> Once the token expires, it cannot be valid even if it still exists in the database.
> Schedule the `model:prune` command to run every 5 minutes to delete expired tokens.


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
