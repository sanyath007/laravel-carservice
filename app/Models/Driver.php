<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $connection = 'vehicle';

    protected $table = 'drivers';

    protected $primaryKey = 'driver_id';

    protected $fillable = ['status'];

    public function person()
    {
        return $this->belongsTo('App\User', 'person_id', 'person_id');
    }

    public function licenseType()
    {
        return $this->belongsTo('App\Models\LicenseType', 'license_type', 'license_type_id');
    }

    public function reservation()
    {
        return $this->hasMany('App\Models\Reservations', 'driver_id', 'driver_id');
    }
}
