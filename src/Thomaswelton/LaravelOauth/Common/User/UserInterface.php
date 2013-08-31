<?php namespace Thomaswelton\LaravelOauth\Common\User;

use OAuth\Common\Service\ServiceInterface;

interface UserInterface {

	function __construct(ServiceInterface $service);

	public function getUID();
	public function getUser();

}
