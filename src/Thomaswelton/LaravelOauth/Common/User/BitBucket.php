<?php namespace Thomaswelton\LaravelOauth\Common\User;

class BitBucket extends AbstractUser
{
    protected $userEndpoint = 'user';

    protected function getUserResponse($response)
    {
        return $response->user;
    }

    // Doesn't return a user ID and can change username
    public function getUID()
    {
        throw new \Exception("Login with BitBucket not supported", 1);
    }

}
