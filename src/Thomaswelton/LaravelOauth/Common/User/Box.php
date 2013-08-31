<?php namespace Thomaswelton\LaravelOauth\Common\User;

class Box extends AbstractUser
{
    protected $userEndpoint = 'folders/0';
    protected $uidKey = 'id';

    protected function getUserResponse($response)
    {
        return $response->owned_by;
    }

}
