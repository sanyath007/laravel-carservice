<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Vehicle;
use App\Driver;

class VehicleController extends Controller
{
    public function index () 
    {
        $status = (Input::get('vehicleStatus')=='') ? 0 : Input::get('vehicleStatus');

        if($status != 0) {
            $vehicles = Vehicle::where(['status' => $status])
                                ->with('cate')
                                ->with('type')
                                ->with('method')
                                ->with('manufacturer')
                                ->with('changwat')
                                ->with('vender')
                                ->with('fuel')
                                ->with('taxactived')                          
                                ->orderBy('vehicle_type', 'ASC')
                                ->orderBy('vehicle_cate', 'ASC')
                                ->orderBy('vehicle_no', 'ASC')
                                ->paginate(12);
        } else {
            $vehicles = Vehicle::where(['status' => 1])
                                ->with('cate')
                                ->with('type')
                                ->with('method')
                                ->with('manufacturer')
                                ->with('changwat')
                                ->with('vender')
                                ->with('fuel')
                                ->with('taxactived')                          
                                ->with('insactived')                          
                                ->with('actsactived')                          
                                ->orderBy('vehicle_type', 'ASC')
                                ->orderBy('vehicle_cate', 'ASC')
                                ->orderBy('vehicle_no', 'ASC')
                                ->paginate(12);
        }

        return view('vehicles.list', [
            // 1=ใช้งาน,2=ให้ยืม,3=เสีย (อยู่ระหว่างซ่อม),4=จำหน่าย,5=โอน,9=เครื่องมืออื่นๆ (ไม่ใช่รถ)
            'vehicles' => $vehicles,
            'vehicleStatus' => $status,
        ]);
    }

    public function detail($id) 
    {
        // $vehicle = Vehicle::where(['vehicle_id' => $id])
        //                         ->with('cate')
        //                         ->with('type')
        //                         ->with('method')
        //                         ->with('manufacturer')
        //                         ->with('changwat')
        //                         ->with('vender')
        //                         ->with('fuel')
        //                         ->with('taxactived')                          
        //                         ->with('insactived')                          
        //                         ->with('actsactived')
        //                         ->first();
        // var_dump($vehicle);         
        return view('vehicles.detail', [
            'vehicle' => Vehicle::where(['vehicle_id' => $id])
                                ->with('cate')
                                ->with('type')
                                ->with('method')
                                ->with('manufacturer')
                                ->with('changwat')
                                ->with('vender')
                                ->with('fuel')
                                ->with('taxactived')                          
                                ->with('insactived')                          
                                ->with('actsactived')
                                ->first()
        ]);
    }

    public function ajaxvehicles () 
    {
        return [
            'vehicles' => Vehicle::where(['status' => '1'])
                                ->with('cate')
                                ->with('type')
                                ->with('method')
                                ->with('manufacturer')
                                ->with('changwat')
                                ->with('vender')
                                ->with('fuel')                                
                                ->orderBy('vehicle_type', 'ASC')
                                ->orderBy('vehicle_cate', 'ASC')
                                ->paginate(10)
        ];
    }
}
