<?php namespace Thomaswelton\LaravelOauth\Common\User;

use OAuth\Common\Service\ServiceInterface;

class Twitter extends AbstractUser{

	protected $userEndpoint = '/account/verify_credentials.json';

}
