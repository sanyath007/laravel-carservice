<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tax;

class TaxController extends Controller
{
    public function formValidate (Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'doc_no' => 'required',
            'doc_date' => 'required',
            'tax_start_date' => 'required',
            'tax_renewal_date' => 'required',
            'tax_receipt_no' => 'required',
            'tax_charge' => 'required|numeric',
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
        $taxes = Tax::where('is_actived', '=', '1')
                        ->with('vehicle')
                        ->orderBy('tax_start_date', 'DESC')
                        ->orderBy('id', 'DESC')
                        ->paginate(10);

        return view('taxes.list', [
            'taxes' => $taxes,
        ]);
    }

    public function create ()
    {
        return view('taxes.newform');    	
    }

    public function store (Request $req)
    {
        $newTax = new Tax();
        $newTax->doc_no = $req['doc_no'];
        $newTax->doc_date = $req['doc_date'];
        $newTax->vehicle_id = $req['vehicle_id'];
        $newTax->tax_start_date = $req['tax_start_date'];
        $newTax->tax_renewal_date = $req['tax_renewal_date'];
        $newTax->tax_receipt_no = $req['tax_receipt_no'];
        $newTax->tax_charge = $req['tax_charge'];
        $newTax->remark = $req['remark'];
        $newTax->is_actived = '1';
        $newTax->status = '1';

        // Upload attach file        
        $filename = uploadFile($req->file('attachfile'), 'uploads/taxes');
        if ($filename != '') {
            $newTax->attachfile = $filename;
        }

        if ($newTax->save()) {
            $deactivate = Tax::where('vehicle_id', '=', $req['vehicle_id'])
                            ->where('id', '<>', $newTax->id)
                            ->update(['is_actived' => '0']);
                            
            return redirect('taxes/list');
        }
    }

    public function edit ($id)
    {
        return view('taxes.edit-form', [
            'tax'   => Tax::with('vehicle')->find($id)
        ]);
    }

    public function update ($id, Request $req)
    {
        $tax = Tax::find($id);
        $tax->doc_no = $req['doc_no'];
        $tax->doc_date = $req['doc_date'];
        $tax->vehicle_id = $req['vehicle_id'];
        $tax->tax_start_date = $req['tax_start_date'];
        $tax->tax_renewal_date = $req['tax_renewal_date'];
        $tax->tax_receipt_no = $req['tax_receipt_no'];
        $tax->tax_charge = $req['tax_charge'];
        $tax->remark = $req['remark'];

        // Upload attach file
        $filename = uploadFile($req->file('attachfile'), 'uploads/taxes');
        if ($filename != '') {
            $tax->attachfile = $filename;
        }

        if ($tax->save()) {
            return redirect('taxes/list');
        }
    }

    public function delete ()
    {
        
    }
}
