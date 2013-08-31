<?php namespace Thomaswelton\LaravelOauth\Common\User;

class Amazon extends AbstractUser
{
    protected $userEndpoint = 'user/profile';
    protected $uidKey = 'user_id';

}
