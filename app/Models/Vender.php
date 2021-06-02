<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vender extends Model
{
    protected $connection = 'vehicle';
    protected $table = 'venders';

    public function vehicle()
    {
        return $this->hasMany('App\Models\Vehicle', 'vender_id', 'vender_id');
    }
}
