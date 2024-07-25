<?php

declare(strict_types=1);

namespace NjoguAmos\Otp\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
        'channel',
    ];


    protected function casts(): array
    {
        return [
            'otp'        => 'encrypted',
            'expires_at' => 'immutable_datetime',
        ];
    }

    public function expiresIn(): Attribute
    {
        return new Attribute(
            get: function () {
                return abs(
                    num: round(
                        num: $this->expires_at->diffInMinutes()
                    )
                ) . ' minutes';
            }
        );
    }

    /**
     * Active opts are those that have not expired.
     */
    public function scopeActive(Builder $builder): Builder
    {
        return $builder->where(column: 'expires_at', operator: '>=', value: now());
    }

    /** @noinspection PhpIncompatibleReturnTypeInspection */
    public function prunable(): Builder
    {
        return static::where('expires_at', '<', now());
    }
}
