# simple-laravel-feature-flag

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

This package gives you a quick and dirty way to use feature flags in Laravel 5+. It doesn't 
provide configuration by user, nor is it set up for A/B tests. It's a simple on/off switch.

## Install

Install the package with Composer:

``` bash
$ composer require JTGrimes/simple-laravel-feature-flag
```

You'll need to update the providers array in `config/app.php` 
with the service provider for this package:

```php
'providers' => [
    ...
    JTGrimes\FeatureFlag\ServiceProvider::class,
];

```
Finally, you'll need to publish the configuration file:
You can publish the migration with:

``` bash
$ php artisan vendor:publish --provider="JTGrimes\FeatureFlag\ServiceProvider"
```
## Configuration

The default configuration file is shown below. The array keys are the names of the features
that you're using feature flags for and the values are true/false based on whether the 
feature is enabled. (My convention is to set a FEATURE_* .env variable to 'on' or 'off',
but any expression which is truthy will work.) Any feature which is not found in the config
file will default to being enabled.
```php
return [
    'something' => (env('FEATURE_SOMETHING', 'on') == 'on'),
    'something_else' => (env('SOME_OTHER_FEATURE', 'on') == 'on'),
    'one_more' => false,
];
```
## Usage

The package provides a helper function. To determine whether a feature is enabled, 
 you can call the `feature()` function from anywhere in your code.
``` php
   $permitAccess = feature('name');
```
I often find myself using this function in middleware to prevent access to pages which
aren't available yet ... 
```php
        if (!feature('v2')) {
            if (str_contains($request->getUri(), 'v2')) {
                abort(Response::HTTP_NOT_FOUND);
            }
        }
        return $next($request);
```

There are also helpers for your Blade views:
```blade
@ifFeature ('test')
    Feature on
@elseFeature
    Feature off
@endFeature
```

`@elseFeature` is optional, but you must include `@endFeature` to close the if statement.

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email jtgrimes@gmail.com instead of using the issue tracker.

## Credits

- [J.T. Grimes][link-author]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/JTGrimes/simple-laravel-feature-flag.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/JTGrimes/simple-laravel-feature-flag/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/JTGrimes/simple-laravel-feature-flag.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/JTGrimes/simple-laravel-feature-flag.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/JTGrimes/simple-laravel-feature-flag.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/JTGrimes/simple-laravel-feature-flag
[link-travis]: https://travis-ci.org/JTGrimes/simple-laravel-feature-flag
[link-scrutinizer]: https://scrutinizer-ci.com/g/JTGrimes/simple-laravel-feature-flag/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/JTGrimes/simple-laravel-feature-flag
[link-downloads]: https://packagist.org/packages/JTGrimes/simple-laravel-feature-flag
[link-author]: https://github.com/jtgrimes
