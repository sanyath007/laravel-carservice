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

    public function service ()
    {
        return view('reports.service', [
            'assignments' => Assignment::orderBy('id','DESC')->paginate(10),
        ]);
    }
    
    public function serviceChart ()
    {
        $sql = "SELECT CONCAT(YEAR(reserve_date), MONTH(reserve_date)) as 'month',
                COUNT(DISTINCT id) as request,
                COUNT(DISTINCT(CASE WHEN (status <> 5) THEN id END)) as service,
                COUNT(DISTINCT(CASE WHEN (status = 5) THEN id END)) as cancel
                FROM reservations
                WHERE (reserve_date BETWEEN '2017-10-01' AND '2018-09-30')
                GROUP BY CONCAT(YEAR(reserve_date), MONTH(reserve_date))
                ORDER BY CONCAT(YEAR(reserve_date), MONTH(reserve_date))";

        return \DB::select($sql);
    }

    public function period ()
    {
        return view('reports.period', [
            'assignments' => Assignment::orderBy('id','DESC')->paginate(10),
        ]);
    }
    
    public function periodChart ()
    {
        $sql = "SELECT CONCAT(YEAR(reserve_date), MONTH(reserve_date)) as 'month',
                COUNT(DISTINCT(CASE WHEN (from_time BETWEEN '00:00:01' AND '07:59:59') THEN id END)) as n,
                COUNT(DISTINCT(CASE WHEN (from_time BETWEEN '08:00:00' AND '12:59:59') THEN id END)) as m,
                COUNT(DISTINCT(CASE WHEN (from_time BETWEEN '13:00:00' AND '15:59:59') THEN id END)) as a,
                COUNT(DISTINCT(CASE WHEN (from_time BETWEEN '16:00:00' AND '23:59:59') THEN id END)) as e
                FROM reservations
                WHERE (reserve_date BETWEEN '2017-10-01' AND '2018-09-30')
                AND (status <> 5)
                GROUP BY CONCAT(YEAR(reserve_date), MONTH(reserve_date))
                ORDER BY CONCAT(YEAR(reserve_date), MONTH(reserve_date))";

        return \DB::select($sql);
    }

    public function depart ()
    {
        return view('reports.depart', [
            'assignments' => Assignment::orderBy('id','DESC')->paginate(10),
        ]);
    }
    
    public function departChart ()
    {
        $sql = "SELECT CONCAT(d.depart_name) as depart,
                COUNT(DISTINCT r.id) as request,
                COUNT(DISTINCT(CASE WHEN (r.status <> 5) THEN r.id END)) as service,
                COUNT(DISTINCT(CASE WHEN (r.status = 5) THEN r.id END)) as cancel
                FROM vehicle_db.reservations r LEFT JOIN db_ksh.depart d ON (r.department=d.depart_id)
                WHERE (r.reserve_date BETWEEN '2017-10-01' AND '2018-09-30')
                GROUP BY CONCAT(r.department,'-',d.depart_name) 
                ORDER BY COUNT(DISTINCT r.id) DESC 
                LIMIT 10 ";

        return \DB::select($sql);
    }

    public function refer ()
    {
        return view('reports.refer', [
            'assignments' => Assignment::orderBy('id','DESC')->paginate(10),
        ]);
    }
    
    public function referChart ()
    {
        $sql = "SELECT
                refer_date, DAY(refer_date) AS d, 
                COUNT(DISTINCT referout_id) AS total,
                COUNT(DISTINCT CASE WHEN (refer_time BETWEEN '00:00:01' AND '07:59:59') THEN referout_id END) AS n,
                COUNT(DISTINCT CASE WHEN (refer_time BETWEEN '08:00:00' AND '15:59:59') THEN referout_id END) AS m,
                COUNT(DISTINCT CASE WHEN (refer_time BETWEEN '16:00:00' AND '23:59:59') THEN referout_id END) AS a
                FROM referout 
                WHERE (refer_date BETWEEN '2018-10-01' AND '2018-10-31')
                AND (with_ambulance='Y')
                GROUP BY refer_date
                ORDER BY refer_date";

        return \DB::connection('hosxp')->select($sql);
    }
}
