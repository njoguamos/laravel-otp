<?php

declare(strict_types=1);

namespace NjoguAmos\Otp;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class OtpServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name(name: 'laravel-otp')
            ->hasConfigFile()
            ->hasMigration(migrationFileName: 'create_otps_table');
    }
}
