# This is my package laravel-geetest-captcha

[![Latest Version on Packagist](https://img.shields.io/packagist/v/salahhusa9/laravel-geetest-captcha.svg?style=flat-square)](https://packagist.org/packages/salahhusa9/laravel-geetest-captcha)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/salahhusa9/laravel-geetest-captcha/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/salahhusa9/laravel-geetest-captcha/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/salahhusa9/laravel-geetest-captcha/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/salahhusa9/laravel-geetest-captcha/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/salahhusa9/laravel-geetest-captcha.svg?style=flat-square)](https://packagist.org/packages/salahhusa9/laravel-geetest-captcha)

Laravel Geetest Captcha is a package that provides a simple way to integrate Geetest Captcha in your Laravel application.

## Support us

Does your business depend on our contributions? Reach out and support us on [Github sponsor](https://github.com/sponsors/salahhusa9). All pledges will be dedicated to allocating workforce on maintenance and new awesome stuff.

## Installation

You can install the package via composer:

```bash
composer require salahhusa9/laravel-geetest-captcha
```

You need to add `@geetestCaptchaAssets()` in head tag in your layout file:

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @geetestCaptchaAssets()
</head>
<body>
    ...
</body>
</html>
```

## Usage
### Use in form

You can use in form like this:

In first add `@geetestCaptchaInit('captcha-id')` in footer of page as script tag, `captcha-id` is the id of the captcha div.

```html
<!-- add @ -->

<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>
    <div class="form-group">
        <div id="captcha-id">
            <!-- hire we render geetest captcha -->
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
</form>
```

and for validation you can use `geetest_captcha` rule in your controller like this:

```php
use Salahhusa9\GeetestCaptcha\Rules\GeetestCaptchaValidate;

public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'geetest_captcha' => ['required', new GeetestCaptchaValidate]
    ]);

    // your logic
}
```

### Validate via middleware

You can use in middleware like this:
```php
    use Salahhusa9\GeetestCaptcha\Http\Middleware\ValidateGeetestCaptcha;

    Route::post('login', [LoginController::class, 'login'])->middleware(ValidateGeetestCaptcha::class);
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [salahhusa9](https://github.com/salahhusa9)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
