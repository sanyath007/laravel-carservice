@extends('layouts.main')

@section('content')
<div class="container-fluid" ng-controller="maintenanceCtrl">
    
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">หน้าหลัก</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/maintenances/list') }}">รายการประวัติการบำรุงรักษารถล่าสุด</a></li>
        <li class="breadcrumb-item active">{{ $vehicle->reg_no }} {{ $vehicle->changwat->short }}</li>
    </ol>

    <!-- page title -->
    <div class="page__title-wrapper">
        <div class="page__title">
            <span>
                รายการประวัติการบำรุงรักษารถ  
                <span class="text-muted">
                    ({{ $vehicle->cate->vehicle_cate_name }}
                    {{ $vehicle->type->vehicle_type_name }}
                    {{ $vehicle->manufacturer->manufacturer_name }}
                    ทะเบียน {{ $vehicle->reg_no }} {{ $vehicle->changwat->short }})
                </span>
            </span>
            
            <div>
                <a
                    href="{{ url('/maintenances/new') }}/{{ $vehicle->vehicle_id }}"
                    class="btn btn-primary pull-right"
                >
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    New
                </a>

                <a 
                    href="{{ url('/maintenances/vehicleprint') }}/{{ $vehicle->vehicle_id }}"
                    class="btn btn-success pull-right"
                >
                    <i class="fa fa-print" aria-hidden="true"></i>
                    print
                </a>
            </div>
        </div>
        
        <hr />
    </div><!-- page title -->

    <div class="row">
        <div class="col-md-12">

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 3%; text-align: center;">#</th>
                            <th style="width: 6%; text-align: center;">วันที่ซ่อม</th>
                            <th style="width: 7%; text-align: center;">เลขระยะทางเมื่อเข้าซ่อม</th>
                            <th style="text-align: center;">รายละเอียด</th>
                            <th style="width: 8%; text-align: center;">เลขที่ใบส่งของ</th>              
                            <th style="width: 6%; text-align: center;">ค่าใช้จ่าย</th>
                            <th style="width: 12%; text-align: center;">สถานที่ซ่อม</th>
                            <th style="width: 10%; text-align: center;">ผู้แจ้ง</th>
                            <th style="width: 6%; text-align: center;">สถานะ</th>
                            <th style="width: 12%; text-align: center;">หมายเหตุ</th>
                            <th style="width: 8%; text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $statuses = ['ขออนุมัติ', 'รอส่งเอกสาร', 'ส่งเอกสารแล้ว', 'ยกเลิก']; ?>

                    @foreach($maintenances as $maintenance)

                        <tr>
                            <td style="text-align: center;">
                                {{ $maintenance->maintained_id }}
                            </td>        
                            <td style="text-align: center;">{{ convDbDateToThDate($maintenance->maintained_date) }}</td>
                            <td style="text-align: center;">{{ number_format($maintenance->maintained_mileage) }}</td>
                            <td>{{ $maintenance->detail }}</td>
                            <td style="text-align: center;">
                                {{ $maintenance->delivery_bill }}
                            </td>
                            <td style="text-align: center;">{{ number_format($maintenance->total,2) }}</td>
                            <td style="text-align: center;">{{ $maintenance->garage->garage_name }}</td>
                            <td style="text-align: center;">
                                {{ $maintenance->user->person_firstname }}  {{ $maintenance->user->person_lastname }}
                            </td>
                            <td style="text-align: center;">
                                {{ $statuses[$maintenance->status] }}
                            </td>
                            <td>{{ $maintenance->remark }}</td>
                            <td style="text-align: center;">
                                <a
                                    href="{{ url('/maintenances/' .$maintenance->maintained_id. '/detail') }}"
                                    class="btn btn-info btn-xs"
                                    title="ดูรายละเอียด"
                                >
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </a>
                                <a
                                    href="{{ url('/maintenances/' .$maintenance->maintained_id. '/edit') }}"
                                    class="btn btn-warning btn-xs"                                    
                                    title="แก้ไขรายการ"
                                >
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>
                                <a
                                    href="{{ $maintenance->maintained_id }}"
                                    class="btn btn-danger btn-xs"
                                    title="ยกเลิกรายการ"
                                >
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </a>
                                <a
                                    href="#"
                                    class="btn btn-primary btn-xs"
                                    ng-click="showReceiveBillForm($event, '{{ $maintenance->maintained_id }}')"
                                    title="ส่งเอกสารใบส่งของ"
                                    ng-show="'{{ $maintenance->status }}' != 2"
                                >
                                    <i class="fa fa-calculator" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>
            </div>
            
            <ul class="pagination" style="margin: 0 auto;">
                @if($maintenances->currentPage() !== 1)
                    <li>
                        <a href="{{ $maintenances->url($maintenances->url(1)) }}" aria-label="Previous">
                            <span aria-hidden="true">First</span>
                        </a>
                    </li>
                @endif
                
                @for($i=1; $i<=$maintenances->lastPage(); $i++)
                    <li class="{{ ($maintenances->currentPage() === $i) ? 'active' : '' }}">
                        <a href="{{ $maintenances->url($i) }}">
                            {{ $i }}
                        </a>
                    </li>
                @endfor

                @if($maintenances->currentPage() !== $maintenances->lastPage())
                    <li>
                        <a href="{{ $maintenances->url($maintenances->lastPage()) }}" aria-label="Previous">
                            <span aria-hidden="true">Last</span>
                        </a>
                    </li>
                @endif
            </ul>

        </div>
    </div>
    
    <!-- Modal -->
    @include('maintenances.modal-receivebill')
    <!-- Modal -->
    
</div>  
@endsection
