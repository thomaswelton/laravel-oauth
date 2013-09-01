<?php namespace Thomaswelton\LaravelOauth;

use Illuminate\Database\Eloquent\Model as Eloquent;

class OAuthUser extends Eloquent
{
    protected $table = 'oauth_users';

    public function user()
    {
        return $this->belongsTo('User');
    }
}
