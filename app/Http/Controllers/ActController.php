<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Act;
use App\Models\InsuranceCompany;
use App\Models\InsuranceType;

class ActController extends Controller
{
	public function formValidate (Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'doc_no' => 'required',
            'doc_date' => 'required',
            'act_no' => 'required',
            'company' => 'required',
            'act_start_date' => 'required',
            'act_start_time' => 'required',
            'act_renewal_date' => 'required',
            'act_renewal_time' => 'required',
            'act_net' => 'required|numeric',
            'act_stamp' => 'required|numeric',
            'act_vat' => 'required|numeric',
            'act_total' => 'required|numeric',
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
        return view('acts.list', [
            'acts' => Act::where(['status' => 1])
                        ->with('vehicle')
                        ->with('company')
                        ->orderBy('act_start_date', 'DESC')
                        ->orderBy('id', 'DESC')
                        ->paginate(10),
        ]);
    }

    private function uploadFile($file, $destPath) {
        $filename = '';
        if ($file) {
            $filename = date('mdYHis') . uniqid(). '.' .$file->getClientOriginalExtension();
            $file->move($destPath, $filename);
        }

        return $filename;
    }

    public function create ()
    {
        return view('acts.newform', [
            'companies' => InsuranceCompany::all(),
        ]);
    }

    public function store (Request $req)
    {
        $newAct = new Act();
        $newAct->doc_no = $req['doc_no'];
        $newAct->doc_date = $req['doc_date'];
        $newAct->vehicle_id = $req['vehicle_id'];
        $newAct->act_no = $req['act_no'];
        $newAct->insurance_company_id = $req['company'];
        $newAct->act_detail = $req['act_detail'];
        $newAct->act_start_date = $req['act_start_date'];
        $newAct->act_start_time = $req['act_start_time'];
        $newAct->act_renewal_date = $req['act_renewal_date'];
        $newAct->act_renewal_time = $req['act_renewal_time'];
        $newAct->act_net = $req['act_net'];
        $newAct->act_stamp = $req['act_stamp'];
        $newAct->act_vat = $req['act_vat'];
        $newAct->act_total = $req['act_total'];
        $newAct->remark = $req['remark'];
        $newAct->status = '1';

        /** Upload attach file */
        $attachfile = $this->uploadFile($req->file('attachfile'), 'uploads/acts');
        if($attachfile) {
            $newAct->attachfile = $attachfile;
        }

        if ($newAct->save()) {
            $deactivate = Act::where('vehicle_id', '=', $req['vehicle_id'])
                            ->where('id', '<>', $newAct->id)
                            ->update(['status' => '0']);
                            
            return redirect('acts/list');
		}
    }

    public function edit ($id)
    {
        return view('acts.editform', [
            'act'       => Act::find($id),
            'companies' => InsuranceCompany::all()
        ]);
    }

    public function update ($id, Request $req)
    {
        $act = Act::find($id);
        $act->doc_no = $req['doc_no'];
        $act->doc_date = $req['doc_date'];
        $act->act_no = $req['act_no'];
        $act->insurance_company_id = $req['company'];
        $act->act_detail = $req['act_detail'];
        $act->act_start_date = $req['act_start_date'];
        $act->act_start_time = $req['act_start_time'];
        $act->act_renewal_date = $req['act_renewal_date'];
        $act->act_renewal_time = $req['act_renewal_time'];
        $act->act_net = $req['act_net'];
        $act->act_stamp = $req['act_stamp'];
        $act->act_vat = $req['act_vat'];
        $act->act_total = $req['act_total'];        
        $act->remark = $req['remark'];

        /** Upload attach file */
        $attachfile = $this->uploadFile($req->file('attachfile'), 'uploads/acts');
        if($attachfile) {
            $act->attachfile = $attachfile;
        }

        if ($act->save()) {
            return redirect('acts/list');
        }
    }

    public function delete ()
    {

    }
}
