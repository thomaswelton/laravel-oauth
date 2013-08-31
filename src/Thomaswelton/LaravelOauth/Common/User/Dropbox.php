<?php namespace Thomaswelton\LaravelOauth\Common\User;

use OAuth\Common\Service\ServiceInterface;

class Dropbox extends AbstractUser{

	protected $userEndpoint = 'account/info';
	protected $uidKey = 'uid';

}
