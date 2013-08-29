<?php namespace Thomaswelton\LaravelOauth\Common\User;

use OAuth\Common\Service\ServiceInterface;

interface UserInterface {

	function __construct(ServiceInterface $service);

	public function getUniqueIdentifier();

	public function getUser();

	public function decodeResponse($response);

	// Return the "user" portion of an API response
	public function getUserResponse($response);

}
