<?php namespace Thomaswelton\LaravelOauth\Common\User;

use OAuth\Common\Service\ServiceInterface;

class Amazon extends AbstractUser{

	protected $userEndpoint = 'user/profile';
	protected $uidKey = 'user_id';

}
