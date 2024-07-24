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

describe(description: 'exception', tests: function () {


    it(description: 'throws an exception if the length is less than 4', closure: function () {
        config()->set(key: 'otp.length', value: 3);

        Otp::generate(identifier: 'example@gmail.com');
    })->throws(exception: InvalidArgumentException::class);

    it(description: 'throws an exception if validity is less than lifetime', closure: function () {
        config()->set(key: 'otp.lifetime', value: 5);
        config()->set(key: 'otp.validity', value: 10);

        Otp::generate(identifier: '+254722000000');
    })->throws(exception: InvalidArgumentException::class);

});
