@extends('layouts.main')

@section('content')
<div class="container-fluid" ng-controller="vehicleCtrl" ng-init="setVehicleStatus('{{ $vehicleStatus }}')">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">หน้าหลัก</a></li>
        <li class="breadcrumb-item active">รายการรถ</li>
    </ol>

    <!-- page title -->
    <div class="page__title-wrapper">
        <div class="page__title">
            <span>รายการรถ</span>
            <a href="{{ url('/vehicles/new') }}" class="btn btn-primary pull-right">
                <i class="fa fa-plus" aria-hidden="true"></i>
                New
            </a>
        </div>

        <hr />
    </div>

    <!-- page title -->

    <div class="row">
        <div class="col-md-12">

            <form   id="formVehicleList" 
                    name="formVehicleList" 
                    action="{{ url('vehicles/list') }}" 
                    method="GET"
                    class="form-inline"
                    style="margin-left: 20px; margin-bottom: 10px;">
                <div class="form-group">
                    <label for="">แสดงรายการตามสถานะ : </label>
                    <select id="vehicleStatus" 
                            name="vehicleStatus"
                            ng-model="vehicleStatus" 
                            ng-change="showVehicleListWithStatus(vehicleStatus)"
                            class="form-control">
                        <option value="0">-- กรุณาเลือก --</option>
                        <option value="1" {{ ($vehicleStatus==1) ? 'selected' : '' }}>1=ใช้งาน</option>
                        <option value="2" {{ ($vehicleStatus==2) ? 'selected' : '' }}>2=ให้ยืม</option>
                        <option value="3" {{ ($vehicleStatus==3) ? 'selected' : '' }}>3=เสีย (อยู่ระหว่างซ่อม)</option>
                        <option value="4" {{ ($vehicleStatus==4) ? 'selected' : '' }}>4=จำหน่าย</option>
                        <option value="5" {{ ($vehicleStatus==5) ? 'selected' : '' }}>5=โอน</option>
                        <!-- <option value="9">9=เครื่องมืออื่นๆ (ไม่ใช่รถ)</option> -->
                    </select>
                </div>
            </form>

            @foreach($vehicles as $vehicle)
                <?php $expired = '<font style="color: red;">หมดอายุ</font>'; ?>

                <div class="col-sm-6 col-md-4 col-lg-3">

                    <div class="card card-inverse card-info">
                        <img
                            class="card-img-top"
                            src="{{
                                ($vehicle->thumbnail) 
                                ? url('/').'/uploads/vehicles/thumbnails/' .$vehicle->thumbnail
                                : url('/').'/uploads/no-image-300x300.jpg'
                            }}"
                        />

                        <div class="card-block">
                            <div class="alert alert-danger" style="height: 50px;">
                                <h4 class="card-title mt-3">
                                    <span class="label label-primary">{{ $vehicle->vehicle_no }}</span> 
                                    {{ $vehicle->reg_no }} 
                                    {{ $vehicle->changwat->short }}
                                </h4>
                            </div>

                            <div class="card-text" style="height: 200px;">
                                {{ $vehicle->cate->vehicle_cate_name }} <b>ใช้งาน</b> {{ $vehicle->type->vehicle_type_name }} <br>
                                <b>ยี่ห้อ</b> {{ $vehicle->manufacturer->manufacturer_name }} <b>ปี</b> {{ $vehicle->year }} <br>
                                <b>รุ่น</b> {{ $vehicle->model }} <br>
                                
                                <b>เครื่องยนต์</b> {{ $vehicle->fuel->fuel_type_name }} - ซีซี
                                <b>สี</b> {{ $vehicle->color }} <br>                            
                                <b>วันที่จดทะเบียน</b> {{ $vehicle->reg_date }} <br>
                                <b>วันที่หมดภาษี</b> 
                                    <?= ((count($vehicle->taxactived) > 0) ? 
                                        (($vehicle->taxactived[0]->tax_renewal_date < date('Y-m-d')) ? 
                                        $expired : 
                                        '<span style="color: green;">'.$vehicle->taxactived[0]->tax_renewal_date.'</span>') : 
                                        '-'); ?> <br>
                                <b>วันที่หมด พรบ.</b>
                                    <?= ((count($vehicle->actsactived) > 0) ?                                         
                                        (($vehicle->actsactived[0]->act_renewal_date < date('Y-m-d')) ? 
                                        $expired : 
                                        '<span style="color: green;">'.$vehicle->actsactived[0]->act_renewal_date.'</span>') : 
                                        '-'); ?> <br>
                                <b>วันที่หมดประกัน</b>
                                    <?= ((count($vehicle->insactived) > 0) ? 
                                        (($vehicle->insactived[0]->insurance_renewal_date < date('Y-m-d')) ? 
                                        $expired : 
                                        '<span style="color: green;">'.$vehicle->insactived[0]->insurance_renewal_date.'</span>') : 
                                        '-'); ?> <br/>
                                <b>เลขไมล์ล่าสุด</b>
                                <span style="color: red;">
                                    {{ (count($vehicle->mileage) > 0) 
                                        ? number_format($vehicle->mileage[0]->mileage) 
                                        : '-' }}
                                </span> <br />
                                <span style="color: blue;">{{ $vehicle->remark }}</span>
                            </div>
                        </div>
                        
                        <div class="card-footer">
                            <a href="{{ url('/vehicles'). '/' .$vehicle->vehicle_id. '/detail' }}" class="btn btn-info btn-xs">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </a>

                            <a href="{{ url('/vehicles'). '/' .$vehicle->vehicle_id. '/edit' }}" class="btn btn-warning btn-xs">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>

                            <a href="{{ url('/vehicles'). '/' .$vehicle->vehicle_id. '/delete' }}" class="btn btn-danger btn-xs">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>

                </div>

            @endforeach

        </div>
    </div>

    <div class="row">
        <div class="col-md-12" style="text-align: center;">            
            <ul class="pagination">
                @if($vehicles->currentPage() !== 1)
                    <li>
                        <a href="{{ $vehicles->url($vehicles->url(1)) }}" aria-label="Previous">
                            <span aria-hidden="true">First</span>
                        </a>
                    </li>
                @endif
                
                @for($i=1; $i<=$vehicles->lastPage(); $i++)
                    <li class="{{ ($vehicles->currentPage() === $i) ? 'active' : '' }}">
                        <a href="{{ $vehicles->url($i) }}">
                            {{ $i }}
                        </a>
                    </li>
                @endfor

                @if($vehicles->currentPage() !== $vehicles->lastPage())
                    <li>
                        <a href="{{ $vehicles->url($vehicles->lastPage()) }}" aria-label="Previous">
                            <span aria-hidden="true">Last</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>

</div>
@endsection
