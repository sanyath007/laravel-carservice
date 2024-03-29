<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Driver;
use App\Models\LicenseType;

class DriverController extends Controller
{
    public function formValidate (Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'person_id'     => 'required',
            'description'   => 'required',
            'tel'           => 'required',
            'license_no'    => 'required',
            'license_type'  => 'required',
            'driver_type'   => 'required'
        ]);

        if ($validator->fails()) {
            return [
                'success'   => 0,
                'errors'    => $validator->getMessageBag()->toArray(),
            ];
        } else {
            return [
                'success'   => 1,
                'errors'    => $validator->getMessageBag()->toArray(),
            ];
        }
    }

    public function index (Request $request) {
        $status = array_key_exists('status', $request->all()) ? $request->get('status') : '1';

        return view('drivers.list', [
            'drivers'   => Driver::with('person','person.position')
                                    ->when(!empty($status), function($query) use ($status) {
                                        $query->where('status', $status);
                                    })
                                    ->where('driver_type', '1')
                                    ->get(),
            'status'    => $status
        ]);
    }

    public function detail ($id) {
        return view('drivers.detail', [
            'driver' => Driver::where('driver_id', $id)
                            ->with('person')
                            ->with('person.position')
                            ->first()
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
        if(Driver::where('person_id', $req['person_id'])->count() > 0) {
            return redirect('drivers/new')->with('error', 'พบข้อมูลซ้ำ ไม่สามารถบันทึกข้อมูลได้ !!');
        }

        /** Current date */
        $d = new \DateTime(date('Y-m-d H:i:s'));
        $diffHours = new \DateInterval('PT7H');

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

        /** Upload attach file */
        $thumbnail = uploadFile($req->file('attachfile'), 'uploads/drivers');
        if (!empty($thumbnail)) {
            $newDriver->thumbnail = $thumbnail;
        }

        if ($newDriver->save()) {                            
            return redirect('drivers/list');
        }
    }

    public function edit ($id)
    {
        return view('drivers.editform', [
            'driver'        => Driver::where('driver_id', $id)->first(),
            'licenseTypes'  => LicenseType::all()
        ]);
    }

    public function update (Request $req, $id)
    {
        /** Current date */
        $d = new \DateTime(date('Y-m-d H:i:s'));
        $diffHours = new \DateInterval('PT7H');

        $driver = Driver::find($id);
        $driver->person_id = $req['person_id'];   
        $driver->description = $req['description'];
        $driver->tel = $req['tel'];
        $driver->license_no = $req['license_no'];
        $driver->license_type = $req['license_type'];
        $driver->checkup_date = $req['checkup_date'];
        $driver->checkup_result = $req['checkup_result'];
        $driver->capability_date = $req['capability_date'];
        $driver->capability_result = $req['capability_result'];
        $driver->is_certificated = $req['is_certificated'] ? $req['is_certificated'] : 0;
        $driver->certificated_date = $req['certificated_date'];
        $driver->is_emr = $req['is_emr'] ? $req['is_emr'] : 0;
        $driver->emr_sdate = $req['emr_sdate'];
        $driver->emr_edate = $req['emr_edate'];
        $driver->remark = $req['remark'];
        $driver->driver_type = $req['driver_type']; // 1=พขร หลัก, 2=พขร สำรอง
        $driver->status = '1'; // 0=ไม่ทราบสถานะ, 1=ปฏิบัติงาน, 2=ไปช่วยราชการ, 3=ออก

        /** Upload attach file */
        $thumbnail = uploadFile($req->file('attachfile'), 'uploads/drivers');
        if (!empty($thumbnail)) {
            $driver->thumbnail = $thumbnail;
        }

        if ($driver->save()) {                            
            return redirect('drivers/list');
        }
    }

    public function setStatus(Request $req, $id)
    {
        $driver = Driver::find($id);
        $driver->status = $req['status']; // 0=ไม่ทราบสถานะ, 1=ปฏิบัติงาน, 2=ไม่ได้ปฏิบัติงานแล้ว

        if ($driver->save()) {                            
            return redirect('drivers/list');
        }
    }
}
