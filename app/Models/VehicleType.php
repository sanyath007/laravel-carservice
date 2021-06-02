<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleType extends Model
{
  protected $connection = 'vehicle';

  protected $table = 'vehicle_types';

  public function vehicle()
  {
      return $this->hasMany('App\Models\Vehicle', 'vehicle_type_id', 'vehicle_type');
  }
}
