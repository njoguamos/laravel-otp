<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    |  OTP Length
    |--------------------------------------------------------------------------
    |
    | This is the length of the generated OTP token. By default it is set to
    | 6 digits. The length of the OTP must be at least 4 digits to ensure
    | that the OTP is not easily guessable
    |
    */

    'length' => env(key: 'OPT_LENGTH', default: 6),

    /*
    |--------------------------------------------------------------------------
    | OTP Validity time by minutes
    |--------------------------------------------------------------------------
    |
    | This is the validity time of the generated OTP token. By default it is
    | set to 10 minutes. This means that the OTP will be valid for 10 minutes
    | after it is generated. You can change this value to suit your needs.
    |
    */

    'validity' => env(key: 'OTP_VALIDITY', default: 10),

    /*
    |--------------------------------------------------------------------------
    | Digits Only
    |-------------------------------------------------------------------------
    |
    | When set to true, the generated OTP will only contain digits. When set
    | to false, the generated OTP will contain both digits and alphanumeric
    | characters which makes it more difficult to guess the OTP.
    |
    */

    'digits_only' => env(key: 'OTP_DIGITS_ONLY', default: true),
];
