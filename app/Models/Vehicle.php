<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $connection = 'vehicle';
    protected $table = 'vehicles';
    protected $primaryKey = 'vehicle_id';

    public function cate()
    {
        return $this->belongsTo('App\Models\VehicleCate', 'vehicle_cate', 'vehicle_cate_id');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\VehicleType', 'vehicle_type', 'vehicle_type_id');
    }

    public function method()
    {
        return $this->belongsTo('App\Models\PurchasedMethod', 'purchased_method', 'method_id');
    }

    public function manufacturer()
    {
        return $this->belongsTo('App\Models\Manufacturer', 'manufacturer_id', 'manufacturer_id');
    }

    public function changwat()
    {
        return $this->belongsTo('App\Models\Changwat', 'reg_chw', 'chw_id');
    }

    public function vender()
    {
        return $this->belongsTo('App\Models\Vender', 'vender_id', 'vender_id');
    }

    public function fuel()
    {
        return $this->belongsTo('App\Models\FuelType', 'fuel_type', 'fuel_type_id');
    }

    public function reserve()
    {
        return $this->hasMany('App\Models\Reservation', 'vehicle_id', 'vehicle_id');
    }

    public function maintained()
    {
        return $this->hasMany('App\Models\Maintenance', 'vehicle_id', 'vehicle_id');
    }

    public function tax()
    {
        return $this->hasMany('App\Models\Tax', 'vehicle_id', 'vehicle_id');
    }

    public function fuel_used()
    {
        return $this->hasMany('App\Models\VehicleFuel', 'vehicle_id', 'vehicle_id');
    }

    public function taxactived()
    {
        return $this->hasMany('App\Models\Tax', 'vehicle_id', 'vehicle_id')
                    ->where('is_actived', '=', '1');
    }

    public function insactived()
    {
        return $this->hasMany('App\Models\Insurance', 'vehicle_id', 'vehicle_id')
                    ->where('status', '=', '1');
    }

    public function actsactived()
    {
        return $this->hasMany('App\Models\Act', 'vehicle_id', 'vehicle_id')
                    ->where('status', '=', '1');
    }

    public function mileage()
    {
        return $this->hasMany('App\Models\VehicleMileage', 'vehicle_id', 'vehicle_id')
                    ->orderBy('date_in', 'DESC');
    }
}
