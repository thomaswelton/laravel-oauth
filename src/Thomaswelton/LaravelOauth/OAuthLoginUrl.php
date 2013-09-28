<?php namespace Thomaswelton\LaravelOauth;

use \Config;
use \URL;

class OAuthLoginUrl
{
    private $requiesHTTPS = array('amazon', 'box', 'dropbox');

    public function __construct($provider)
    {
        $this->provider = $provider;
        $this->url = new \Purl\Url(URL::to('/'));

        if (in_array($provider, $this->requiesHTTPS)) {
            $this->url->set('scheme', 'https');
        }

        $this->setPath('authorize');

        // Look for a default redirect the config, either for the provider
        // Or use the global config. Neither of these may actually be set
        $redirect = Config::get("laravel-oauth::{$provider}.redirect", Config::get('laravel-oauth::redirect'));

        // Set a default redirect
        // This may get overwritten later by chained calls
        if (!is_null($redirect)) {
            $this->url->query->set('redirect', $redirect);
        }

        $this->url->query->set('_token', csrf_token());
    }

    private function setPath($pathPart)
    {
        $routePrefix = Config::get('laravel-oauth::route');
        $this->url->set('path', "{$routePrefix}/{$this->provider}/{$pathPart}");
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

    public function login($login = true)
    {
        if ($login) {
            $this->url->query->set('login', true);
        }

        return $this;
    }

    public function link($link = true)
    {
        if ($link) {
            $this->url->query->set('link', true);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->url->getUrl();
    }
}
