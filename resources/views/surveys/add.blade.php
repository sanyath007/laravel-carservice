@extends('layouts.main')

@section('content')
<div class="container-fluid" ng-controller="reserveCtrl">
  
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
        <li class="breadcrumb-item active">แบบสอบถามความพึงพอใจ</li>
    </ol>

    <!-- page title -->
    <div class="page__title">
        <span>
            <i class="fa fa-calendar" aria-hidden="true"></i> แบบสอบถามความพึงพอใจ
        </span>
        <!-- <a href="{{ url('/reserve/new') }}" class="btn btn-primary pull-right">
            <i class="fa fa-plus" aria-hidden="true"></i>
            รายการสอบถามความพึงพอใจ
        </a> -->
    </div>

    <hr />
    <!-- page title -->

    <div class="row">
        <div class="col-md-12">

            <form action="{{ url('survey/store') }}" method="post">
                <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->person_id }}">
                {{ csrf_field() }}

                <div class="panel">
                    <div class="panel-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>วันที่</label>
                                <input type="text" id="survey_date" name="survey_date" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>พนักงานขับรถ</label>
                                <select id="vehicle_id" name="vehicle_id" class="form-control">
                                    <option value="">-- กรุณาเลือก --</option>

                                    @foreach($drivers as $driver)
                                        <option value="{{ $driver->driver_id }}">{{ $driver->description }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>เวลา</label>
                                <input type="text" id="survey_time" name="survey_time" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>รถยนต์ทะเบียน</label>
                                <select id="driver_id" name="driver_id" class="form-control">
                                    <option value="">-- กรุณาเลือก --</option>

                                    @foreach($vehicles as $vehicle)
                                        <option value="{{ $vehicle->vehicle_id }}">
                                            {{ $vehicle->reg_no.' '.$vehicle->changwat->short.
                                                ' - '.$vehicle->type->vehicle_type_name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>ประเภทการใช้บริการ</label>
                                <select id="used_type" name="used_type" class="form-control">
                                    <option value="">-- กรุณาเลือก --</option>
                                    <option value="1">รับ-ส่งต่อผู้ป่วย</option>
                                    <option value="2">ออกให้บริการ EMS</option>
                                    <option value="3">ใช้งานทั่วไป</option>
                                </select>
                            </div>
                        </div>
                    </div><!-- /.panel-body -->
                </div><!-- /.panel -->

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="text-align: center;">ประเด็นความพึงพอใจ</th>
                            <th style="width: 6%; text-align: center;">ควรปรับปรุง</th>
                            <th style="width: 6%; text-align: center;">น้อย</th>
                            <th style="width: 6%; text-align: center;">ปานกลาง</th>
                            <th style="width: 6%; text-align: center;">ดี</th>
                            <th style="width: 6%; text-align: center;">ดีมาก</th>
                            <th style="width: 15%; text-align: center;">หากมีข้อเสนอแนะโปรดระบุ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="background-color: #A4A4A4;">
                            <td colspan="7">ด้านสภาพยานพาหนะ</td>
                        </tr>
                        <?php $count = 0; ?>
                        @foreach($bullets as $bullet)
                            @if($bullet->bullet_type == 1)
                                <tr>
                                    <td style="margin-left: 5px;">{{ ++$count.'.'.$bullet->bullet_desc }}</td>
                                    <td style="text-align: center;">
                                        <input type="radio" id="{{ $bullet->id }}" name="{{ $bullet->id }}" value="1">
                                    </td>
                                    <td style="text-align: center;">
                                        <input type="radio" id="{{ $bullet->id }}" name="{{ $bullet->id }}" value="2">
                                    </td>
                                    <td style="text-align: center;">
                                        <input type="radio" id="{{ $bullet->id }}" name="{{ $bullet->id }}" value="3">
                                    </td>
                                    <td style="text-align: center;">
                                        <input type="radio" id="{{ $bullet->id }}" name="{{ $bullet->id }}" value="4">
                                    </td>
                                    <td style="text-align: center;">
                                        <input type="radio" id="{{ $bullet->id }}" name="{{ $bullet->id }}" value="5">
                                    </td>
                                    <td style="text-align: center;">
                                        <input type="text" 
                                                id="{{ $bullet->id.'_comment' }}" 
                                                name="{{ $bullet->id.'_comment' }}" 
                                                value=""
                                                class="form-control">
                                    </td>
                                </tr>
                            @endif
                        @endforeach

                        <tr style="background-color: #A4A4A4;">
                            <td colspan="7">ด้านพนักงานขับรถ</td>
                        </tr>
                        <?php $count = 0; ?>
                        @foreach($bullets as $bullet)
                            @if($bullet->bullet_type == 2)
                                <tr>
                                    <td style="margin-left: 5px;">{{ ++$count.'.'.$bullet->bullet_desc }}</td>
                                    <td style="text-align: center;">
                                        <input type="radio" id="{{ $bullet->id }}" name="{{ $bullet->id }}" value="1">
                                    </td>
                                    <td style="text-align: center;">
                                        <input type="radio" id="{{ $bullet->id }}" name="{{ $bullet->id }}" value="2">
                                    </td>
                                    <td style="text-align: center;">
                                        <input type="radio" id="{{ $bullet->id }}" name="{{ $bullet->id }}" value="3">
                                    </td>
                                    <td style="text-align: center;">
                                        <input type="radio" id="{{ $bullet->id }}" name="{{ $bullet->id }}" value="4">
                                    </td>
                                    <td style="text-align: center;">
                                        <input type="radio" id="{{ $bullet->id }}" name="{{ $bullet->id }}" value="5">
                                    </td>
                                    <td style="text-align: center;">
                                        <input type="text" 
                                                id="{{ $bullet->id.'_comment' }}" 
                                                name="{{ $bullet->id.'_comment' }}" 
                                                value=""
                                                class="form-control">
                                    </td>
                                </tr>
                            @endif
                        @endforeach

                    </tbody>
                </table>

                <div class="form-group">
                    <label>ข้อเสนอแนะอื่น ๆ (ถ้ามี)</label>
                    <textarea id="survey_comment" name="survey_comment" class="form-control" rows="5"></textarea>
                </div>
                
                <div>
                    <button class="btn btn-primary pull-right">บันทึก</button>
                </div>

            </form>

        </div><!-- /.col-md-12 -->
    </div><!-- /.row -->

</div><!-- /.container -->

<script>
    $(document).ready(function($) {
        var dateNow = new Date();

        $('#survey_date').datetimepicker({
            useCurrent: true,
            format: 'YYYY-MM-DD',
            defaultDate: moment(dateNow)
        });

        $('#survey_time').datetimepicker({
            useCurrent: true,
            format: 'HH:mm',
            defaultDate: moment(dateNow).hours(8).minutes(0).seconds(0).milliseconds(0) 
        }); 
    });
</script>

@endsection