<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acts extends Model
{
  	protected $connection = 'vehicle';
  	protected $table = 'vehicle_acts';

    public function vehicle()
    {
        return $this->belongsTo('App\Vehicle', 'vehicle_id', 'vehicle_id');
    }

    public function company()
    {
        return $this->belongsTo('App\InsuranceCompany', 'insurance_company_id', 'insurance_company_id');
    }
}
