[![Build Status](https://travis-ci.org/thomaswelton/laravel-oauth.png?branch=master)](https://travis-ci.org/thomaswelton/laravel-oauth)
[![Latest Stable Version](https://poser.pugx.org/thomaswelton/laravel-oauth/v/stable.png)](https://packagist.org/packages/thomaswelton/laravel-oauth)
[![Total Downloads](https://poser.pugx.org/thomaswelton/laravel-oauth/downloads.png)](https://packagist.org/packages/thomaswelton/laravel-oauth)

This aplha version is currently under active development and subject to change.
A demo site is also underconstruction.

Feel free to install this project for testing purposes. But it is not recomeneded as the foundation to build new projects on... yet.
I'm hoping to get all this wrapped up soon. Once the demo site is build I'll remove this notice and let you start playing in production.

## Installation

Update your `composer.json` file to include this package as a dependency
```json
"thomaswelton/laravel-oauth": "dev-master"
```

Register the OAuth service provider by adding it to the providers array in the `app/config/app.php` file.
```
Thomaswelton\LaravelOauth\LaravelOauthServiceProvider
```

Alias the OAuth facade by adding it to the aliases array in the `app/config/app.php` file.
```php
'aliases' => array(
	'OAuth' => 'Thomaswelton\LaravelOauth\Facades\OAuth'
)
```

## Configuration

Copy the config file into your project by running
```
php artisan config:publish thomaswelton/laravel-oauth
```
