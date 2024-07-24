<?php

declare(strict_types=1);

namespace NjoguAmos\Otp\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \NjoguAmos\Otp\Otp
 */
class Otp extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \NjoguAmos\Otp\Otp::class;
    }
}
