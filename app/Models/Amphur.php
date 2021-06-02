<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Amphur extends Model
{
    protected $connection = 'vehicle';
    protected $table = 'amphur';

    public function location()
    {
        return $this->hasMany('App\Location', 'amphur', 'id');
    }
}
