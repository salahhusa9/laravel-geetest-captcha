<?php

namespace Salahhusa9\GeetestCaptcha;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Salahhusa9\GeetestCaptcha\Commands\GeetestCaptchaCommand;
use Illuminate\Support\Facades\Blade;

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

        Blade::directive('geetest-captcha-assets', function () {
            return '<script src="https://static.geetest.com/v4/gt4.js"></script>';
        });

        Blade::directive('geetest-captcha-init', function ($elementId) {
            return view('initGeetest4',[
                'elementId' => $elementId
            ])->render();
        });
    }
}
