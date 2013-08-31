<?php namespace Thomaswelton\LaravelOauth\Common\User;

class Paypal extends AbstractUser
{
    protected $userEndpoint = '/identity/openidconnect/userinfo/?schema=openid';
    protected $uidKey = 'user_id';

}
