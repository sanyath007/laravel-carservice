<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\DriverPrepared;
use App\Models\Driver;
use App\Vehicle;

class PreparedController extends Controller
{
    public function formValidate (Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'doc_no' => 'required',
            'doc_date' => 'required',
            'tax_start_date' => 'required',
            'tax_renewal_date' => 'required',
            'tax_receipt_no' => 'required',
            'tax_charge' => 'required',
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
        $searchdate = Input::get('searchdate');

        return view('prepared.list', [
            'prepareds'       => DriverPrepared::paginate(10),
            'searchdate'    => $searchdate,
        ]);
    }

    public function create ()
    {
        return view('prepared.add', [
            'drivers'   => Driver::all(),
        ]);    	
    }

    public function store (Request $req)
    {
    	$newDriverPrepared = new DriverPrepared();
        $newDriverPrepared->prepared_date       = $req['prepared_date'];
        $newDriverPrepared->prepared_time       = date('H:i:s');
        $newDriverPrepared->driver_id           = $req['driver_id'];
        $newDriverPrepared->period              = $req['period'];
        $newDriverPrepared->bp                  = $req['bp'];
        $newDriverPrepared->bp_text             = $req['bp_text'];
        $newDriverPrepared->stable              = $req['stable'];
        $newDriverPrepared->stable_text         = $req['stable_text'];
        $newDriverPrepared->behav               = $req['behav'];
        $newDriverPrepared->behav_text          = $req['behav_text'];
        $newDriverPrepared->alcohol             = $req['alcohol'];
        $newDriverPrepared->alcohol_text        = $req['alcohol_text'];
        $newDriverPrepared->drug                = $req['drug'];
        $newDriverPrepared->drug_text           = $req['drug_text'];
        $newDriverPrepared->user_id             = $req['user_id'];
        $newDriverPrepared->comment             = $req['comment'];
        $newDriverPrepared->save();   

        return redirect('prepared/list');
    }

    public function edit ()
    {
    	return view('surveys.editform', [

        ]);
    }

    public function update (Request $req)
    {
        // Upload attach file
        $filename = '';
        if ($file = $req->file('attachfile')) {
            $filename = $file->getClientOriginalName();
            $file->move('uploads', $filename);
        }

    	$tax = Tax::find($req['id'])->first();
        $tax->doc_no = $req['doc_no'];
        $tax->doc_date = $req['doc_date'];
        $tax->vehicle_id = $req['vehicle_id'];
        $tax->tax_start_date = $req['tax_start_date'];
        $tax->tax_renewal_date = $req['tax_renewal_date'];
        $tax->tax_receipt_no = $req['tax_receipt_no'];
        $tax->tax_charge = $req['tax_charge'];
        $tax->remark = $req['remark'];
        $tax->attachfile = $req['attachfile'];

        if ($tax->save()) {
            return redirect('surveys/list');
        }
    }

    public function delete ()
    {
    	
    }
}
