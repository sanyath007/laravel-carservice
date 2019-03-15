<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Models\Survey;
use App\Models\SurveyDetail;
use App\Models\SurveyBullet as Bullet;
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
        $searchdate = Input::get('searchdate');

        return view('surveys.list', [
            'surveys'       => Survey::paginate(10),
            'searchdate'    => $searchdate,
        ]);
    }

    public function create ()
    {
        return view('surveys.add', [
            'bullets'   => Bullet::all(),
            'vehicles'  => Vehicle::whereNotIn('vehicle_id', [90, 91])
                                ->where('vehicle_type','<>', 3)
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
        $newSurvey->used_type       = $req['used_type'];
        $newSurvey->user_id         = $req['user_id'];
        $newSurvey->comment         = $req['survey_comment'];
        // print_r($newSurvey);

        if ($newSurvey->save()) {    
            $lastSurveyId   = $newSurvey->id;

            $vehicleCount   = 0;
            $vehicleResult  = 0;
            $driverCount    = 0;
            $driverResult   = 0;

            foreach ($bullets as $bullet) {
                if($bullet->bullet_type == 1) {
                    $vehicleResult += $req[$bullet->id];
                    $vehicleCount++;
                }
                
                if($bullet->bullet_type == 2) {
                    $driverResult += $req[$bullet->id];
                    $driverCount++;
                }

                $newDetail              = new SurveyDetail();
                $newDetail->survey_id   = $lastSurveyId;
                $newDetail->bullet_id   = $bullet->id;
                $newDetail->result      = $req[$bullet->id];
                $newDetail->comment     = $req[$bullet->id.'_comment'];
                $newDetail->save();
            }

            echo 'Vehicle = '.number_format((float)((int)$vehicleResult)/$vehicleCount, 2);
            echo 'Driver = '.number_format((float)((int)$driverResult)/$driverCount, 2);

            /** Updated survey with result_vehicle and result_driver. */
            $survey = Survey::find($lastSurveyId);
            $survey->result_vehicle = number_format((float)((int)$vehicleResult)/$vehicleCount, 2);
            $survey->result_driver  = number_format((float)((int)$driverResult)/$driverCount, 2);
            $survey->save();

            // return redirect('surveys/list');
        }
    }

    public function edit ()
    {
    	return view('surveys.edit', [

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
