<?php

declare(strict_types=1);

use NjoguAmos\Otp\InvalidArgumentException;
use NjoguAmos\Otp\Otp;
use NjoguAmos\Otp\Models\Otp as OtpModel;

describe(description: 'generate otp', tests: function () {

    it(description: 'can generate an OTP and save it to the database', closure: function () {

        $identifier = 'example@gmail.com';

        $otp = Otp::generate(identifier: $identifier);

        $dbOtp = OtpModel::firstWhere(column: 'identifier', operator: '=', value: $identifier);

        expect(value: $dbOtp->token)->toBe(expected: $otp->token)
            ->and(value: $dbOtp->identifier)->toBe(expected: $identifier)
            ->and(value: $dbOtp->identifier)->toBe(expected: $otp->identifier)
            ->and(value: $otp->token)->toBeDigitsOfLength(config(key: 'otp.length'));
    });

    it(description: 'can generate a alphanumeric OTP', closure: function () {
        config()->set(key: 'otp.digits_only', value: false);

        $otp = Otp::generate(identifier: fake()->safeEmail());

        expect(value: $otp->token)->toBeAlphaNumeric();
    });

    it(description: 'can generate an OTP of a given length', closure: function () {
        config()->set(key: 'otp.length', value: 10);

        $otp = Otp::generate(identifier: fake()->safeEmail());

        expect(value: $otp->token)->toHaveLength(number: 10);
    });

});

describe(description: 'validate otp', tests: function () {

    it(description: 'can validate an an active token', closure: function () {
        $email = fake()->safeEmail();

        $otp = Otp::generate(identifier: $email);

        $validated = Otp::validate(identifier: $email, token: $otp->token);

        expect(value: $validated)->toBeTrue();
    });

    it(description: 'cannot validate with invalid token', closure: function () {
        $email = fake()->safeEmail();

        Otp::generate(identifier: $email);

        $validated = Otp::validate(identifier: $email, token: '123456');

        expect(value: $validated)->toBeFalse();
    });

    it(description: 'cannot validate an expired token', closure: function () {
        $this->freezeTime();

        $email = fake()->safeEmail();

        $otp = Otp::generate(identifier: $email);

        $this->travelTo(now()->addMinutes(config(key: 'otp.validity') + 1));

        $validated = Otp::validate(identifier: $email, token: $otp->token);

        expect(value: $validated)->toBeFalse();
    });

    it(description: 'cannot validate a token that does not exist', closure: function () {
        $validated = Otp::validate(identifier: fake()->safeEmail, token: random_int(min: 1000, max: 9999));

        expect(value: $validated)->toBeFalse();
    });

});



describe(description: 'exception', tests: function () {

    it(description: 'throws an exception if the length is less than 4', closure: function () {
        config()->set(key: 'otp.length', value: 3);

        Otp::generate(identifier: 'example@gmail.com');
    })->throws(exception: InvalidArgumentException::class);

    it(description: 'throws an exception if validity is less than 1', closure: function () {
        config()->set(key: 'otp.validity', value: 0);

        Otp::generate(identifier: '+254722000000');
    })->throws(exception: InvalidArgumentException::class);

});
