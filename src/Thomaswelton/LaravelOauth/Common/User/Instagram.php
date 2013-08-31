<?php namespace Thomaswelton\LaravelOauth\Common\User;

class Instagram extends AbstractUser
{
    protected $userEndpoint = 'users/self';

    public function getUserResponse($response)
    {
        return $response->data;
    }

}
