<?php

declare(strict_types=1);

namespace NjoguAmos\Otp;

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
        $this->app->alias(abstract: GenerateOtp::class, alias: 'generate-otp');

        $this->app->bind(abstract: GenerateOtp::class, concrete: function ($app) {
            $config = $app['config']->get('otp');

            if ($config['length'] < 4) {
                throw InvalidArgumentException::create('The length of the OTP must be at least 4');
            }

            if ($config['lifetime'] <= $config['validity']) {
                throw InvalidArgumentException::create('The lifetime of the OTP must be greater than the validity');
            }

            return new GenerateOtp(
                length: $config['length'],
                validity: $config['validity'],
                digits_only: $config['digits_only'],
                max_attempts: $config['max_attempts'],
                lifetime: $config['lifetime'],
                max_count: $config['max_count'],
            );
        });
    }
}
