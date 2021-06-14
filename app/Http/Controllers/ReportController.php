<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\Reservation;
use App\Models\ReservePassenger;
use App\Models\Maintenance;
use App\Models\Vehicle;
use App\Models\Driver;
use App\Models\Location;
use App\Department;
use App\Ward;
use App\Models\Assignment;
use App\Models\AssignmentReserve;
use App\Models\Budget;
use PDO;

class ReportController extends Controller
{
	public function reserve () {
        return view('reports.reservation', [
            'vehicles'      => Vehicle::where(['status' => '1'])
                                ->with('cate')
                                ->with('type')
                                ->with('method')
                                ->with('manufacturer')
                                ->with('changwat')
                                ->with('vender')
                                ->with('fuel')
                                ->paginate(10),
            'reservations'  => Reservation::with('user')
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
    
    public function serviceChart ($year)
    {
        $sdate = ($year - 1). '-10-01';
        $edate = $year. '-09-30';

        $sql = "SELECT CONCAT(YEAR(from_date), MONTH(from_date)) as 'month',
                COUNT(DISTINCT id) as request,
                COUNT(DISTINCT(CASE WHEN (status <> 5) THEN id END)) as service,
                COUNT(DISTINCT(CASE WHEN (status = 5) THEN id END)) as cancel
                FROM reservations
                WHERE (from_date BETWEEN '$sdate' AND '$edate')
                GROUP BY CONCAT(YEAR(from_date), MONTH(from_date))
                ORDER BY CONCAT(YEAR(from_date), MONTH(from_date))";

        return \DB::select($sql);
    }

    public function period ()
    {
        return view('reports.period', [
            'assignments' => Assignment::orderBy('id','DESC')->paginate(10),
        ]);
    }
    
    public function periodChart ($month)
    {
        $sdate = $month . '-01';
        $edate = date("Y-m-t", strtotime($sdate));

        $sql = "SELECT from_date AS reserv_date, DAY(from_date) AS d, 
                COUNT(DISTINCT(CASE WHEN (from_time BETWEEN '00:00:01' AND '07:59:59') THEN id END)) as n,
                COUNT(DISTINCT(CASE WHEN (from_time BETWEEN '08:00:00' AND '12:59:59') THEN id END)) as m,
                COUNT(DISTINCT(CASE WHEN (from_time BETWEEN '13:00:00' AND '15:59:59') THEN id END)) as a,
                COUNT(DISTINCT(CASE WHEN (from_time BETWEEN '16:00:00' AND '23:59:59') THEN id END)) as e
                FROM reservations
                WHERE (from_date BETWEEN '$sdate' AND '$edate')
                AND (status <> 5)
                GROUP BY from_date
                ORDER BY from_date ";

        return \DB::select($sql);
    }

    public function depart ()
    {
        return view('reports.depart', [
            'assignments' => Assignment::orderBy('id','DESC')->paginate(10),
        ]);
    }
    
    public function departChart ($month)
    {
        $sdate = $month . '-01';
        $edate = date("Y-m-t", strtotime($sdate));

        $sql = "SELECT CONCAT(d.depart_name) as depart,
                COUNT(DISTINCT r.id) as request,
                COUNT(DISTINCT(CASE WHEN (r.status <> 5) THEN r.id END)) as service,
                COUNT(DISTINCT(CASE WHEN (r.status = 5) THEN r.id END)) as cancel
                FROM vehicle_db.reservations r LEFT JOIN db_ksh.depart d ON (r.department=d.depart_id)
                WHERE (r.reserve_date BETWEEN '$sdate' AND '$edate')
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
    
    public function referChart ($month)
    {
        $sdate = $month . '-01';
        $edate = date("Y-m-t", strtotime($sdate));

        $sql = "SELECT refer_date, DAY(refer_date) AS d, 
                COUNT(DISTINCT referout_id) AS total,
                COUNT(DISTINCT CASE WHEN (refer_time BETWEEN '00:00:01' AND '07:59:59') THEN referout_id END) AS n,
                COUNT(DISTINCT CASE WHEN (refer_time BETWEEN '08:00:00' AND '15:59:59') THEN referout_id END) AS m,
                COUNT(DISTINCT CASE WHEN (refer_time BETWEEN '16:00:00' AND '23:59:59') THEN referout_id END) AS a
                FROM referout 
                WHERE (refer_date BETWEEN '$sdate' AND '$edate')
                AND (with_ambulance='Y')
                GROUP BY refer_date
                ORDER BY refer_date";

        return \DB::connection('hosxp')->select($sql);
    }

    public function fuelDay ()
    {
        return view('reports.fuel-day', [
            'assignments' => Assignment::orderBy('id','DESC')->paginate(10),
        ]);
    }
    
    public function fuelDayChart ($month)
    {
        $year   = (Input::get('selectMonth')) ? Input::get('selectMonth') : date('Y');
        $sdate  = ($year - 1). '-10-01';
        $edate  = $year. '-09-30';

        $sql = "SELECT CONCAT(YEAR(bill_date), '-', MONTH(bill_date)) AS bill_date, 
                SUM(volume) as qty, SUM(total) as net 
                FROM vehicle_fuel f LEFT JOIN vehicles v ON (f.vehicle_id=v.vehicle_id)
                WHERE (bill_date BETWEEN '$sdate' AND '$edate')
                AND (fuel_status='1')
                GROUP BY CONCAT(YEAR(bill_date), '-', MONTH(bill_date))
                ORDER BY CONCAT(YEAR(bill_date), '-', MONTH(bill_date))";

        return \DB::select($sql);
    }

    public function fuelVehicle ()
    {
        return view('reports.fuel-vehicle', [
            'assignments' => Assignment::orderBy('id','DESC')->paginate(10),
        ]);
    }
    
    public function fuelVehicleChart ($month)
    {
        $sdate = $month . '-01';
        $edate = date("Y-m-t", strtotime($sdate));

        $sql = "SELECT v.reg_no as vehicle, SUM(volume) as qty, SUM(total) as net 
                FROM vehicle_fuel f LEFT JOIN vehicles v ON (f.vehicle_id=v.vehicle_id)
                WHERE (bill_date BETWEEN '$sdate' AND '$edate')
                GROUP BY v.reg_no
                ORDER BY v.vehicle_type, v.vehicle_cate";

        return \DB::select($sql);
    }

    public function sumMaintained ()
    {
        $year   = (Input::get('selectMonth')) ? Input::get('selectMonth') : date('Y');
        $sdate  = ($year - 1). '-10-01';
        $edate  = $year. '-09-30';

        $sql = "SELECT 
                SUM(total) as total,
                SUM(CASE WHEN maintained_type='1' THEN total END) as type1,
                SUM(CASE WHEN maintained_type='2' THEN total END) as type2,
                SUM(CASE WHEN maintained_type='3' THEN total END) as type3
                FROM vehicle_maintenances 
                WHERE (maintained_date BETWEEN '$sdate' AND '$edate')
                AND (status<>'3') # สถานะรายการไม่ใช่ 0=รอเอกสาร, 1=รอซ่อม, 2=เสร็จเรียบร้อย, 3=ยกเลิก
                #AND (maintained_type='1') #ประเภท 0=รอเอกสาร, 1=บำรุงรักษา,2=ซ่อมตามอาการเสีย,3=ติดตั้งเพิ่ม";

        return view('reports.sum-maintained', [
            'data'      => \DB::select($sql),
            'budget'    => Budget::where(['year' => ($year+543)])->first(),
            'year'      => $year
        ]);
    }

    public function sumFuel ()
    {
        $year   = (Input::get('selectMonth')) ? Input::get('selectMonth') : date('Y');
        $sdate  = ($year - 1). '-10-01';
        $edate  = $year. '-09-30';

        $sql = "SELECT
                SUM(CASE WHEN v.vehicle_type IN (2,4,5) THEN total END) as 'ambu',
                SUM(CASE WHEN v.vehicle_type IN (1) THEN total END) as 'gen',
                SUM(CASE WHEN v.vehicle_type IN (3) THEN total END) as 'inter',
                SUM(CASE WHEN v.vehicle_id IN (90) THEN total END) as 'glass',
                SUM(CASE WHEN v.vehicle_id IN (91) THEN total END) as 'elec',
                SUM(total) as total
                FROM vehicle_fuel f 
                LEFT JOIN vehicles v ON (f.vehicle_id=v.vehicle_id)
                WHERE (f.bill_date BETWEEN '$sdate' AND '$edate')
                AND (f.fuel_status<>'3')";

        return view('reports.sum-fuel', [
            'data'      => \DB::select($sql),
            'budget'    => Budget::where(['year' => ($year+543)])->first(),
            'year'      => $year
        ]);
    }

    public function serviceVehicle ()
    {
        $month = (Input::get('selectMonth')) ? Input::get('selectMonth') : date('Y-m');
        $sdate = $month . '-01';
        $edate = date("Y-m-t", strtotime($sdate));

        $sql = "SELECT r.vehicle_id, v.reg_no,
                COUNT(DISTINCT r.id) AS 'vehicle_count'
                FROM reservations r LEFT JOIN vehicles v ON (r.vehicle_id=v.vehicle_id)
                WHERE (from_date BETWEEN '$sdate' AND '$edate')
                AND (r.`status` <> 5)
                GROUP BY r.vehicle_id, v.reg_no ";

        $result = array_map(function($value) {
            return (array)$value;
        }, \DB::select($sql));

        return view('reports.service-vehicle', [
            'vehicles'  => Vehicle::where(['status' => 1])->whereIn('vehicle_type', [1,2])->get(),
            'data'      => $result,
            'month'     => $month,
        ]);
    }

    public function serviceLocation ()
    {
        $month = (Input::get('selectMonth')) ? Input::get('selectMonth') : date('Y-m');
        $sdate = $month . '-01';
        $edate = date("Y-m-t", strtotime($sdate));

        $sql = "SELECT * FROM reservations
                WHERE (from_date BETWEEN '$sdate' AND '$edate')
                AND (`status` <> 5) ";

        $result = array_map(function($value) {
            return $value->location;
        }, \DB::select($sql));

        $tbLocations = Location::with('province')->with('district')->get();

        $tmp = "";
        $arrLocations = [];

        for ($i = 0; $i < count($result); $i++) {
            $separator  = ($i != count($result) - 1) ? ',' : '';
            $tmp        .= $result[$i] . $separator;
        }

        $arrLocations   = explode(',', $tmp);
        $locationsCount = array_count_values($arrLocations);

        $newLocation = new \ArrayObject([]);
        foreach($tbLocations as $location) {
            $tmpLocation = [];
            
            if(array_key_exists($location->id, $locationsCount)) {
                $tmpLocation['id']          = $location->id;
                $tmpLocation['name']        = $location->name;
                $tmpLocation['chw_id']      = $location->changwat;
                $tmpLocation['changwat']    = $location->province->changwat;
                $tmpLocation['amp_id']      = $location->amphur;
                $tmpLocation['amphur']      = $location->district->amphur;
                $tmpLocation['count']       = (int)$locationsCount[$location->id];

                $newLocation->append($tmpLocation);
                $newLocation->uasort(function($a, $b) {
                    return $a['count'] < $b['count'];
                });
            }
        }

        return view('reports.service-location', [
            'locations'    => $newLocation,
            'month' => $month,
        ]);
    }

    public function reserveDepart() {
        $month = (Input::get('selectMonth')) ? Input::get('selectMonth') : date('Y-m');
        $sdate = '2017-10-01'; //$month . '-01';
        $edate = '2018-09-30'; //date("Y-m-t", strtotime($sdate));

        $reserves = \DB::table('vehicle_db.reservations as r')
                        ->leftjoin('db_ksh.ward as w', 'w.ward_id', '=', 'r.ward')
                        ->select('r.ward', 'w.ward_name', \DB::raw('count(r.id) as total'))
                        ->whereBetween('r.from_date', [$sdate, $edate])
                        ->whereAnd('status', '<>', '5')
                        ->groupBy('r.ward', 'w.ward_name')
                        ->orderBy(\DB::raw('count(r.id)'), 'DESC')
                        ->get();

        return view('reports.reserve-depart', [
            'reserves'  => $reserves,
            'month'     => $month,
        ]);
    }

    public function maintainVehicle ()
    {
        $year = (Input::get('selectMonth')) ? Input::get('selectMonth') : date('Y');

        return view('reports.maintain-vehicle', [
            'assignments'   => Assignment::orderBy('id','DESC')->paginate(10),
            'year'          => $year
        ]);
    }
    
    public function maintainVehicleChart ($year)
    {
        $sdate = ($year - 1). '-10-01';
        $edate = $year. '-09-30';

        $sql = "SELECT
                v.reg_no,
                SUM(CASE WHEN m.maintained_type='1' THEN m.total END) as type1,
                SUM(CASE WHEN m.maintained_type='2' THEN m.total END) as type2,
                SUM(CASE WHEN m.maintained_type='3' THEN m.total END) as type3,
                SUM(m.total) as total
                FROM vehicle_maintenances m
                LEFT JOIN vehicles v ON (m.vehicle_id=v.vehicle_id)
                WHERE m.maintained_date BETWEEN '$sdate' AND '$edate'
                AND (m.status IN ('1','2'))
                GROUP BY v.reg_no
                ORDER BY v.reg_no";
                //# สถานะรายการไม่ใช่ 3=ยกเลิก
                //#AND (maintained_type='1') #ประเภท 1=บำรุงรักษา,2=ซ่อมตามอาการเสีย,3=ติดตั้งเพิ่ม

        return \DB::select($sql);
    }
}
