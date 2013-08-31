<?php namespace Thomaswelton\LaravelOauth\Common\User;

class Tumblr extends AbstractUser
{
    protected $userEndpoint = 'user/info';
    protected $uidKey = 'name';

    protected function getUserResponse($response)
    {
        return $response->response->user;
    }

}
