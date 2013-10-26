[![Build Status](https://travis-ci.org/thomaswelton/laravel-oauth.png?branch=master)](https://travis-ci.org/thomaswelton/laravel-oauth)
[![Latest Stable Version](https://poser.pugx.org/thomaswelton/laravel-oauth/v/stable.png)](https://packagist.org/packages/thomaswelton/laravel-oauth)
[![Total Downloads](https://poser.pugx.org/thomaswelton/laravel-oauth/downloads.png)](https://packagist.org/packages/thomaswelton/laravel-oauth)
[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/thomaswelton/laravel-oauth/trend.png)](https://bitdeli.com/free "Bitdeli Badge")

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

## Usage

### Consumer

Get an object of the [service](https://github.com/Lusitanian/PHPoAuthLib/tree/master/src/OAuth/OAuth2/Service) class

```
$facebook = OAuth::consumer('facebook');
```

Make an API request

```
$facebook = OAuth::consumer('facebook');
$response = $facebook->request('/me');
```

### Authorization

Get an authorization URL to login with an OAuth provider and redirect back you your website
```php
$authUrl = OAuth::getAuthorizeUrl('facebook');

// Custom redirect
$authUrl = OAuth::getAuthorizeUrl('facebook')->redirect(URL::to('some/page'));

// Custom scope
$authUrl = OAuth::getAuthorizeUrl('facebook')->withScope('publish_actions');
```

### Tokens

Check for a stored token
```php
$hasToken = OAuth::hasToken('facebook');
```

Get a stored OAuth token for a provider
returns - \OAuth\Common\Token\TokenInterface
throws - TokenNotFoundException

```php
$token = OAuth::token('facebook');
```



## Login

Run the migrations to create the database tables required to store OAuth user details.
You will already need to have a `users` table present.

```
php artisan migrate --package="thomaswelton/laravel-oauth"
```

### Link

If a user is already logged in to your application you can prompt them to link their account to an oauth provider with a URL like this.

```
<a href="<?= OAuth::link($provider); ?>">Link with <?= Str::studly($provider) ?></a>
```

When a user clicks the link they will be promoted for permissions from the OAuth provider, and redirected back to your site and your database updated with a record of the link.
You can also specify a redirect, and required scope just like the `OAuth::authorize()` method

### Login

If a user has a linked account they can login to your app by clicking a URL like this. You can also specify a custom redirect here too.

```
<a href="<?= OAuth::login($provider); ?>">Link with <?= Str::studly($provider) ?></a>
```

### Eloquent Relations

If you have linked users you may want to add Eloquent relations to your User model in order to simplify access to their oauth tokens or UIDs.

Update you user model so it looks like this

```php
class User extends Eloquent{

    public function facebook()
    {
        return $this->hasOne('Thomaswelton\LaravelOauth\Eloquent\Facebook');
    }

}
```

The above is an example for the Facebook OAuth provider, but you can add relations for all OAuth providers listed here https://github.com/thomaswelton/laravel-oauth/tree/master/src/Thomaswelton/LaravelOauth/Eloquent

Once you have setup your relation you can get a users OAuth UID like this

```php
$user = Auth::user();
$uid = $user->facebook->oauth_uid;
```


