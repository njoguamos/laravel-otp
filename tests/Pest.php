<?php

declare(strict_types=1);

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use NjoguAmos\Otp\Tests\TestCase;

uses(TestCase::class, LazilyRefreshDatabase::class)->in(__DIR__);

expect()->extend(name: 'toBeDigitsOfLength', extend: function (int $length) {
    $matches = preg_match(pattern: '/^\d{'.$length.'}$/', subject: $this->value);

    expect(value: $matches)->toBe(expected: 1);
});
