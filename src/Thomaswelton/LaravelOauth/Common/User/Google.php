<?php namespace Thomaswelton\LaravelOauth\Common\User;

use OAuth\Common\Service\ServiceInterface;

class Google extends AbstractUser{

	protected $userEndpoint = 'https://www.googleapis.com/oauth2/v1/userinfo';

}
