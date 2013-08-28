<?php namespace Thomaswelton\LaravelOauth;

use \Config;
use \URL;

class OAuthLoginUrl{

	function __construct($provider)
	{
		$routePrefix = Config::get('laravel-oauth::route');

		$baseUrl = URL::to("/{$routePrefix}/{$provider}/login");
		$this->url = new \Purl\Url($baseUrl);

		// Look for a default redirect the config, either for the provider
		// Or use the global config. Neither of these may actually be set
		$redirect = Config::get("laravel-oauth::{$provider}.redirect", Config::get('laravel-oauth::redirect'));

		// Set a default redirect
		// This may get overwritten later by chained calls
		if(!is_null($redirect)){
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

	function __toString()
	{
		return $this->url->getUrl();
	}
}
