<?php namespace Thomaswelton\LaravelOauth\Common\User;

class Foursquare extends AbstractUser
{
    protected $userEndpoint = 'users/self';

    public function getUserResponse($response)
    {
        return $response->response->user;
    }

}
