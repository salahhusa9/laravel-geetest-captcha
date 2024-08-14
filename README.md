# Laravel Geetest Captcha, the best alternative to Google reCaptcha

[![Latest Version on Packagist](https://img.shields.io/packagist/v/salahhusa9/laravel-geetest-captcha.svg?style=flat-square)](https://packagist.org/packages/salahhusa9/laravel-geetest-captcha)
![laravel](https://img.shields.io/badge/Laravel-9%7C10%7C11-red)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/salahhusa9/laravel-geetest-captcha/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/salahhusa9/laravel-geetest-captcha/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/salahhusa9/laravel-geetest-captcha/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/salahhusa9/laravel-geetest-captcha/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/salahhusa9/laravel-geetest-captcha.svg?style=flat-square)](https://packagist.org/packages/salahhusa9/laravel-geetest-captcha)

Laravel Geetest Captcha is a package that provides a simple way to integrate Geetest Captcha in your Laravel application.

![20240705-122929d](https://github.com/user-attachments/assets/24c38b93-817a-43ec-bc30-9cf54736b346)


## Support us

Does your business depend on our contributions? Reach out and support us on [Github sponsor](https://github.com/sponsors/salahhusa9). All pledges will be dedicated to allocating workforce on maintenance and new awesome stuff.

## Installation

1. You can install the package via composer:

```bash
composer require salahhusa9/laravel-geetest-captcha
```

2. You need to add `@geetestCaptchaAssets()` in head tag in your layout file:

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

3. Sign up and activate your GeeTest account on the [official website](https://geetest.com)
4. Create an ID and Key on the dashboard
5. add GEETEST_ID and GEETEST_KEY in .env file

## Usage
### Use in form

You can use in form like this:

In first add `@geetestCaptchaInit('captcha-id')` in footer of page as script tag, `captcha-id` is the id of the captcha div.

```html
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

@geetestCaptchaInit('captcha-id')
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
- [geetest](https://www.geetest.com/en/)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
