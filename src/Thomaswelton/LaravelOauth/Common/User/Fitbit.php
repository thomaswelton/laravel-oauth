<?php namespace Thomaswelton\LaravelOauth\Common\User;

class Fitbit extends AbstractUser
{
    protected $userEndpoint = 'user/-/profile.json';
    protected $uidKey = 'encodedId';

    public function getUserResponse($response)
    {
        return $response->user;
    }

}
