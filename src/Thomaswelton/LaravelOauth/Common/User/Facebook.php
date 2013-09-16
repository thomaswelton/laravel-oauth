<?php namespace Thomaswelton\LaravelOauth\Common\User;

class Facebook extends AbstractUser
{
    protected $userEndpoint = 'me?fields=id,name,email';

}
