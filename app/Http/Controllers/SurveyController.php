<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Survey;
use App\SurveyDetail;
use App\SurveyBullet as Bullet;
use App\Models\Driver;
use App\Vehicle;

class SurveyController extends Controller
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
        $taxes = Tax::where('is_actived', '=', '1')
                        ->with('vehicle')
                        ->orderBy('tax_start_date', 'DESC')
                        ->orderBy('id', 'DESC')
                        ->paginate(10);

        return view('surveys.list', [
            'taxes' => $taxes,
        ]);
    }

    public function create ()
    {
        return view('surveys.add', [
            'bullets'   => Bullet::all(),
            'vehicles'  => Vehicle::whereNotIn('vehicle_id', [90, 91])
                                ->where(['status' => 1])
                                ->with('type')
                                ->with('changwat')
                                ->orderBy('vehicle_type', 'DESC')
                                ->orderBy('vehicle_cate')
                                ->get(),
            'drivers'   => Driver::all(),
        ]);    	
    }

    public function store (Request $req)
    {
        $bullets = Bullet::all();

    	$newSurvey = new Survey();
        $newSurvey->survey_date     = $req['survey_date'];
        $newSurvey->survey_time     = $req['survey_time'];
        $newSurvey->driver_id       = $req['driver_id'];
        $newSurvey->vehicle_id      = $req['vehicle_id'];
        $newSurvey->user_id         = $req['user_id'];
        $newSurvey->comment         = $req['survey_comment'];

        // if ($newSurvey->save()) {
            // $lastId = $newSurvey->id;

            foreach ($bullets as $bullet) {
                $newDetail = new SurveyDetail();
                $newDetail->bullet_id   = $bullet->id;
                $newDetail->result   = $req[$bullet->id];
                $newDetail->comment   = $req[$bullet->id.'_comment'];
                print_r($newDetail);
                // $newDetail->save();
            }

            // return redirect('surveys/list');
        // }
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
