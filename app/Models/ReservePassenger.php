<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservePassenger extends Model
{
  protected $connection = 'vehicle';

  protected $table = 'reserve_passengers';

  public function reserve()
  {
    return $this->belongsTo('App\Models\Reservation', 'reserve_id', 'id');
  }

  public function user()
  {
    return $this->belongsTo('App\User', 'person_id', 'person_id');
  }
}
