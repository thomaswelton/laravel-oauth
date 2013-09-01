[![Build Status](https://travis-ci.org/thomaswelton/laravel-oauth.png?branch=master)](https://travis-ci.org/thomaswelton/laravel-oauth)
[![Latest Stable Version](https://poser.pugx.org/thomaswelton/laravel-oauth/v/stable.png)](https://packagist.org/packages/thomaswelton/laravel-oauth)
[![Total Downloads](https://poser.pugx.org/thomaswelton/laravel-oauth/downloads.png)](https://packagist.org/packages/thomaswelton/laravel-oauth)
[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/thomaswelton/laravel-oauth/trend.png)](https://bitdeli.com/free "Bitdeli Badge")

This aplha version is currently under active development and subject to change.
A demo site is also underconstruction. And can be view here http://laravel-oauth.herokuapp.com/ it is currently a free app on Heroku, this means that the server may sleep if left unactive. It will wake up again the next time it's viewed but start up may take a few seconds. This package is not the cause of the slow response time :smile:

Feel free to install this project for testing purposes. But it is not recomeneded as the foundation to build new projects on... yet.
I'm hoping to get all this wrapped up soon. Once the demo site is build I'll remove this notice and let you start playing in production.

Right now there is only one potentially breaking change. It is outlined here, feel free to add any comments on what syntax you'd prefer https://github.com/thomaswelton/laravel-oauth/issues/1

If you're interested in using a new OAuth package for Laravel 4 please "watch" or "star" this repo above.

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

## Migrations

Optionally if using OAuth for user login you'll need to run the migration

```
php artisan migrate --package="thomaswelton/laravel-oauth"
```
