@extends('layouts.main')

@section('content')
<div class="container-fluid" ng-controller="vehicleCtrl">
    <!-- page title -->
    <div class="page__title">
        <span>รายการรถ</span>
    </div>

    <hr />
    <!-- page title -->
  
    <?php $expired = '<font style="color: red;">หมดอายุ</font>'; ?>

    <div class="row">
        <div class="col-md-4">
            <img class="card-img-top" 
                src="{{ ($vehicle->thumbnail) 
                        ? url('/').'/uploads/vehicles/' .$vehicle->thumbnail 
                        : url('/').'/uploads/no-image-300x300.jpg' }}"
                style="width: 440px; height: 300px;"
            >
        </div>

        <div class="col-md-8">

            <div class="col-md-6">
                <h4 class="card-title mt-3">ข้อมูลทั่วไป</h4>
                <b>หมายเลขรถ :</b><span class="label label-primary">{{ $vehicle->vehicle_no }}</span><br>
                <b>เลขทะเบียน :</b> {{ $vehicle->reg_no. ' ' .$vehicle->changwat->short }} <br>

                <b>ประเภทรถ :</b> {{ $vehicle->cate->vehicle_cate_name }} <br>
                <b>การใช้งาน :</b> {{ $vehicle->type->vehicle_type_name }} <br>
                <b>ยี่ห้อ :</b> {{ $vehicle->manufacturer->manufacturer_name }} <br>
                <b>ปี :</b> {{ $vehicle->year+543 }} <br>
                <b>อายุการใช้งาน :</b> {{ date('Y') - $vehicle->year }} ปี<br>
                <b>รุ่น :</b> {{ $vehicle->model }} <br>
                <b>สี :</b> {{ $vehicle->color }} <br>                            
                <b>น้ำมัน :</b> {{ $vehicle->fuel->fuel_type_name }} <br>
                <b>ความจุ :</b> {{ number_format($vehicle->capacity) }} ซีซี <br>
                <b>เลขตัวถัง :</b> {{ $vehicle->chassis_no }} <br>
                <b>เลขเครื่องยนต์ :</b> {{ $vehicle->engine_no }} <br>
                <b>วันที่จดทะเบียน :</b> {{ $vehicle->reg_date }} <br>
                <b>วันที่หมดภาษี :</b>
                    <?= ((count($vehicle->taxactived) > 0) ? 
                        (($vehicle->taxactived[0]->tax_renewal_date < date('Y-m-d')) ? 
                        $expired : 
                        '<font style="color: green;">'.$vehicle->taxactived[0]->tax_renewal_date.'</font>') : 
                        '-'); ?> <br>
                <b>วันที่หมด พรบ. :</b>
                    <?= ((count($vehicle->actsactived) > 0) ?                                         
                        (($vehicle->actsactived[0]->act_renewal_date < date('Y-m-d')) ? 
                        $expired : 
                        '<font style="color: green;">'.$vehicle->actsactived[0]->act_renewal_date.'</font>') : 
                        '-'); ?> <br>
                <b>วันที่หมดประกัน :</b>
                    <?= ((count($vehicle->insactived) > 0) ? 
                        (($vehicle->insactived[0]->insurance_renewal_date < date('Y-m-d')) ? 
                        $expired : 
                        '<font style="color: green;">'.$vehicle->insactived[0]->insurance_renewal_date.'</font>') : 
                        '-'); ?> <br>
                <b>เลขไมล์ล่าสุด :</b> 
                    <font style="color: red;">
                        {{ (count($vehicle->mileage) > 0) 
                            ? number_format($vehicle->mileage[0]->mileage) 
                            : '-' }}
                    </font> <br>
                <b>หมายเหตุ :</b> <font style="color: blue;">{{ $vehicle->remark }}</font>
            </div>
            <div class="col-md-6">
                <h4 class="card-title mt-3">Options</h4>
                <b>ระบบ GPS :</b>   <br>
                <b>ระบบกล้อง :</b>   <br>
                <b>ระบบ Telemed :</b>   <br>
                <b>วิทยุสื่อสาร :</b>   <br>
                <b>ไซเรน-ไฟฉุกเฉิน :</b>   <br>
            </div>
            
            <div class="col-md-12">                
                <br><a href="{{ url('/vehicles'). '/edit/' .$vehicle->vehicle_id }}" class="btn btn-warning">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> แก้ไข
                </a>

                <a href="{{ url('/vehicles'). '/delete/' .$vehicle->vehicle_id }}" class="btn btn-danger">
                    <i class="fa fa-times" aria-hidden="true"></i> ลบ
                </a>
            </div>

        </div>
    </div>

</div>
@endsection
