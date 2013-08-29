<?php namespace Thomaswelton\LaravelOauth\Common\User;

use OAuth\Common\Service\ServiceInterface;

class SoundCloud extends AbstractUser {

	protected $userEndpoint = '/me?format=json';

	public function getUniqueIdentifier()
	{
		$user = $this->getUser();
		return $user->id;
	}

}
