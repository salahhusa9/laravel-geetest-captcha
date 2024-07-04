<?php

namespace Salahhusa9\GeetestCaptcha\Http\Middleware;

use Closure;
use Salahhusa9\GeetestCaptcha\Facades\GeetestCaptcha;

class ValidateGeetestCaptcha
{
    public function handle($request, Closure $next)
    {
        $value = $request->input('geetest_captcha');
        if (!GeetestCaptcha::validate($value)) {
            return response()->json(['message' => 'Geetest captcha validation failed'], 422);
        }

        return $next($request);
    }
}
