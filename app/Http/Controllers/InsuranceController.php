<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Insurance;
use App\Models\InsuranceCompany;
use App\Models\InsuranceType;

class InsuranceController extends Controller
{
	public function formValidate (Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'doc_no' => 'required',
            'doc_date' => 'required',
            'insurance_no' => 'required',
            'company' => 'required',
            'insurance_type' => 'required',
            'insurance_detail' => 'required',
            'insurance_start_date' => 'required',
            'insurance_start_time' => 'required',
            'insurance_renewal_date' => 'required',
            'insurance_renewal_time' => 'required',
            'insurance_net' => 'required|numeric',
            'insurance_stamp' => 'required|numeric',
            'insurance_vat' => 'required|numeric',
            'insurance_total' => 'required|numeric',
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
        return view('insurances.list', [
            'insurances' => Insurance::where(['status' => 1])
                                ->with('vehicle')
                                ->with('company')
                                ->with('type')
                                ->orderBy('insurance_start_date', 'DESC')
                                ->orderBy('id', 'DESC')
                                ->paginate(10),
        ]);
    }

    public function create ()
    {
        return view('insurances.newform', [
            'companies' => InsuranceCompany::all(),
            'types'	=> InsuranceType::all(),
        ]);
    }

    public function store (Request $req)
    {
        $newInsurance = new Insurance();
        $newInsurance->doc_no = $req['doc_no'];
        $newInsurance->doc_date = $req['doc_date'];
        $newInsurance->vehicle_id = $req['vehicle_id'];
        $newInsurance->insurance_no = $req['insurance_no'];
        $newInsurance->insurance_company_id = $req['company'];
        $newInsurance->insurance_type = $req['insurance_type'];
        $newInsurance->insurance_detail = $req['insurance_detail'];
        $newInsurance->insurance_start_date = $req['insurance_start_date'];
        $newInsurance->insurance_start_time = $req['insurance_start_time'];
        $newInsurance->insurance_renewal_date = $req['insurance_renewal_date'];
        $newInsurance->insurance_renewal_time = $req['insurance_renewal_time'];
        $newInsurance->insurance_net = $req['insurance_net'];
        $newInsurance->insurance_stamp = $req['insurance_stamp'];
        $newInsurance->insurance_vat = $req['insurance_vat'];
        $newInsurance->insurance_total = $req['insurance_total'];
        $newInsurance->remark = $req['remark'];
        $newInsurance->status = '1';

        // Upload attach file
        $attachfile = uploadFile($req->file('attachfile'),'uploads/insurances');
        if(!empty($attachfile)) {
            $newInsurance->attachfile = $attachfile;
        }

        if ($newInsurance->save()) {
            $deactivate = Insurance::where('vehicle_id', '=', $req['vehicle_id'])
                            ->where('id', '<>', $newInsurance->id)
                            ->update(['status' => '0']);

            return redirect('insurances/list');
		}
    }

    public function edit($id)
    {
        return view('insurances.editform', [
            'insurance' => Insurance::with('vehicle')->find($id),
            'companies' => InsuranceCompany::all(),
            'types'	=> InsuranceType::all(),
        ]);
    }

    public function update($id, Request $req)
    {
        $insurance = Insurance::find($id);
        $insurance->doc_no = $req['doc_no'];
        $insurance->doc_date = $req['doc_date'];
        $insurance->vehicle_id = $req['vehicle_id'];
        $insurance->insurance_no = $req['insurance_no'];
        $insurance->insurance_company_id = $req['company'];
        $insurance->insurance_type = $req['insurance_type'];
        $insurance->insurance_detail = $req['insurance_detail'];
        $insurance->insurance_start_date = $req['insurance_start_date'];
        $insurance->insurance_start_time = $req['insurance_start_time'];
        $insurance->insurance_renewal_date = $req['insurance_renewal_date'];
        $insurance->insurance_renewal_time = $req['insurance_renewal_time'];
        $insurance->insurance_net = $req['insurance_net'];
        $insurance->insurance_stamp = $req['insurance_stamp'];
        $insurance->insurance_vat = $req['insurance_vat'];
        $insurance->insurance_total = $req['insurance_total'];
        $insurance->remark = $req['remark'];

        // Upload attach file
        $attachfile = uploadFile($req->file('attachfile'),'uploads/insurances');
        if(!empty($attachfile)) {
            $insurance->attachfile = $attachfile;
        }

        var_dump($insurance);
        if ($insurance->save()) {
            return redirect('insurances/list');
        }
    }

    public function delete($id)
    {

    }
}
