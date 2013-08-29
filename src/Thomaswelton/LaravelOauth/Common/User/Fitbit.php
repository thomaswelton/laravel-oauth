<?php namespace Thomaswelton\LaravelOauth\Common\User;

use OAuth\Common\Service\ServiceInterface;

class Fitbit extends AbstractUser{

	protected $userEndpoint = 'user/-/profile.json';

	public function getUser()
	{
		$response = $this->service->request($this->userEndpoint);
		return $this->getUserResponse($response);
	}

	public function getUserResponse($response)
	{
		$decodedResponse = $this->decodeResponse($response);
		return $decodedResponse->user;
	}

	public function getUniqueIdentifier()
	{
		$user = $this->getUser();
		return $user->encodedId;
	}

}
