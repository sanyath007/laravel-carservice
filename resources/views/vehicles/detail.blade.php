@extends('layouts.main')

@section('content')
<div class="container-fluid" ng-controller="vehicleCtrl">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">หน้าหลัก</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/vehicles/list') }}">รายการรถ</a></li>
        <li class="breadcrumb-item active">{{ $vehicle->reg_no. ' ' .$vehicle->changwat->short }}</li>
    </ol>

    <!-- page title -->
    <div class="page__title-wrapper">
        <div class="page__title">
            <span>รายละเอียดรถ
                <span class="text-muted">
                    ({{ $vehicle->reg_no }} {{ $vehicle->changwat->short }})
                </span>
            </span>
        </div>
        
        <hr />
    </div>
    <!-- page title -->

    <?php $expired = '<span style="color: red;">หมดอายุ</span>'; ?>

    <div class="row">
        <div class="col-md-4 col-lg-3" style="border: 1px solid black; padding: 0; overflow: hidden;">
            <img
                class="card-img-top" 
                src="{{ ($vehicle->thumbnail) 
                        ? url('/').'/uploads/vehicles/thumbnails/' .$vehicle->thumbnail 
                        : url('/').'/uploads/no-image-300x300.jpg' }}"
                style="width: 100%; height: auto;"
            >
        </div>

        <div class="col-md-8">
            <div class="row" style="padding-left: 50px;">
                <div class="col-md-6">
                    <div class="page__title" style="margin-top: 1.5rem">
                        <span>
                            <i class="fa fa-sticky-note-o" aria-hidden="true"></i> ข้อมูลทั่วไป
                        </span>
                    </div>

                    <b style="margin-right: 10px;">หมายเลขรถ :</b>
                        <span class="label label-primary">{{ $vehicle->vehicle_no }}</span>
                    <br>
                    <b style="margin-right: 10px;">เลขทะเบียน :</b> {{ $vehicle->reg_no. ' ' .$vehicle->changwat->short }} <br>
                    <b style="margin-right: 10px;">ประเภทรถ :</b> {{ $vehicle->cate->vehicle_cate_name }} <br>
                    <b style="margin-right: 10px;">การใช้งาน :</b> {{ $vehicle->type->vehicle_type_name }} <br>
                    <b style="margin-right: 10px;">ยี่ห้อ :</b> {{ $vehicle->manufacturer->manufacturer_name }} <br>
                    <b style="margin-right: 10px;">ปี :</b> {{ $vehicle->year+543 }} <br>
                    <b style="margin-right: 10px;">อายุการใช้งาน :</b> {{ date('Y') - $vehicle->year }} ปี<br>
                    <b style="margin-right: 10px;">รุ่น :</b> {{ $vehicle->model }} <br>
                    <b style="margin-right: 10px;">สี :</b> {{ $vehicle->color }} <br>                            
                    <b style="margin-right: 10px;">น้ำมัน :</b> {{ $vehicle->fuel->fuel_type_name }} <br>
                    <b style="margin-right: 10px;">ความจุ :</b> {{ number_format($vehicle->capacity) }} ซีซี <br>
                    <b style="margin-right: 10px;">เลขตัวถัง :</b> {{ $vehicle->chassis_no }} <br>
                    <b style="margin-right: 10px;">เลขเครื่องยนต์ :</b> {{ $vehicle->engine_no }} <br>
                    <b style="margin-right: 10px;">วันที่จดทะเบียน :</b> {{ $vehicle->reg_date }} <br>
                    <b style="margin-right: 10px;">วันที่หมดภาษี :</b>
                        <?= ((count($vehicle->taxactived) > 0) ? 
                            (($vehicle->taxactived[0]->tax_renewal_date < date('Y-m-d')) ? 
                            $expired : 
                            '<span style="color: green;">'.$vehicle->taxactived[0]->tax_renewal_date.'</span>') : 
                            '-'); ?> <br>
                    <b style="margin-right: 10px;">วันที่หมด พรบ. :</b>
                        <?= ((count($vehicle->actsactived) > 0) ?                                         
                            (($vehicle->actsactived[0]->act_renewal_date < date('Y-m-d')) ? 
                            $expired : 
                            '<span style="color: green;">'.$vehicle->actsactived[0]->act_renewal_date.'</span>') : 
                            '-'); ?> <br>
                    <b style="margin-right: 10px;">วันที่หมดประกัน :</b>
                        <?= ((count($vehicle->insactived) > 0) ? 
                            (($vehicle->insactived[0]->insurance_renewal_date < date('Y-m-d')) ? 
                            $expired : 
                            '<span style="color: green;">'.$vehicle->insactived[0]->insurance_renewal_date.'</span>') : 
                            '-'); ?> <br>
                    <b style="margin-right: 10px;">เลขไมล์ล่าสุด :</b> 
                        <span style="color: red;">
                            {{ (count($vehicle->mileage) > 0) 
                                ? number_format($vehicle->mileage[0]->mileage) 
                                : '-' }}
                        </span>
                </div>
                <div class="col-md-6">
                    <div class="page__title" style="margin-top: 1.5rem">
                        <span>
                            <i class="fa fa-sticky-note-o" aria-hidden="true"></i> Options
                        </span>
                    </div>

                    <b style="margin-right: 10px;">ระบบ GPS :</b>{{ $vehicle->gps == '1' ? 'มี' : 'ไม่มี' }}<br>
                    <b style="margin-right: 10px;">ระบบกล้องหน้า :</b>{{ $vehicle->cam_front == '1' ? 'มี' : 'ไม่มี' }}<br>
                    <b style="margin-right: 10px;">ระบบกล้องหลัง :</b>{{ $vehicle->cam_back == '1' ? 'มี' : 'ไม่มี' }}<br>
                    <b style="margin-right: 10px;">ระบบกล้องคนขับ :</b>{{ $vehicle->cam_driver == '1' ? 'มี' : 'ไม่มี' }}<br>
                    <b style="margin-right: 10px;">ระบบ Telemed :</b>{{ $vehicle->tele_med == '1' ? 'มี' : 'ไม่มี' }}<br>
                    <b style="margin-right: 10px;">วิทยุสื่อสาร :</b>{{ $vehicle->radio_com == '1' ? 'มี' : 'ไม่มี' }}<br>
                    <b style="margin-right: 10px;">ไฟฉุกเฉิน :</b>{{ $vehicle->light == '1' ? 'มี' : 'ไม่มี' }}<br>
                    <b style="margin-right: 10px;">ไซเรน :</b>{{ $vehicle->siren == '1' ? 'มี' : 'ไม่มี' }}<br>
                    <b>หมายเหตุ :</b>
                    <div style="color: blue; border: 1px dashed gray; width: 95%; min-height: 60px; margin-top: 5px;">
                        {{ $vehicle->remark }}
                    </div>
                </div>            

                <div class="col-md-12" style="margin: 20px auto;">                
                    <a
                        href="{{ url('/vehicles/' .$vehicle->vehicle_id. '/edit') }}"
                        class="btn btn-warning"
                    >
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> แก้ไข
                    </a>

                    <a
                        href="#"
                        ng-click="delete($event, '{{ $vehicle->vehicle_id }}')"
                        class="btn btn-danger"
                    >
                        <i class="fa fa-times" aria-hidden="true"></i> ลบ
                    </a>
                    <form
                        id="{{ $vehicle->vehicle_id. '-delete-form' }}"
                        action="{{ url('/vehicles/' .$vehicle->vehicle_id. '/delete') }}"
                        method="POST"
                        style="display: none;"
                    >
                        {{ csrf_field() }}
                    </form>
                </div>
            </div><!-- /.row -->

        </div>
    </div>

</div>
@endsection
