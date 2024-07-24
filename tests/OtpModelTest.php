<?php

declare(strict_types=1);

use NjoguAmos\Otp\Models\Otp;

it(description: 'encrypts token when saving to database', closure: function () {
    $otp = Otp::factory()->create(attributes: ['token' => 123456]);

    expect(value: $otp->otp)->not->toBe(expected: '123456');
});
