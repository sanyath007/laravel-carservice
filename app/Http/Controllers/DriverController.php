<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Driver;
use App\LicenseType;

class DriverController extends Controller
{
    public function formValidate (Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'person_id' => 'required',
            'description' => 'required',
            'tel' => 'required',
            'license_no' => 'required',
            'license_type' => 'required'
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

    public function index () {
        return view('drivers.list', [
            'drivers' => Driver::where('status', '1')
                            ->where('driver_type', '1')
                            ->with('person')
                            ->get()
        ]);
    }

    public function create ()
    {
        return view('drivers.newform', [
            'licenseTypes' => LicenseType::all()
        ]);
    }

    public function store (Request $req)
    {
        /** Current date */
        $d = new \DateTime(date('Y-m-d H:i:s'));
        $diffHours = new \DateInterval('PT7H');

        /** Upload attach file */
        $filename = '';
        if ($file = $req->file('attachfile')) {
            $filename = $file->getClientOriginalName();
            $file->move('uploads', $filename);
        }

        $newDriver = new Driver();
        $newDriver->person_id = $req['person_id'];   
        $newDriver->description = $req['description'];
        $newDriver->tel = $req['tel'];
        $newDriver->license_no = $req['license_no'];
        $newDriver->license_type = $req['license_type'];
        $newDriver->checkup_date = $req['checkup_date'];
        $newDriver->checkup_result = $req['checkup_result'];
        $newDriver->capability_date = $req['capability_date'];
        $newDriver->capability_result = $req['capability_result'];
        $newDriver->is_certificated = $req['is_certificated'] ? $req['is_certificated'] : 0;
        $newDriver->certificated_date = $req['certificated_date'];
        $newDriver->is_emr = $req['is_emr'] ? $req['is_emr'] : 0;
        $newDriver->emr_sdate = $req['emr_sdate'];
        $newDriver->emr_edate = $req['emr_edate'];
        $newDriver->remark = $req['remark'];
        $newDriver->driver_type = $req['driver_type']; // 1=พขร หลัก, 2=พขร สำรอง
        $newDriver->status = '1'; // 0=ไม่ทราบสถานะ, 1=ปฏิบัติงาน, 2=ไปช่วยราชการ, 3=ออก

        if ($newDriver->save()) {                            
            return redirect('drivers/list');
        }
    }

}
