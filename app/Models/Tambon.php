<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tambon extends Model
{
    protected $connection = 'vehicle';
    protected $table = 'tambon';

    public function location()
    {
        return $this->hasMany('App\Location', 'tambon', 'id');
    }
}
