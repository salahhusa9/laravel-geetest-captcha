<?php

namespace Salahhusa9\GeetestCaptcha\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Salahhusa9\GeetestCaptcha\GeetestCaptcha
 */
class GeetestCaptcha extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Salahhusa9\GeetestCaptcha\GeetestCaptcha::class;
    }
}
