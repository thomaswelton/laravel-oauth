<?php namespace Thomaswelton\LaravelOauth\Common\User;

class Google extends AbstractUser
{
    protected $userEndpoint = 'https://www.googleapis.com/oauth2/v1/userinfo';

}
