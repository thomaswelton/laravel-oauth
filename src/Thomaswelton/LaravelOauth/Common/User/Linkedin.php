<?php namespace Thomaswelton\LaravelOauth\Common\User;

use OAuth\Common\Service\ServiceInterface;

class Linkedin extends AbstractUser{

	protected $userEndpoint = 'people/~?format=json';

	public function getUniqueIdentifier()
	{
		$user = $this->getUser();
		// The user ID is part fo the profile query string
		$profileQueryStr = parse_url($user->siteStandardProfileRequest->url, PHP_URL_QUERY);
		parse_str($profileQueryStr, $queryParts);

		return $queryParts['id'];
	}

}
