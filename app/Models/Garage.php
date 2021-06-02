<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Garage extends Model
{
  protected $connection = 'vehicle';

  protected $table = 'garages';

  public function maintained()
  {
      return $this->hasMany('App\Maintenance', 'garage_id', 'garage_id');
  }
}
