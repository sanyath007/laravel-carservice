<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LicenseType extends Model
{
    protected $connection = 'vehicle';
    protected $table = 'license_types';

    public function driver()
    {
        return $this->hasMany('App\Model\Driver', 'license_type_id', 'license_type');
    }
}
