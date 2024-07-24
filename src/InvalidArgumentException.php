<?php

declare(strict_types=1);

namespace NjoguAmos\Otp;

use InvalidArgumentException as BaseInvalidArgumentException;

final class InvalidArgumentException extends BaseInvalidArgumentException
{
    /**
     * Create a new exception instance.
     */
    public static function create(string $message): self
    {
        return new self(message: $message);
    }
}
