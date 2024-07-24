<?php

declare(strict_types=1);

namespace NjoguAmos\Otp\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use HasFactory;

    protected $fillable = [
        'identifier',
        'token',
        'expires_at',
        'generate_count',
        'attempts_count'
    ];

    protected function casts(): array
    {
        return [
            'otp'        => 'encrypted',
            'expires_at' => 'immutable_datetime'
        ];
    }

}
