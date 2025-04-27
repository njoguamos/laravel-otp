<?php

declare(strict_types=1);

namespace NjoguAmos\Otp;

use Illuminate\Support\Facades\Validator;
use NjoguAmos\Otp\Models\Otp as OtpModel;

final readonly class GenerateOtp
{
    public function __construct(
        protected int $length,
        protected int $validity,
        protected bool $digits_only,
    ) {
        if ($length < 4) {
            throw InvalidArgumentException::create('The length of the OTP must be at least 4');
        }

        if ($validity < 1) {
            throw InvalidArgumentException::create('The validity of the OTP must be at least 1 minute.');
        }
    }

    public function generate(string $identifier): OtpModel
    {
        Validator::validate(
            ['identifier' => $identifier],
            ['identifier' => ['required', 'max:255']],
        );

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
        $characters = $this->digits_only
            ? '0123456789'
            : '0123456789ABCDEFGHJKLMNPQRSTUVWXYZ';

        return substr(
            string: str_shuffle(str_repeat($characters, $this->length)),
            offset: 0,
            length: $this->length,
        );
    }
}
