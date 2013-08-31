<?php namespace Thomaswelton\LaravelOauth\Common\User;

class Dropbox extends AbstractUser
{
    protected $userEndpoint = 'account/info';
    protected $uidKey = 'uid';

}
