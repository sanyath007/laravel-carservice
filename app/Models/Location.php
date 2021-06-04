<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $connection = 'vehicle';
    protected $table = 'locations';

    public function province()
    {
        return $this->belongsTo('App\Models\Changwat', 'changwat', 'chw_id');
    }

    public function district()
    {
        return $this->belongsTo('App\Models\Amphur', 'amphur', 'id');
    }
}
