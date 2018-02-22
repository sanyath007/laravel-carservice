<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use App\ReservePassenger;
use App\Maintenance;
use App\Vehicle;
use App\Driver;
use App\Location;
use App\Department;
use App\Ward;
use App\Assignment;
use App\AssignmentReserve;

class ReportController extends Controller
{
	public function reserve () {
        return view('reports.reservation', [
            'vehicles' => Vehicle::where(['status' => '1'])
                                ->with('cate')
                                ->with('type')
                                ->with('method')
                                ->with('manufacturer')
                                ->with('changwat')
                                ->with('vender')
                                ->with('fuel')
                                ->paginate(10),
            'reservations' => Reservation::with('user')
                                ->orderBy('id', 'DESC')
                                // ->orderBy('from_date', 'DESC')
                                // ->orderBy('reserve_date', 'ASC')
                                ->paginate(10)
        ]);
    }
    public function drive () 
    {
    	$assignments = Assignment::orderBy('id','DESC')->paginate(10);

    	return view('reports.drive', [
    		'assignments' => $assignments,
    	]);
    }
}
