<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    |  OTP Length
    |--------------------------------------------------------------------------
    |
    | This is the length of the generated OTP token. By default it is set to
    | 6 digits. We recommend that the length of the OTP be at least 6 digits
    | to ensure that the OTP is not easily guessable.
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

    'validity' => env(key: 'OTP_VALIDITY_TIME', default: 10),

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

    'digits_only' => true,

    /*
    |--------------------------------------------------------------------------
    | Max OTP attempts
    |--------------------------------------------------------------------------
    |
    | This is the maximum number of attempts allowed within the duration of
    | the max_attempts time. By default it is set to 5. This means that the
    | OTP will be valid for 5 attempts within the max_attempts time.
    |
    */

    'max_attempts' => env(key: 'OTP_MAX_ATTEMPTS', default: 5),

    /*
    |--------------------------------------------------------------------------
    | OTP Lifetime
    |-------------------------------------------------------------------------
    |
    | This is the lifetime of the generated OTP token. By default it is set to
    | 15 minutes. This means that the OTP will be valid for 15 minutes after
    | it is generated. Should be greater than the validity time.
    |
    */

    'otp_lifetime' => 15,

    /*
    |--------------------------------------------------------------------------
    |  Maximum OTPs
    |--------------------------------------------------------------------------
    |
    | This is the maximum number of OTPs allowed to be generated during the
    | otp_lifetime time. By default it is set to 5. User will not be able
    | to generate OTPs until the old OTPs are deleted.
    |
    */

    'max_otps_count' => env(key: 'MAXIMUM_OTPS_COUNT', default: 5),
];
