<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
  protected $connection = 'vehicle';

  protected $table = 'vehicle_maintenances';

  protected $primaryKey = 'maintained_id';

  public function vehicle()
  {
    return $this->belongsTo('App\Models\Vehicle', 'vehicle_id', 'vehicle_id');
  }  

  public function garage()
  {
    return $this->belongsTo('App\Models\Garage', 'garage_id', 'garage_id');
  }

  public function user()
  {
    return $this->belongsTo('App\User', 'staff', 'person_id');
  }

  // public function bringDetail()
  // {
  //   return $this->hasMany('App\BringDetail', 'bring_id', 'id');
  // }
}
