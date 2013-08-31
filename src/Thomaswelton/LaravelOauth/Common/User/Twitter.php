<?php namespace Thomaswelton\LaravelOauth\Common\User;

class Twitter extends AbstractUser
{
    protected $userEndpoint = '/account/verify_credentials.json';

}
