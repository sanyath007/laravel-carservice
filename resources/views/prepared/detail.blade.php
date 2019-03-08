@extends('layouts.main')

@section('content')
<div class="container-fluid" ng-controller="preparedCtrl" ng-init="getPrepared('{{ $prepared->id }}')">
  
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
        <li class="breadcrumb-item active">รายละเอียดผลตรวจความพร้อมร่างกาย พขร.</li>
    </ol>

    <!-- page title -->
    <div class="page__title">
        <span>
            <i class="fa fa-calendar" aria-hidden="true"></i> รายละเอียดผลตรวจความพร้อมร่างกาย พขร. [ {{ $prepared->id }} ]
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

            <!-- <form id="frmPrepared" name="frmPrepared" action="{{ url('prepared/update') }}" method="post" role="form">
                <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->person_id }}">
                <input type="hidden" id="id" name="id" value="{{ $prepared->id }}">
                {{ csrf_field() }} -->

                <div class="panel panel-info">
                    <div class="panel-body">
                        <div class="col-md-6">
                            <div class="form-group" ng-class="{ 'has-error' : frmPrepared.prepared_date.$invalid}">
                                <label>วันที่</label>
                                <input type="text" 
                                        id="prepared_date" 
                                        name="prepared_date" 
                                        ng-model="prepared.prepared_date" 
                                        class="form-control" readonly>
                                <div class="help-block" ng-show="frmPrepared.prepared_date.$error.required">
                                    กรุณาเลือกวันที่
                                </div>
                            </div>                   
                        </div>

                        <div class="col-md-6">
                            <div class="form-group" ng-class="{ 'has-error' : frmPrepared.period.$invalid}">
                                <label>เวร</label>
                                <select id="period" name="period" ng-model="prepared.period" class="form-control" required>
                                    <option value="" ng-selected="prepared.period==''">-- กรุณาเลือก --</option>
                                    <option value="1" ng-selected="prepared.period==1">ดึก</option>
                                    <option value="2" ng-selected="prepared.period==2">เช้า</option>
                                    <option value="3" ng-selected="prepared.period==3">บ่าย</option>
                                </select>
                                <div class="help-block" ng-show="frmPrepared.period.$error.required">
                                    กรุณาเลือกประเภทการใช้บริการ
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group" ng-class="{ 'has-error' : frmPrepared.driver_id.$invalid}">
                                <label>พนักงานขับรถ</label>
                                <select id="driver_id" name="driver_id" ng-model="prepared.driver_id" class="form-control" required>
                                    <option value="" ng-selected="prepared.driver_id==''">-- กรุณาเลือก --</option>

                                    @foreach($drivers as $driver)
                                        <option value="{{ $driver->driver_id }}" 
                                                ng-selected="prepared.driver_id=={{ $driver->driver_id }}">
                                            {{ $driver->description }}
                                        </option>
                                    @endforeach

                                </select>
                                <div class="help-block" ng-show="frmPrepared.driver_id.$error.required">
                                    กรุณาเลือกพนักงานขับรถ
                                </div>
                            </div>  
                        </div>
                    </div><!-- /.panel-body -->
                </div><!-- /.panel -->

                <div class="panel panel-info">
                    <div class="panel-body">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">รายละเอียด</th>
                                    <th style="width: 15%; text-align: center;">ผลการตรวจ</th>
                                    <th style="width: 25%; text-align: center;">ระบุรายละเอียด</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="margin-left: 5px;">1. ความดันโลหิต</td>
                                    <td style="text-align: center;">
                                        <input type="radio" id="bp" name="bp" value="0" ng-checked="prepared.bp==0"> ปกติ
                                        <input type="radio" id="bp" name="bp" value="1" ng-checked="prepared.bp==1"> ผิดปกติ
                                    </td>
                                    <td style="text-align: center;">
                                        <input type="text" 
                                                id="bp_text" 
                                                name="bp_text" 
                                                ng-model="prepared.bp_text"
                                                class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="margin-left: 5px;">2. การทรงตัว</td>
                                    <td style="text-align: center;">
                                        <input type="radio" id="stable" name="stable" value="0" ng-checked="prepared.stable==0"> ปกติ
                                        <input type="radio" id="stable" name="stable" value="1" ng-checked="prepared.stable==1"> ผิดปกติ
                                    </td>
                                    <td style="text-align: center;">
                                        <input type="text" 
                                                id="stable_text" 
                                                name="stable_text" 
                                                ng-model="prepared.stable_text"
                                                class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="margin-left: 5px;">3. พฤติกรรมทั่วไป</td>
                                    <td style="text-align: center;">
                                        <input type="radio" id="behav" name="behav" value="0" ng-checked="prepared.behav==0"> ปกติ
                                        <input type="radio" id="behav" name="behav" value="1" ng-checked="prepared.behav==1"> ผิดปกติ
                                    </td>
                                    <td style="text-align: center;">
                                        <input type="text" 
                                                id="behav_text" 
                                                name="behav_text" 
                                                ng-model="prepared.behav_text"
                                                class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="margin-left: 5px;">4. แอลกอฮอล์</td>
                                    <td style="text-align: center;">
                                        <input type="radio" id="alcohol" name="alcohol" value="0" ng-checked="prepared.alcohol==0"> ปกติ
                                        <input type="radio" id="alcohol" name="alcohol" value="1" ng-checked="prepared.alcohol==1"> ผิดปกติ
                                    </td>
                                    <td style="text-align: center;">
                                        <input type="text" 
                                                id="alcohol_text" 
                                                name="alcohol_text" 
                                                ng-model="prepared.alcohol_text"
                                                class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="margin-left: 5px;">5. การทานยา</td>
                                    <td style="text-align: center;">
                                        <input type="radio" id="drug" name="drug" value="0" ng-checked="prepared.drug==0"> ไม่มี 
                                        <input type="radio" id="drug" name="drug" value="1" ng-checked="prepared.drug==1"> มี
                                    </td>
                                    <td style="text-align: center;">
                                        <input type="text" 
                                                id="drug_text" 
                                                name="drug_text" 
                                                ng-model="prepared.drug_text"
                                                class="form-control">
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div><!-- /.panel-body -->
                </div><!-- /.panel -->

                <div class="form-group">
                    <label>ข้อเสนอแนะอื่น ๆ (ถ้ามี)</label>
                    <textarea id="comment" name="comment" ng-model="prepared.comment" class="form-control" rows="5"></textarea>
                </div>
                
                <!-- <div>
                    <button ng-click="add($event, frmPrepared)" class="btn btn-warning pull-right">แก้ไข</button>
                </div> -->

            <!-- </form> -->

        </div><!-- /.col-md-12 -->
    </div><!-- /.row -->

</div><!-- /.container -->

<script>
    $(document).ready(function($) {
        var dateNow = new Date();

        $('#prepared_date').datetimepicker({
            useCurrent: true,
            format: 'YYYY-MM-DD',
            defaultDate: moment(dateNow)
        }); 
    });
</script>

@endsection