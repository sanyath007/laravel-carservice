<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $connection = 'vehicle';

    protected $table = 'reservations';

    public function vehicle()
    {
        return $this->belongsTo('App\Models\Vehicle', 'vehicle_id', 'vehicle_id');
    }

    public function driver()
    {
        return $this->belongsTo('App\Models\Driver', 'driver_id', 'driver_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'person_id');
    }

    public function passenger()
    {
            return $this->hasMany('App\Models\ReservePassenger', 'id', 'reserve_id');
    }
}
