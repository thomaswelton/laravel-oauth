<?php namespace Thomaswelton\LaravelOauth\Common\User;

class SoundCloud extends AbstractUser
{
    protected $userEndpoint = '/me?format=json';

}
