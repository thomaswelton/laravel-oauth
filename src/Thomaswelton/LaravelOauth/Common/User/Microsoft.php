<?php namespace Thomaswelton\LaravelOauth\Common\User;

use OAuth\Common\Service\ServiceInterface;

class Microsoft extends AbstractUser{

	protected $userEndpoint = 'me';

	public function getUniqueIdentifier()
	{
		$user = $this->getUser();
		return $user->id;
	}

}
