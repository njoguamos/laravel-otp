<?php

declare(strict_types=1);

namespace NjoguAmos\Otp\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use NjoguAmos\Otp\Models\Otp;

class OtpFactory extends Factory
{
    protected $model = Otp::class;

    public function definition(): array
    {
        return [
            'identifier' => fake()->unique()->safeEmail(),
            'token'      => Str::random(length: 6),
            'expires_at' => now()->addMinutes(value: 10),
        ];
    }
}
