<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/** ============= CORS ============= */
header('Access-Control-Allow-Origin: http://192.168.20.4');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Accept, Authorization, Content-Type, Origin, X-Requested-With, X-Auth-Token, X-Xsrf-Token');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Max-Age: 3600');
header('Content-Type: application/json;charset=utf-8');
/** ============= CORS ============= */

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'Auth\LoginController@showLogin');

Auth::routes();

Route::group(['middleware' => 'web'], function() {
    /** ============= Authentication ============= */
    Route::get('/auth/login', 'Auth\LoginController@showLogin');
    Route::post('/auth/signin', 'Auth\LoginController@doLogin');
    Route::get('/auth/logout', 'Auth\LoginController@doLogout');
    Route::get('/auth/register', 'Auth\RegisterController@register');
    Route::post('/auth/signup', 'Auth\RegisterController@create');
});

Route::group(['middleware' => ['web','auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');


    Route::get('/vehicles/list', 'VehicleController@index');
    Route::get('/vehicles/{id}/detail', 'VehicleController@detail');
    Route::get('/vehicles/new', 'VehicleController@create');
    Route::post('/vehicles/add', 'VehicleController@store');
    Route::get('/vehicles/{id}/edit', 'VehicleController@edit');
    Route::post('/vehicles/{id}/update', 'VehicleController@update');
    Route::post('/vehicles/{id}/delete', 'VehicleController@delete');    
    Route::post('/vehicles/validate', 'VehicleController@formValidate');
    Route::get('/ajaxvehicles', 'VehicleController@ajaxvehicles');


    Route::get('/accidents/list', 'AccidentController@index');
    Route::get('/accidents/new', 'AccidentController@create');
    Route::post('/accidents/add', 'AccidentController@store');
    Route::get('/accidents/{id}/edit', 'AccidentController@edit');
    Route::post('/accidents/{id}/update', 'AccidentController@update');
    Route::post('/accidents/{id}/delete', 'AccidentController@delete');    
    Route::post('/accidents/validate', 'AccidentController@formValidate');


    Route::get('/drivers/list', 'DriverController@index');
    Route::get('/drivers/new', 'DriverController@create');
    Route::post('/drivers/add', 'DriverController@store');
    Route::get('/drivers/edit/{id}', 'DriverController@edit');
    Route::post('/drivers/update', 'DriverController@update');
    Route::post('/drivers/delete', 'DriverController@delete');    
    Route::post('/drivers/validate', 'DriverController@formValidate');


    Route::get('/reserve/new', 'ReservationController@create');
    Route::post('/reserve/add', 'ReservationController@store');
    Route::post('/reserve/validate', 'ReservationController@formValidate');
    Route::get('/reserve/edit/{id}', 'ReservationController@edit');    
    Route::get('/reserve/ajaxedit/{id}', 'ReservationController@ajaxedit');
    Route::post('/reserve/update/{id}', 'ReservationController@update');    
    Route::post('/reserve/delete', 'ReservationController@delete');
    Route::get('/reserve/list', 'ReservationController@index');
    Route::post('/reserve/cancel', 'ReservationController@cancel');
    Route::post('/reserve/recover', 'ReservationController@recover');
    Route::get('/reserve/calendar', 'ReservationController@calendar');
    Route::get('/reserve/ajaxcalendar/{sdate}/{edate}', 'ReservationController@ajaxcalendar');    
    Route::get('/reserve/ajaxward/{department}', 'ReservationController@ajaxward');
    Route::get('/reserve/ajaxshift/{date}/{shift}', 'ReservationController@ajaxshift');
    Route::get('/reserve/ajaxdetail/{id}', 'ReservationController@ajaxdetail');


    Route::get('/ajaxperson/{name}', 'UserController@ajaxperson');


    Route::get('/location/ajaxquery/{location}', 'LocationController@ajaxquery');
    Route::get('/location/ajaxlocation/{id}', 'LocationController@ajaxlocation');
    Route::get('/location/ajaxchangwat', 'LocationController@ajaxchangwat');
    Route::get('/location/ajaxamphur/{chwid}', 'LocationController@ajaxamphur');
    Route::get('/location/ajaxtambon/{ampid}', 'LocationController@ajaxtambon');
    Route::post('/location/ajaxadd', 'LocationController@ajaxadd');


    Route::get('/ajaxpassenger/{reserveid}/{withuser}', 'ReservePassengerController@ajaxpassenger');


    Route::get('/maintenances/list', 'MaintenanceController@index');
    Route::get('/maintenances/new/{vehicleid}', 'MaintenanceController@create');
    Route::post('/maintenances/add', 'MaintenanceController@store');    
    Route::post('/maintenances/validate', 'MaintenanceController@formValidate');
    Route::put('/maintenances/{maintainedid}/receive-bill', 'MaintenanceController@receiveBill');
    Route::get('/maintenances/{maintainedid}/edit', 'MaintenanceController@edit');
    Route::post('/maintenances/update', 'MaintenanceController@update');
    Route::post('/maintenances/{maintainedid}/delete', 'MaintenanceController@delete');
    Route::get('/maintenances/{vehicleid}/vehicle', 'MaintenanceController@vehiclemaintain');    
    Route::get('/maintenances/vehicleprint/{vehicleid}', 'MaintenanceController@vehicleprint');
    Route::get('/maintenances/checklist', 'MaintenanceController@checklist');
    Route::get('/maintenances/checkform', 'MaintenanceController@checkform');
    Route::post('/maintenances/adddailycheck', 'MaintenanceController@storecheck');
    Route::get('/maintenances/ajaxchecklist/{yymm}/{vehicleid}', 'MaintenanceController@ajaxchecklist');
    

    Route::get('/assign/list', 'AssignmentController@index');
    Route::get('/assign/new', 'AssignmentController@create');
    Route::post('/assign/add', 'AssignmentController@store');
    Route::get('/assign/edit/{id}/{date}/{shift}', 'AssignmentController@edit');
    Route::post('/assign/update', 'AssignmentController@update');
    Route::post('/assign/delete/{id}', 'AssignmentController@delete');
    Route::get('/assign/drive', 'AssignmentController@drive');
    Route::post('/assign/drivearrived', 'AssignmentController@drivearrived');
    Route::post('/assign/drivedeparted', 'AssignmentController@drivedeparted');
    Route::get('/assign/ajaxassign/{date}/{shift}', 'AssignmentController@ajaxassign');
    Route::get('/assign/ajaxstartmileage/{id}', 'AssignmentController@ajaxstartmileage');
    Route::post('/assign/ajaxchange', 'AssignmentController@ajaxchange');    
    Route::post('/assign/ajaxadd_reservation', 'AssignmentController@ajaxadd_reservation');

    /** พรบ */
    Route::get('/acts/list', 'ActController@index');
    Route::get('/acts/new', 'ActController@create');
    Route::post('/acts/add', 'ActController@store');
    Route::get('/acts/{id}/edit', 'ActController@edit');
    Route::post('/acts/{id}/update', 'ActController@update');
    Route::post('/acts/{id}/delete', 'ActController@delete');    
    Route::post('/acts/validate', 'ActController@formValidate');

    /** ประกันภัย */
    Route::get('/insurances/list', 'InsuranceController@index');
    Route::get('/insurances/new', 'InsuranceController@create');
    Route::post('/insurances/add', 'InsuranceController@store');
    Route::get('/insurances/{id}/edit', 'InsuranceController@edit');
    Route::post('/insurances/{id}/update', 'InsuranceController@update');
    Route::post('/insurances/{id}/delete', 'InsuranceController@delete');    
    Route::post('/insurances/validate', 'InsuranceController@formValidate');

    /** ภาษี */
    Route::get('/taxes/list', 'TaxController@index');
    Route::get('/taxes/new', 'TaxController@create');
    Route::post('/taxes/add', 'TaxController@store');
    Route::get('/taxes/{id}/edit', 'TaxController@edit');
    Route::post('/taxes/{id}/update', 'TaxController@update');
    Route::post('/taxes/{id}/delete', 'TaxController@delete');    
    Route::post('/taxes/validate', 'TaxController@formValidate');


    Route::get('/survey/list', 'SurveyController@index');
    Route::get('/survey/add', 'SurveyController@create');
    Route::post('/survey/store', 'SurveyController@store');
    Route::get('/survey/edit/{id}', 'SurveyController@edit');
    Route::post('/survey/update', 'SurveyController@update');
    Route::post('/survey/delete/{id}', 'SurveyController@delete');    
    Route::post('/survey/validate', 'SurveyController@formValidate');


    Route::get('/prepared/driver-list', 'PreparedController@driverList');
    Route::get('/prepared/day-list', 'PreparedController@dayList');
    Route::get('/prepared/list', 'PreparedController@index');
    Route::get('/prepared/add', 'PreparedController@create');
    Route::post('/prepared/store', 'PreparedController@store');
    Route::get('/prepared/detail/{id}', 'PreparedController@detail');
    Route::get('/prepared/ajax-get-prepared/{id}', 'PreparedController@ajaxGetById');
    Route::get('/prepared/edit/{id}', 'PreparedController@edit');
    Route::post('/prepared/update', 'PreparedController@update');
    Route::post('/prepared/delete/{id}', 'PreparedController@delete');    
    Route::post('/prepared/validate', 'PreparedController@formValidate');


    Route::get('/fuel/list', 'FuelController@index');
    Route::get('/fuel/new', 'FuelController@create');
    Route::post('/fuel/add', 'FuelController@store');
    Route::get('/fuel/edit/{id}', 'FuelController@edit');
    Route::post('/fuel/update', 'FuelController@update');
    Route::post('/fuel/delete', 'FuelController@delete');
    Route::post('/fuel/cancel', 'FuelController@cancel');    
    Route::post('/fuel/validate', 'FuelController@formValidate');
    

    Route::get('/ambulance/list', 'AmbulanceController@index');


    Route::get('/report/reserve', 'ReportController@reserve');
    Route::get('/report/drive', 'ReportController@drive');
    Route::get('/report/service', 'ReportController@service');
    Route::get('/report/service-chart/{year}', 'ReportController@serviceChart');
    Route::get('/report/period', 'ReportController@period');
    Route::get('/report/period-chart/{month}', 'ReportController@periodChart');
    Route::get('/report/depart', 'ReportController@depart');
    Route::get('/report/depart-chart/{month}', 'ReportController@departChart');
    Route::get('/report/refer', 'ReportController@refer');
    Route::get('/report/refer-chart/{month}', 'ReportController@referChart');
    Route::get('/report/fuel-day', 'ReportController@fuelDay');
    Route::get('/report/fuel-day-chart/{month}', 'ReportController@fuelDayChart');
    Route::get('/report/fuel-vehicle', 'ReportController@fuelVehicle');
    Route::get('/report/fuel-vehicle-chart/{month}', 'ReportController@fuelVehicleChart');
    Route::get('/report/sum-maintained', 'ReportController@sumMaintained');
    Route::get('/report/sum-fuel', 'ReportController@sumFuel');
    // Route::get('/report/sum-maintained-chart/{year}', 'ReportController@sumMaintainedChart');
    Route::get('/report/service-vehicle', 'ReportController@serviceVehicle');
    // Route::get('/report/service-vehicle-chart/{year}', 'ReportController@serviceVehicleChart');
    Route::get('/report/service-location', 'ReportController@serviceLocation');
    // Route::get('/report/service-location-chart/{year}', 'ReportController@serviceLocationChart');
    Route::get('/report/reserve-depart', 'ReportController@reserveDepart');
    Route::get('/report/maintain-vehicle', 'ReportController@maintainVehicle');
    Route::get('/report/maintain-vehicle-chart/{year}', 'ReportController@maintainVehicleChart');
});
