<?php namespace Thomaswelton\LaravelOauth\Common\User;

use OAuth\Common\Service\ServiceInterface;

class Foursquare extends AbstractUser{

	protected $userEndpoint = 'users/self';

	public function getUniqueIdentifier()
	{
		$user = $this->getUser();
		return $user->id;
	}

	public function getUserResponse($response){
		$decodedResponse = $this->decodeResponse($response);
		return $decodedResponse->response->user;
	}

}
