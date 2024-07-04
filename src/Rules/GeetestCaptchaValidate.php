<?php

namespace Salahhusa9\GeetestCaptcha\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Salahhusa9\GeetestCaptcha\Facades\GeetestCaptcha;

class GeetestCaptchaValidate implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        GeetestCaptcha::validate($value) ? true : $fail('validation.geetest_captcha_fail')->translate();
    }
}
