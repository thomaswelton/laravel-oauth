<?php namespace Thomaswelton\LaravelOauth\Common\User;

use OAuth\Common\Service\ServiceInterface;

class AbstractUser implements UserInterface {

	function __construct(ServiceInterface $service){
		$this->service = $service;
	}

	public function getUser()
	{
		$response = $this->service->request($this->userEndpoint);
		return $this->getUserResponse($response);
	}

	public function decodeResponse($response){
		return json_decode($response);
	}

	public function getUserResponse($response){
		return $this->decodeResponse($response);
	}

	public function getUniqueIdentifier()
	{
		$user = $this->getUser();
		return $user->id;
	}

}
