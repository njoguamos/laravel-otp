<?php

declare(strict_types=1);

use NjoguAmos\Otp\Models\Otp as OtpModel;

use function Pest\Laravel\artisan;

it(description: 'encrypts token when saving to database', closure: function () {
    $otp = OtpModel::factory()->create(attributes: ['token' => 123456]);

    expect(value: $otp->otp)->not->toBe(expected: '123456');
});

it(description: 'can prune expired otps', closure: function () {
    $expiredOtp = OtpModel::factory()->create(attributes: ['expires_at' => now()->subMinute()]);
    $validOtp = OtpModel::factory()->create(attributes: ['expires_at' => now()->addMinute() ]);

    expect(value: OtpModel::count())->toBe(expected: 2);

    artisan(command: 'model:prune', parameters: ['--model' => OtpModel::class]);

    expect(value: OtpModel::count())->toBe(expected: 1);
});
