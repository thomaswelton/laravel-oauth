<?php namespace Thomaswelton\LaravelOauth\Common\User;

use OAuth\Common\Service\ServiceInterface;

class Bitly extends AbstractUser {

	protected $userEndpoint = 'user/info';
	protected $uidKey = 'login';

	public function getUserResponse($response){
		if($response->status_code == 200){
			return $response->data;
		}
	}

}
