<?php namespace Thomaswelton\LaravelOauth;

use \Config;
use \URL;

class OAuthLoginUrl
{
    private $requiesHTTPS = array('amazon', 'box', 'dropbox');

    public function __construct($provider)
    {
        $routePrefix = Config::get('laravel-oauth::route');

        $this->url = new \Purl\Url(URL::to('/'));

        $this->url->set('path', "{$routePrefix}/{$provider}/login");

        if (in_array($provider, $this->requiesHTTPS)) {
            $this->url->set('scheme', 'https');
        }

        // Look for a default redirect the config, either for the provider
        // Or use the global config. Neither of these may actually be set
        $redirect = Config::get("laravel-oauth::{$provider}.redirect", Config::get('laravel-oauth::redirect'));

        // Set a default redirect
        // This may get overwritten later by chained calls
        if (!is_null($redirect)) {
            $this->url->query->set('redirect', $redirect);
        }
    }

    public function redirect($redirect)
    {
        $this->url->query->set('redirect', $redirect);

        return $this;
    }

    public function withScope()
    {
        $scope = implode(',', func_get_args());

        $this->url->query->set('scope', $scope);

        return $this;
    }

    public function __toString()
    {
        return $this->url->getUrl();
    }
}
