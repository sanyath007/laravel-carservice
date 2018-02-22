<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Insurance;
use App\InsuranceCompany;
use App\InsuranceType;

class InsuranceController extends Controller
{
	public function formValidate (Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'doc_no' => 'required',
            'doc_date' => 'required',
            'insurance_no' => 'required',
            'insurance_company_id' => 'required',
            'insurance_type' => 'required',
            'insurance_detail' => 'required',
            'insurance_start_date' => 'required',
            'insurance_renewal_date' => 'required',
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
        // Upload attach file
        // var_dump($request->file('attachfile'));
        $filename = '';
        if ($file = $request->file('attachfile')) {
            $filename = $file->getClientOriginalName();
            $file->move('uploads', $filename);
        }

    	$newInsurance = new Insurance();
    	$newInsurance->doc_no = $req['doc_no'];
        $newInsurance->doc_date = $req['doc_date'];
        $newInsurance->insurance_no = $req['insurance_no'];
        $newInsurance->insurance_company_id = $req['company'];
        $newInsurance->insurance_type = $req['insurance_type'];
        $newInsurance->insurance_detail = $req['insurance_detail'];
        $newInsurance->insurance_start_date = $req['insurance_start_date'];
        $newInsurance->insurance_renewal_date = $req['insurance_renewal_date'];

        if ($newInsurance->save()) {

		}
    }

    public function edit ()
    {
    	return view('insurances.editform', [

    	]);
    }

    public function update (Request $req)
    {
        // Upload attach file
        // var_dump($request->file('attachfile'));
        $filename = '';
        if ($file = $request->file('attachfile')) {
            $filename = $file->getClientOriginalName();
            $file->move('uploads', $filename);
        }
    	
        $insurance = Insurance::find($req['id'])->first();
        $insurance->doc_no = $req['doc_no'];
        $insurance->doc_date = $req['doc_date'];
        $insurance->insurance_no = $req['insurance_no'];
        $insurance->insurance_company_id = $req['company'];
        $insurance->insurance_type = $req['insurance_type'];
        $insurance->insurance_detail = $req['insurance_detail'];
        $insurance->insurance_start_date = $req['insurance_start_date'];
        $insurance->insurance_renewal_date = $req['insurance_renewal_date'];

        if ($insurance->save()) {

        }
    }

    public function delete ()
    {
    	
    }
}
