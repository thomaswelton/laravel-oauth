<?php namespace Thomaswelton\LaravelOauth\Common\User;

use OAuth\Common\Service\ServiceInterface;

class Facebook extends AbstractUser{

	protected $userEndpoint = 'me?fields=id';

}
