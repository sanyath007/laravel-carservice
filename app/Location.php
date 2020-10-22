<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
  	protected $connection = 'vehicle';
  	protected $table = 'locations';

  	public function province()
    {
        return $this->belongsTo('App\Changwat', 'changwat', 'chw_id');
    }

    public function district()
    {
        return $this->belongsTo('App\Amphur', 'amphur', 'id');
    }
}
