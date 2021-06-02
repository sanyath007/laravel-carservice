<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleMileage extends Model
{
    protected $connection = 'vehicle';
    protected $table = 'vehicle_mileage';

    public function vehicle()
    {
        return $this->hasMany('App\Models\Vehicle', 'vehicle_id', 'vehicle_id');
    }
}
