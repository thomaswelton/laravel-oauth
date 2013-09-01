<?php namespace Thomaswelton\LaravelOauth\Eloquent;

use Illuminate\Database\Eloquent\Model as Eloquent;

class AbstractModel extends Eloquent
{
    public function user()
    {
        return $this->belongsTo('User');
    }
}
