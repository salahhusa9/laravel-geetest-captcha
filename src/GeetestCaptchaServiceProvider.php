<?php

namespace Salahhusa9\GeetestCaptcha;

use Illuminate\Support\Facades\Blade;
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
            ->hasCommand(GeetestCaptchaCommand::class);

        Blade::directive('geetestCaptchaAssets', function () {
            return '<script src="https://static.geetest.com/v4/gt4.js"></script>';
        });

        Blade::directive('geetestCaptchaInit', function ($elementId) {
            return view('geetest-captcha::initGeetest4', [
                'elementId' => $elementId,
            ])->render();
        });
    }
}
