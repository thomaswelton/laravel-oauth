<?php namespace Thomaswelton\LaravelOauth\Common\User;

use OAuth\Common\Service\ServiceInterface;

class Amazon extends AbstractUser{

	protected $userEndpoint = 'user/profile';

	public function getUniqueIdentifier()
	{
		$user = $this->getUser();
		return $user->user_id;
	}

}
