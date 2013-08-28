<?php namespace Thomaswelton\LaravelOauth;

use \Config;
use \URL;

class OAuthLoginUrl{

	function __construct($provider)
	{
		$routePrefix = Config::get('laravel-oauth::route');

		$baseUrl = URL::to("/{$routePrefix}/{$provider}/login");
		$this->url = new \Purl\Url($baseUrl);
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
