<?php namespace Thomaswelton\LaravelOauth\Common\User;

use OAuth\Common\Service\ServiceInterface;

class Instagram extends AbstractUser{

	protected $userEndpoint = 'users/self';

	public function getUniqueIdentifier()
	{
		$user = $this->getUser();
		return $user->id;
	}

	public function getUserResponse($response){
		$decodedResponse = $this->decodeResponse($response);
		return $decodedResponse->data;
	}

}
