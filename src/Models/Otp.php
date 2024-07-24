<?php

declare(strict_types=1);

namespace NjoguAmos\Otp\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;

class Otp extends Model
{
    use HasFactory;
    use Prunable;

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

    public function prunable(): Builder
    {
        return static::where('expires_at', '<', now());
    }
}
