<?php namespace Thomaswelton\LaravelOauth\Common\User;

use OAuth\Common\Service\ServiceInterface;

class Dropbox extends AbstractUser{

	protected $userEndpoint = 'account/info';

	public function getUniqueIdentifier()
	{
		$user = $this->getUser();
		return $user->uid;
	}

}
