<?php

declare(strict_types=1);

namespace NjoguAmos\Otp\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use NjoguAmos\Otp\OtpServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'NjoguAmos\\Otp\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app): array
    {
        return [
            OtpServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('app.key', 'base64:od2Vcg6pLtJ2hLAeEPvby3OZp1QJEGC0LD5cohPPLVw=');
        config()->set('database.default', 'testing');

        $migration = include __DIR__.'/../database/migrations/create_otps_table.php.stub';
        $migration->up();
    }
}
