<?php namespace Thomaswelton\LaravelOauth\Common\User;

use OAuth\Common\Service\ServiceInterface;

class Box extends AbstractUser{

	protected $userEndpoint = 'folders/0';

	public function getUser()
	{
		$response = $this->service->request($this->userEndpoint);
		return $this->getUserResponse($response);
	}

	public function getUserResponse($response)
	{
		$decodedResponse = $this->decodeResponse($response);
		return $decodedResponse->owned_by;
	}

}
