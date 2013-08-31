<?php namespace Thomaswelton\LaravelOauth\Common\User;

use OAuth\Common\Service\ServiceInterface;

class Microsoft extends AbstractUser{

	protected $userEndpoint = 'me';

}
