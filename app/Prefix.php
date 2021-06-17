<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prefix extends Model
{
    protected $connection = 'person';
    protected $table = 'prefix';

    public function user()
    {
        return $this->hasMany('App\User', 'prefix_id', 'person_prefix');
    }
}
