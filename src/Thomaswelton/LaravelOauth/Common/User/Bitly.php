<?php namespace Thomaswelton\LaravelOauth\Common\User;

use OAuth\Common\Service\ServiceInterface;

class Bitly extends AbstractUser {

	protected $userEndpoint = 'user/info';

	public function getUser()
	{
		$response = $this->service->request($this->userEndpoint);
		return $this->getUserResponse($response);
	}

	public function getUserResponse($response){
		$decodedResponse = $this->decodeResponse($response);

		if($decodedResponse->status_code == 200){
			return $decodedResponse->data;
		}
	}

	public function getUniqueIdentifier()
	{
		$user = $this->getUser();
		return $user->login;
	}

}
