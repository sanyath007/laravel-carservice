<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleCate extends Model
{
  protected $connection = 'vehicle';

  protected $table = 'vehicle_cates';

  public function vehicle()
  {
      return $this->hasMany('App\Models\Vehicle', 'vehicle_cate_id', 'vehicle_cate');
  }
}
