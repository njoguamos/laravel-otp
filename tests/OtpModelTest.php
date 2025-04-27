<?php

declare(strict_types=1);

use Illuminate\Support\Facades\DB;
use NjoguAmos\Otp\Models\Otp as OtpModel;

use function Pest\Laravel\artisan;

it(description: 'encrypts token when saving to database', closure: function () {
    $otp = OtpModel::factory()->create(attributes: ['token' => 123456]);

    $token = DB::table('otps')->first();

    expect(value: $token->token)->not->toBe(expected: $otp->token)
        ->and(value: strlen($token->token) > 50)->toBeTrue();
});

it(description: 'can prune expired otps', closure: function () {
    $expiredOtp = OtpModel::factory()->expired()->create();
    $validOtp = OtpModel::factory()->create();

    expect(value: OtpModel::count())->toBe(expected: 2);

    artisan(command: 'model:prune', parameters: ['--model' => OtpModel::class]);

    expect(value: OtpModel::count())->toBe(expected: 1)
        ->and(value: $expiredOtp->fresh()?->exists())->toBeNull()
        ->and(value: $validOtp->fresh()->exists())->toBeTrue();
});

it(description: 'can can scope by active otps', closure: function () {
    $expiredOtp = OtpModel::factory()->expired()->create();
    $validOtp = OtpModel::factory()->create();

    $activeOtps = OtpModel::active()->get();

    expect(value: $activeOtps->contains($expiredOtp))->toBeFalse()
        ->and(value: $activeOtps->contains($validOtp))->toBeTrue();
});

it(description: 'can get expires in attribute', closure: function () {
    $this->freezeTime();

    $otp = OtpModel::factory()->create(['expires_at' => now()->addMinutes(5)->addSeconds(10)]);

    expect(value: $otp->expires_in)->toBe(expected: '5 minutes');
});
