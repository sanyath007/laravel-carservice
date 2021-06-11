<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Act extends Model
{
    protected $connection = 'vehicle';
    protected $table = 'vehicle_acts';

    public function vehicle()
    {
        return $this->belongsTo('App\Models\Vehicle', 'vehicle_id', 'vehicle_id');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\InsuranceCompany', 'insurance_company_id', 'insurance_company_id');
    }
}
