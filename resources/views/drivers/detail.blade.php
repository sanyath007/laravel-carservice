@extends('layouts.main')

@section('content')
<div class="container-fluid" ng-controller="driverCtrl">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">หน้าหลัก</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/driver/list') }}">รายการรถ</a></li>
        <li class="breadcrumb-item active">{{ $driver->description }}</li>
    </ol>

    <!-- page title -->
    <div class="page__title-wrapper">
        <div class="page__title">
            <span>รายละเอียดพนักงานขับรถยนต์
                <span class="text-muted">
                    ({{ $driver->description }})
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
                src="{{ $driver->thumbnail
                    ? asset('/uploads/drivers/' .$driver->thumbnail)
                    : asset('/uploads/drivers/no-image-300x300.jpg')
                }}"
                style="width: 100%; height: auto;"
            >
        </div>

        <div class="col-md-8">
            <div class="row" style="padding-left: 50px;">
                <div class="col-md-12">
                    <div class="page__title" style="margin: 1.5rem 0;">
                        <span>
                            <i class="fa fa-sticky-note-o" aria-hidden="true"></i> ข้อมูลทั่วไป
                        </span>
                    </div>

                    <p>
                        <b style="margin-right: 10px;">เลข 13 หลัก :</b>
                        {{ $driver->person_id }}
                    </p>
                    <p>
                        <b style="margin-right: 10px;">ชื่อ-สกุล :</b>
                        {{ $driver->description }}
                    </p>
                    <p>
                        <b style="margin-right: 10px;">ตำแหน่ง :</b>
                        {{ $driver->person->position_id }}
                    </p>
                    <p>
                        <b style="margin-right: 10px;">วันเกิด :</b>
                        {{ convDbDateToThDate($driver->person->person_birth) }}
                    </p>
                    <p>
                        <b style="margin-right: 10px;">อายุ :</b>
                        {{ convDbDateToThDate($driver->person->person_birth) }}
                    </p>
                    <p>
                        <b style="margin-right: 10px;">เบอร์โทรศัพท์ :</b>
                        {{ $driver->tel }}
                    </p>
                    <p>
                        <b style="margin-right: 10px;">วันที่บรรจุ :</b>
                        {{ convDbDateToThDate($driver->person->person_singin) }}
                    </p>
                
                    <div class="page__title" style="margin-top: 2rem">
                        <span>
                            <i class="fa fa-sticky-note-o" aria-hidden="true"></i> ประวัติการผ่านการอบรม/สัมนาที่เกี่ยวข้อง
                        </span>

                        <div style="color: gray; min-height: 100px; margin-top: 10px;">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 4%; text-align: center;">ลำดับ</th>
                                        <th style="text-align: center;">การอบรม/สัมนาที่เกี่ยวข้อง</th>
                                        <th style="width: 10%; text-align: center;">เมื่อวันที่</th>
                                        <th style="width: 10%; text-align: center;">หมดอายุวันที่</th>
                                        <th style="width: 30%; text-align: center;">จัดโดย</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="text-align: center;">1</td>
                                        <td>อบรมพนักงานขับรถพยาบาล</td>
                                        <td style="text-align: center;">
                                            {{ convDbDateToThDate($driver->certificated_date) }}
                                        </td>
                                        <td style="text-align: center;"></td>
                                        <td>สสจ.นม.</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">2</td>
                                        <td>อบรมุประกาศนียบัตรปฏิบัติการฉุกเฉินประเภทปฏิบัติการแพทย์ (EMR)</td>
                                        <td style="text-align: center;">
                                            {{ convDbDateToThDate($driver->emr_sdate) }}
                                        </td>
                                        <td style="text-align: center;">
                                            {{ convDbDateToThDate($driver->emr_edate) }}
                                        </td>
                                        <td>สถาบันการแพทย์ฉุกเฉินแห่งชาติ (สพฉ.)</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <b>หมายเหตุ :</b>
                    <div style="color: blue; border: 1px dashed gray; min-height: 80px; margin: 5px 0 10px;">
                        {{ $driver->remark }}
                    </div>
                </div>          

                <div class="col-md-12" style="margin: 10px auto;">                
                    <a
                        href="{{ url('/drivers/' .$driver->driver_id. '/edit') }}"
                        class="btn btn-warning"
                    >
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> แก้ไข
                    </a>

                    <a
                        href="#"
                        ng-click="delete($event, '{{ $driver->driver_id }}')"
                        class="btn btn-danger"
                    >
                        <i class="fa fa-times" aria-hidden="true"></i> ลบ
                    </a>
                    <form
                        id="{{ $driver->driver_id. '-delete-form' }}"
                        action="{{ url('/drivers/' .$driver->driver_id. '/delete') }}"
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
