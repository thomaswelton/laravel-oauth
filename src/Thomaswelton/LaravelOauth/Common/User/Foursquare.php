<?php namespace Thomaswelton\LaravelOauth\Common\User;

use OAuth\Common\Service\ServiceInterface;

class Foursquare extends AbstractUser{

	protected $userEndpoint = 'users/self';

	public function getUserResponse($response){
		return $response->response->user;
	}

}
