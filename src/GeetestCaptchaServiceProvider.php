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
            // ->hasConfigFile()
            ->hasViews()
            ->hasCommand(GeetestCaptchaCommand::class);

        Blade::directive('geetestCaptchaAssets', function () {
            return '<script src="https://static.geetest.com/v4/gt4.js"></script>';
        });

        Blade::directive('geetestCaptchaInit', function ($elementId) {

            $html = <<<HTML
                <!-- GEETEST -->
                <script>
                    var captchaId = "{{ env('GEETEST_ID') }}"

                    initGeetest4({
                        captchaId: captchaId,
                    }, function (geetest) {
                        window.geetest = geetest
                        geetest
                            .appendTo("#{{ $elementId }}")
                            .onSuccess(function (e) {
                                let result = geetest.getValidate();
                                $("#{{ $elementId }}").parent().append('<input type="hidden" name="geetest_captcha_data" value="' + result + '">');
                            })
                    });

                </script>
            HTML;

            return $html;
        });
    }
}
