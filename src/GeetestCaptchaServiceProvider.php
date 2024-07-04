<?php

namespace Salahhusa9\GeetestCaptcha;

use Salahhusa9\GeetestCaptcha\Commands\GeetestCaptchaCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class GeetestCaptchaServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-geetest-captcha')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-geetest-captcha_table')
            ->hasCommand(GeetestCaptchaCommand::class);
    }
}
