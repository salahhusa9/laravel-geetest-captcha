<?php

namespace Salahhusa9\GeetestCaptcha\Commands;

use Illuminate\Console\Command;

class GeetestCaptchaCommand extends Command
{
    public $signature = 'laravel-geetest-captcha';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
