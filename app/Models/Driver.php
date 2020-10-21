<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
  protected $connection = 'vehicle';

  protected $table = 'drivers';

  public function person()
  {
      return $this->belongsTo('App\User', 'person_id', 'person_id');
  }

  public function licenseType()
  {
      return $this->belongsTo('App\LicenseType', 'license_type', 'license_type_id');
  }

  public function reservation()
  {
      return $this->hasMany('App\Reservations', 'driver_id', 'driver_id');
  }
}
