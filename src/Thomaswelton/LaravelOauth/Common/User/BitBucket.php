<?php namespace Thomaswelton\LaravelOauth\Common\User;

use OAuth\Common\Service\ServiceInterface;

class BitBucket extends AbstractUser{

	protected $userEndpoint = 'user';

	public function getUserResponse($response){
		$decodedResponse = $this->decodeResponse($response);
		return $decodedResponse->user;
	}

	// Doesn't return a user ID and can change username
	public function getUniqueIdentifier()
	{
		return null;
	}

}
