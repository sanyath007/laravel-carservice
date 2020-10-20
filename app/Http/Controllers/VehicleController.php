<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Vehicle;
use App\Garage;
use App\Driver;
use App\Changwat;
use App\FuelType;
use App\Manufacturer;
use App\Vender;
use App\VehicleCate;
use App\VehicleType;
use App\VehicleMileage;

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
                                ->with('mileage')
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
                                ->with('mileage')
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
                                ->with('mileage')
                                ->first()
        ]);
    }

    public function create ()
    {
        return view('vehicles.newform', [
            'vCates' => VehicleCate::all(),
            'vTypes' => VehicleType::all(),
            'fuelTypes' => FuelType::all(),
            'changwats' => Changwat::all(),
            'manufacturers' => Manufacturer::all(),
            'venders' => Vender::all(),
        ]);
    }

    public function store (Request $req)
    {
        /** Upload attach file */
        $filename = '';
        if ($file = $req->file('attachfile')) {
            $filename = $file->getClientOriginalName();
            $file->move('uploads', $filename);
        }

        $newVehicle = new Vehicle();
        $newVehicle->vehicle_no = $req['vehicle_no'];   
        $newVehicle->vehicle_cate = $req['vehicle_cate'];
        $newVehicle->vehicle_type = $req['vehicle_type'];
        $newVehicle->menufacturer = $req['menufacturer'];
        $newVehicle->model = $req['model'];
        $newVehicle->color = $req['color'];
        $newVehicle->year = $req['year'];
        $newVehicle->capacity = $req['capacity'];
        $newVehicle->fuel_type = $req['fuel_type'];
        $newVehicle->chassis_no = $req['chassis_no'];
        $newVehicle->engine_no = $req['engine_no'];
        $newVehicle->reg_no = $req['reg_no'];
        $newVehicle->reg_chw = $req['reg_chw'];
        $newVehicle->reg_date = $req['reg_date'];
        $newVehicle->vender = $req['vender'];
        $newVehicle->purchased_method = $req['purchased_method'];
        $newVehicle->purchased_date = $req['purchased_date'];
        $newVehicle->cam_front = $req['cam_front'];
        $newVehicle->cam_back = $req['cam_back'];
        $newVehicle->cam_driver = $req['cam_driver'];
        $newVehicle->gps = $req['gps'];
        $newVehicle->siren = $req['siren'];
        $newVehicle->light = $req['light'];
        $newVehicle->radio_com = $req['radio_com'];
        $newVehicle->tele_med = $req['tele_med'];
        $newVehicle->remark = $req['remark'];
        $newVehicle->status = '1';
        echo $newVehicle;
        // if ($newVehicle->save()) {                            
        //     return redirect('vehicles/list');
        // }
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
