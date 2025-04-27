<?php

declare(strict_types=1);

namespace NjoguAmos\Otp;

use Illuminate\Support\Facades\Facade;

class Otp extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return GenerateOtp::class;
    }
}
