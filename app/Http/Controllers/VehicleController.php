<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Models\Vehicle;
use App\Models\Garage;
use App\Driver;
use App\Models\Changwat;
use App\Models\FuelType;
use App\Models\Manufacturer;
use App\Models\Vender;
use App\Models\VehicleCate;
use App\Models\VehicleType;
use App\Models\VehicleMileage;
use App\Models\PurchasedMethod;

class VehicleController extends Controller
{
    public function formValidate (Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'purchased_date' => 'required',
            'manufacturer' => 'required',
            'color' => 'required',
            'year' => 'required',
            'engine_no' => 'required',
            'chassis_no' => 'required',
            'capacity' => 'required',
            'fuel_type' => 'required',
            'vehicle_cate' => 'required',
            'vehicle_type' => 'required',
            'reg_no' => 'required',
            'reg_chw' => 'required',
            'reg_date' => 'required',
            'vender' => 'required',
        ]);

        if ($validator->fails()) {
            return [
                'success' => 0,
                'errors' => $validator->getMessageBag()->toArray(),
            ];
        } else {
            return [
                'success' => 1,
                'errors' => $validator->getMessageBag()->toArray(),
            ];
        }
    }

    public function index () 
    {
        $status = (Input::get('vehicleStatus')=='') ? 0 : Input::get('vehicleStatus');

        if($status != 0) {
            $vehicles = Vehicle::where('status', $status)
                            ->where('vehicle_cate', '<>', '99')
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
                            ->where('vehicle_cate', '<>', '99')
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

        // 1=ใช้งาน,2=ให้ยืม,3=เสีย (อยู่ระหว่างซ่อม),4=จำหน่าย,5=โอน,9=เครื่องมืออื่นๆ (ไม่ใช่รถ)
        return view('vehicles.list', [
            'vehicles' => $vehicles,
            'vehicleStatus' => $status,
        ]);
    }

    public function detail($id) 
    {        
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
            'methods' => PurchasedMethod::all(),
        ]);
    }

    public function store (Request $req)
    {
        /** Current date */
        $d = new \DateTime(date('Y-m-d H:i:s'));
        $diffHours = new \DateInterval('PT7H');

        $newVehicle = new Vehicle();
        $newVehicle->vehicle_no = $req['vehicle_no'];   
        $newVehicle->vehicle_cate = $req['vehicle_cate'];
        $newVehicle->vehicle_type = $req['vehicle_type'];
        $newVehicle->manufacturer_id = $req['manufacturer'];
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
        $newVehicle->vender_id = $req['vender'];
        $newVehicle->purchased_date = $req['purchased_date'];
        $newVehicle->purchased_method = $req['method'];
        $newVehicle->purchased_cost = $req['cost'];
        $newVehicle->date_in = $d->add($diffHours);

        /** Accessories */
        $newVehicle->cam_front = $req['cam_front'] ? $req['cam_front'] : 0;
        $newVehicle->cam_back = $req['cam_back'] ? $req['cam_back'] : 0;
        $newVehicle->cam_driver = $req['cam_driver'] ? $req['cam_driver'] : 0;
        $newVehicle->gps = $req['gps'] ? $req['gps'] : 0;
        $newVehicle->siren = $req['siren'] ? $req['siren'] : 0;
        $newVehicle->light = $req['light'] ? $req['light'] : 0;
        $newVehicle->radio_com = $req['radio_com'] ? $req['radio_com'] : 0;
        $newVehicle->tele_med = $req['tele_med'] ? $req['tele_med'] : 0;
        $newVehicle->remark = $req['remark'];
        $newVehicle->status = '1';

        /** Upload attach file */
        $thumbnail = uploadThumbnail($req->file('attachfile'), 'uploads/vehicles/thumbnails');
        if ($thumbnail != '') {
            $newVehicle->thumbnail = $thumbnail;
        }

        if ($newVehicle->save()) {                            
            return redirect('vehicles/list');
        }
    }

    public function edit($id)
    {
        return view('vehicles.edit-form', [
            'vehicle' => Vehicle::find($id),
            'vCates' => VehicleCate::all(),
            'vTypes' => VehicleType::all(),
            'fuelTypes' => FuelType::all(),
            'changwats' => Changwat::all(),
            'manufacturers' => Manufacturer::all(),
            'venders' => Vender::all(),
            'methods' => PurchasedMethod::all(),
        ]);
    }

    public function update(Request $req, $id)
    {
        /** Current date */
        $d = new \DateTime(date('Y-m-d H:i:s'));
        $diffHours = new \DateInterval('PT7H');

        $vehicle = Vehicle::find($id);
        $vehicle->vehicle_no = $req['vehicle_no'];   
        $vehicle->vehicle_cate = $req['vehicle_cate'];
        $vehicle->vehicle_type = $req['vehicle_type'];
        $vehicle->manufacturer_id = $req['manufacturer'];
        $vehicle->model = $req['model'];
        $vehicle->color = $req['color'];
        $vehicle->year = $req['year'];
        $vehicle->capacity = $req['capacity'];
        $vehicle->fuel_type = $req['fuel_type'];
        $vehicle->chassis_no = $req['chassis_no'];
        $vehicle->engine_no = $req['engine_no'];
        $vehicle->reg_no = $req['reg_no'];
        $vehicle->reg_chw = $req['reg_chw'];
        $vehicle->reg_date = $req['reg_date'];
        $vehicle->vender_id = $req['vender'];
        $vehicle->purchased_date = $req['purchased_date'];
        $vehicle->purchased_method = $req['method'];
        $vehicle->purchased_cost = $req['cost'];
        $vehicle->date_in = $d->add($diffHours);

        /** Accessories */
        $vehicle->cam_front = $req['cam_front'] ? $req['cam_front'] : 0;
        $vehicle->cam_back = $req['cam_back'] ? $req['cam_back'] : 0;
        $vehicle->cam_driver = $req['cam_driver'] ? $req['cam_driver'] : 0;
        $vehicle->gps = $req['gps'] ? $req['gps'] : 0;
        $vehicle->siren = $req['siren'] ? $req['siren'] : 0;
        $vehicle->light = $req['light'] ? $req['light'] : 0;
        $vehicle->radio_com = $req['radio_com'] ? $req['radio_com'] : 0;
        $vehicle->tele_med = $req['tele_med'] ? $req['tele_med'] : 0;
        $vehicle->remark = $req['remark'];
        $vehicle->status = $req['status'];

        /** Upload attach file */
        $thumbnail = uploadFile($req->file('attachfile'), 'uploads/vehicles/thumbnails');
        if ($thumbnail != '') {
            $vehicle->thumbnail = $thumbnail;
        }

        if ($vehicle->save()) {                            
            return redirect('vehicles/list');
        }
    }

    public function delete($id)
    {
        if(Vehicle::where('vehicle_id', $id)->delete()) {
            return redirect('vehicles/list')->with('status', 'ลบรายการรถ ID ' .$id. ' เรียบร้อบแล้ว!!');
        } else {
            return redirect('vehicles/list')->with('error', 'พบข้อผิดพลาด ไม่สามารถลบรายการได้!!');
        }
    }

    public function ajaxvehicles () 
    {
        return [
            'vehicles'  => Vehicle::where(['status' => '1'])
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
