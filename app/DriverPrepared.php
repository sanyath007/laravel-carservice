<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DriverPrepared extends Model
{
  	protected $connection = 'vehicle';
  	protected $table = 'driver_prepared';

  	// public function vehicle()
    //  {
    //      return $this->hasMany('App\Vehicle', 'fuel_type', 'fuel_type_id');
    //  }

    //  public function fuel_used()
    //  {
    //      return $this->belongsTo('App\VehicleFuel', 'fuel_type_id', 'fuel_type_id');
    //  }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'person_id');
    }

    public function driver()
    {
        return $this->belongsTo('App\Models\Driver', 'driver_id', 'driver_id');
    }
}
