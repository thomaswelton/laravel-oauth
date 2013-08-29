<?php namespace Thomaswelton\LaravelOauth\Common\User;

use OAuth\Common\Service\ServiceInterface;

class Tumblr extends AbstractUser{

	protected $userEndpoint = 'user/info';

	public function getUniqueIdentifier()
	{
		$user = $this->getUser();
		return $user->name;
	}

	public function getUserResponse($response){
		$decodedResponse = $this->decodeResponse($response);
		return $decodedResponse->response->user;
	}

}
