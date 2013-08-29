<?php namespace Thomaswelton\LaravelOauth\Common\User;

use OAuth\Common\Service\ServiceInterface;

class Github extends AbstractUser{

	protected $userEndpoint = 'user';
}
