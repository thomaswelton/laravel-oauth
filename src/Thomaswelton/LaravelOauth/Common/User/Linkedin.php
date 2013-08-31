<?php namespace Thomaswelton\LaravelOauth\Common\User;

class Linkedin extends AbstractUser
{
    protected $userEndpoint = 'people/~?format=json';

    public function getUID()
    {
        $user = $this->getUser();
        // The user ID is part fo the profile query string
        $profileQueryStr = parse_url($user->siteStandardProfileRequest->url, PHP_URL_QUERY);
        parse_str($profileQueryStr, $queryParts);

        return $queryParts['id'];
    }

}
