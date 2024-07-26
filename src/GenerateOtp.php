<?php

declare(strict_types=1);

namespace NjoguAmos\Otp;

use NjoguAmos\Otp\Models\Otp as OtpModel;

final readonly class GenerateOtp
{
    public function __construct(
        protected int $length,
        protected int $validity,
        protected bool $digits_only,
    ) {
    }

    public function generate(string $identifier): OtpModel
    {
        return OtpModel::create([
            'identifier' => $identifier,
            'token'      => $this->createRandomToken(),
            'expires_at' => now()->addMinutes($this->validity),
        ]);
    }

    public function validate(string $identifier, string $token): bool
    {
        $opts = OtpModel::active()
            ->where(column: 'identifier', operator: '=', value: $identifier)
            ->get()->pluck('token')->all();

        return in_array($token, $opts);
    }

    private function createRandomToken(): string
    {
        $randomString = '';

        $characters = $this->digits_only
            ? '0123456789'
            : '0123456789ABCDEFGHJKLMNPQRSTUVWXYZ';

        $charactersLength = strlen($characters);

        for ($i = 0; $i < $this->length; $i++) {
            $randomString .= $characters[rand(min: 0, max: $charactersLength - 1)];
        }

        return $randomString;
    }
}
