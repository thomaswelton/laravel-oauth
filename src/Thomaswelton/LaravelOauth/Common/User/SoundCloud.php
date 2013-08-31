<?php namespace Thomaswelton\LaravelOauth\Common\User;

use OAuth\Common\Service\ServiceInterface;

class SoundCloud extends AbstractUser {

	protected $userEndpoint = '/me?format=json';

}
