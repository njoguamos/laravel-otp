<?php

declare(strict_types=1);

namespace NjoguAmos\Otp;

use Illuminate\Config\Repository;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class OtpServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name(name: 'laravel-otp')
            ->hasConfigFile()
            ->hasMigration(migrationFileName: 'create_otps_table');
    }

    public function registeringPackage(): void
    {
        $this->app->bind(
            abstract: GenerateOtp::class,
            concrete: fn ($app) => new GenerateOtp(
                length: config()->integer('otp.length'),
                validity: config()->integer('otp.validity'),
                digits_only: config()->boolean('otp.digits_only'),
            )
        );
    }
}
