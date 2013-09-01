<?php namespace Thomaswelton\LaravelOauth\Eloquent;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Carbon\Carbon;

class AbstractModel extends Eloquent
{
    public function user()
    {
        return $this->belongsTo('User');
    }

    public function getExpireTimeAttribute($value){
        return Carbon::createFromTimestamp($value);
    }
}
