<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Models\DriverPrepared;
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

        if(!empty($searchdate)) {
            $prepareds = DriverPrepared::where('prepared_date', '=', $searchdate)->paginate(10);
        } else {
            $prepareds = DriverPrepared::where('prepared_date', '=', date('Y-m-d'))->paginate(10);
        }

        return view('prepared.list', [
            'prepareds'     => $prepareds,
            'searchdate'    => $searchdate,
        ]);
    }

    public function driverList ()
    {
        $searchMonth = Input::get('searchMonth');        

        if(!empty($searchMonth)) {
            $sdate = $searchMonth . '-01';
            $edate = date("Y-m-t", strtotime($sdate));
        } else {
            $sdate = date('Y-m-1');
            $edate = date("Y-m-t", strtotime($sdate));
        }

        return view('prepared.driver-list', [
            'searchMonth'    => $searchMonth,
            'prepareds'     => $prepareds = DriverPrepared::whereBetween('prepared_date', [$sdate, $edate])->paginate(10),
            'drivers'       => Driver::all(),
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
        $d = new \DateTime(date('Y-m-d H:i:s'));
        $diffHours = new \DateInterval('PT7H');

    	$newDriverPrepared = new DriverPrepared();
        $newDriverPrepared->prepared_date       = $req['prepared_date'];
        $newDriverPrepared->prepared_time       = $d->add($diffHours);
        $newDriverPrepared->driver_id           = $req['driver_id'];
        $newDriverPrepared->period              = $req['period'];
        $newDriverPrepared->bp                  = $req['bp'];
        $newDriverPrepared->bp_text             = $req['bp_text'];
        $newDriverPrepared->stable              = $req['stable'];
        $newDriverPrepared->stable_text         = $req['stable_text'];
        // $newDriverPrepared->behav               = $req['behav'];
        // $newDriverPrepared->behav_text          = $req['behav_text'];
        $newDriverPrepared->alcohol             = $req['alcohol'];
        $newDriverPrepared->alcohol_text        = $req['alcohol_text'];
        $newDriverPrepared->drug                = $req['drug'];
        $newDriverPrepared->drug_text           = $req['drug_text'];
        $newDriverPrepared->user_id             = $req['user_id'];
        $newDriverPrepared->comment             = $req['comment'];
        $newDriverPrepared->save();   

        return redirect('prepared/list');
    }

    public function ajaxGetById ($id)
    {
        return [
            'prepared' => DriverPrepared::find($id),
        ];
    }

    public function detail ($id)
    {
        return view('prepared.detail', [
            'prepared'  => DriverPrepared::find($id),
            'drivers'   => Driver::all(),
        ]);
    }

    public function edit ($id)
    {
    	return view('prepared.edit', [
            'prepared'  => DriverPrepared::find($id),
            'drivers'   => Driver::all(),
        ]);
    }

    public function update (Request $req)
    {
    	$editDriverPrepared = DriverPrepared::find($req['id']);
        // $editDriverPrepared->prepared_date       = $req['prepared_date'];
        // $editDriverPrepared->prepared_time       = date('H:i:s');
        $editDriverPrepared->driver_id           = $req['driver_id'];
        $editDriverPrepared->period              = $req['period'];
        $editDriverPrepared->bp                  = $req['bp'];
        $editDriverPrepared->bp_text             = $req['bp_text'];
        $editDriverPrepared->stable              = $req['stable'];
        $editDriverPrepared->stable_text         = $req['stable_text'];
        // $editDriverPrepared->behav               = $req['behav'];
        // $editDriverPrepared->behav_text          = $req['behav_text'];
        $editDriverPrepared->alcohol             = $req['alcohol'];
        $editDriverPrepared->alcohol_text        = $req['alcohol_text'];
        $editDriverPrepared->drug                = $req['drug'];
        $editDriverPrepared->drug_text           = $req['drug_text'];
        $editDriverPrepared->user_id             = $req['user_id'];
        $editDriverPrepared->comment             = $req['comment'];

        if ($editDriverPrepared->save()) {
            return redirect('prepared/list');
        }
    }

    public function delete ()
    {
    	
    }
}
