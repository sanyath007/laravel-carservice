<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InsuranceType extends Model
{
    protected $connection = 'vehicle';
    protected $table = 'insurance_types';

    public function insurance()
    {
        return $this->hasMany('App\Models\insurance', 'insurance_type_id', 'insurance_type');
    }
}
