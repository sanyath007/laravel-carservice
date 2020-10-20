<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Driver;

class DriverController extends Controller
{
    public function index () {
        return view('drivers.list', [
            'drivers' => Driver::where(['status' => '1'])->with('person')->get()
        ]);
    }

    public function create ()
    {
        return view('drivers.newform');
    }

    public function store (Request $req)
    {
        /** Upload attach file */
        $filename = '';
        if ($file = $req->file('attachfile')) {
            $filename = $file->getClientOriginalName();
            $file->move('uploads', $filename);
        }

        $newDriver = new Vehicle();
        $newDriver->vehicle_no = $req['vehicle_no'];   
        $newDriver->vehicle_cate = $req['vehicle_cate'];
        $newDriver->vehicle_type = $req['vehicle_type'];
        $newDriver->menufacturer = $req['menufacturer'];
        $newDriver->model = $req['model'];
        $newDriver->color = $req['color'];
        $newDriver->year = $req['year'];
        $newDriver->capacity = $req['capacity'];
        $newDriver->fuel_type = $req['fuel_type'];
        $newDriver->chassis_no = $req['chassis_no'];
        $newDriver->engine_no = $req['engine_no'];
        $newDriver->reg_no = $req['reg_no'];
        $newDriver->reg_chw = $req['reg_chw'];
        $newDriver->reg_date = $req['reg_date'];
        $newDriver->vender = $req['vender'];
        $newDriver->purchased_method = $req['purchased_method'];
        $newDriver->purchased_date = $req['purchased_date'];
        $newDriver->cam_front = $req['cam_front'];
        $newDriver->cam_back = $req['cam_back'];
        $newDriver->cam_driver = $req['cam_driver'];
        $newDriver->gps = $req['gps'];
        $newDriver->siren = $req['siren'];
        $newDriver->light = $req['light'];
        $newDriver->radio_com = $req['radio_com'];
        $newDriver->tele_med = $req['tele_med'];
        $newDriver->remark = $req['remark'];
        $newDriver->status = '1';
        echo $newDriver;
        // if ($newVehicle->save()) {                            
        //     return redirect('drivers/list');
        // }
    }

}
