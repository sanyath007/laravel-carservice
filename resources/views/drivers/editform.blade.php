@extends('layouts.main')

@section('content')
<div class="container-fluid" ng-controller="driverCtrl" ng-init="edit({{ $driver }})">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">หน้าหลัก</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/drivers/list') }}">รายการพนักงานขับรถ</a></li>
        <li class="breadcrumb-item active">แก้ไขข้อมูลพนักงานขับรถ</li>
        <li class="breadcrumb-item active">{{ $driver->description }}</li>
    </ol>

    <!-- page title -->
    <div class="page__title-wrapper">
        <div class="page__title">
            <span>
                <i class="fa fa-calendar-plus-o" aria-hidden="true"></i> 
                แก้ไขข้อมูลพนักงานขับรถ
                <span class="text-muted">
                    ({{ $driver->description }})
                </span>
            </span>
        </div>
        
        <hr />
    </div>
    <!-- page title -->
    
    <form id="frmEditDriver" action="{{ url('/drivers/update') }}" method="post" enctype="multipart/form-data">
        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('person_id')}">
                    <label for="person_id">
                        เลขบัตรประชาชน <span style="color: red;">*</span>
                    </label>
                    <input
                        type="text"
                        id="person_id"
                        name="person_id"
                        ng-model="newDriver.person_id"
                        class="form-control"
                    />
                    <span
                        class="glyphicon glyphicon-remove form-control-feedback"
                        ng-show="checkValidate('person_id')"
                    ></span>
                    <span class="help-block" ng-show="checkValidate('person_id')">
                        กรุณาระบุเลขบัตรประชาชน
                    </span>
                </div>
            </div>
            <!-- left column -->
    
            <!-- right column -->
            <div class="col-md-6">
                <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('description')}">
                    <label for="description">
                        ชื่อ-สกุล <span style="color: red;">*</span>
                    </label>
                    <input
                        type="text"
                        id="description"
                        name="description"
                        ng-model="newDriver.description"
                        class="form-control"
                    />
                    <span
                        class="glyphicon glyphicon-remove form-control-feedback"
                        ng-show="checkValidate('description')"
                    ></span>
                    <span class="help-block" ng-show="checkValidate('description')">
                        กรุณาระบุชื่อ-สกุล
                    </span>
                </div>
            </div>
            <!-- right column -->
        </div><!-- end row -->

        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('tel')}">
                    <label for="tel">
                        โทรศัพท์ติดต่อ 1 <span style="color: red;">*</span>
                    </label>
                    <input
                        type="text"
                        id="tel"
                        name="tel"
                        ng-model="newDriver.tel"
                        class="form-control"
                    />
                    <span
                        class="glyphicon glyphicon-remove form-control-feedback"
                        ng-show="checkValidate('tel')"
                    ></span>
                    <span class="help-block" ng-show="checkValidate('tel')">
                        กรุณาระบุโทรศัพท์ติดต่อ 1
                    </span>
                </div>
            </div>
            <!-- left column -->
            
            <!-- right column -->
            <div class="col-md-6">
                <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('tel2')}">
                    <label for="tel2">
                        โทรศัพท์ติดต่อ 2
                    </label>
                    <input
                        type="text"
                        id="tel2"
                        name="tel2"
                        ng-model="newDriver.tel2"
                        class="form-control"
                    />
                    <span
                        class="glyphicon glyphicon-remove form-control-feedback"
                        ng-show="checkValidate('tel2')"
                    ></span>
                    <span class="help-block" ng-show="checkValidate('tel2')">
                        กรุณาระบุโทรศัพท์ติดต่อ 2
                    </span>
                </div>
            </div>
            <!-- right column -->
        </div><!-- end row -->

        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('license_no')}">
                    <label for="license_no">
                        เลขที่ใบขับขี่ <span style="color: red;">*</span>
                    </label>
                    <input
                        type="text"
                        id="license_no"
                        name="license_no"
                        ng-model="newDriver.license_no"
                        class="form-control"
                    />
                    <span
                        class="glyphicon glyphicon-remove form-control-feedback"
                        ng-show="checkValidate('license_no')"
                    ></span>
                    <span class="help-block" ng-show="checkValidate('license_no')">
                        กรุณาระบุเลขที่ใบขับขี่
                    </span>
                </div>
            </div>
            <!-- left column -->
            
            <!-- right column -->
            <div class="col-md-6">
                <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('license_type')}">
                    <label class="control-label" for="license_type">
                        ประเภทใบขับขี่ <span style="color: red;">*</span>
                    </label>
                    <select
                        id="license_type"
                        name="license_type"
                        ng-model="newDriver.license_type"
                        class="form-control"
                    >
                        <option value="">-- กรุณาเลือกประเภทใบขับขี่ --</option>
                        @foreach ($licenseTypes as $ltype)
                            <option value="{{ $ltype->license_type_id }}">
                                {{ $ltype->license_type_name }}
                            </option>
                        @endforeach
                    </select>
                    <span class="help-block" ng-show="checkValidate('license_type')">
                        กรุณาเลือกประเภทใบขับขี่
                    </span>                        
                </div>
            </div>
            <!-- right column -->
        </div><!-- end row -->

        <div class="row">
            <div class="col-md-6">
                <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('capability_result')}">
                    <label for="capability_result">
                        ประเภท พขร.
                    </label>
                    <div class="radio__wrapper">
                        <div style="flex: 1;">
                            <input
                                type="radio"
                                id="driver_type"
                                name="driver_type"
                                value="1"
                                ng-checked="newDriver.driver_type === 1"
                            /> พขร. หลัก
                        </div>
                        <div style="flex: 1;">
                            <input
                                type="radio"
                                id="driver_type"
                                name="driver_type"
                                value="2"
                                ng-checked="newDriver.driver_type === 2"
                            /> พขร. สำรอง
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end row -->

        <div class="row">
            <div class="col-md-12">
                <label class="control-label" for="attachfile">
                    หมายเหตุ
                </label>
                <div class="form-group">
                    <textarea
                        id="remark"
                        name="remark"
                        cols="30"
                        rows="5"
                        class="form-control"
                        ng-model="newDriver.remark"
                    ></textarea>
                </div>
            </div>

            <div class="col-md-12">

                <div class="form-group">
                    <label class="control-label" for="attachfile">
                        รูป
                    </label>
                    <input
                        type="file"
                        id="attachfile"
                        name="attachfile"
                        class="form-control"
                        placeholder="รูป พขร.&hellip;"
                    />
                </div>
            </div>
        </div>

        <div class="page__title">
            <span>
                <i class="fa fa-sticky-note-o" aria-hidden="true"></i> การตรวจสุขภาพ/สมรรถภาพ
            </span>
        </div>

        <div class="row" style="margin-top: 10px;">
            <div class="col-md-6">
                <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('checkup_date')}">
                    <label for="checkup_date">
                        วันที่ตรวจสุขภาพล่าสุด
                    </label>
                    <input
                        type="text"
                        id="checkup_date"
                        name="checkup_date"
                        ng-model="newDriver.checkup_date"
                        class="form-control"
                    />
                    <span
                        class="glyphicon glyphicon-remove form-control-feedback"
                        ng-show="checkValidate('checkup_date')"
                    ></span>
                    <span class="help-block" ng-show="checkValidate('checkup_date')">
                        กรุณาเลือกวันที่ตรวจสุขภาพล่าสุด
                    </span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('checkup_result')}">
                    <label for="checkup_result">ผลการตรวจสุขภาพล่าสุด </label>
                    <div class="radio__wrapper">
                        <div style="flex: 1;">
                            <input
                                type="radio"
                                id="checkup_result"
                                name="checkup_result"
                                ng-checked="newDriver.checkup_result === 0"
                            /> ปกติ
                        </div>
                        <div style="flex: 1;">
                            <input
                                type="radio"
                                id="checkup_result"
                                name="checkup_result"
                                ng-checked="newDriver.checkup_result === 1"
                            /> ผิดปกติ
                        </div>
                    </div>
                    <span
                        class="glyphicon glyphicon-remove form-control-feedback"
                        ng-show="checkValidate('checkup_result')"
                    ></span>
                    <span class="help-block" ng-show="checkValidate('checkup_result')">
                        กรุณาระบุผลการตรวจสุขภาพล่าสุด
                    </span>
                </div>
            </div>
        </div><!-- end row -->

        <div class="row">
            <div class="col-md-6">
                <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('capability_date')}">
                    <label for="capability_date">วันที่ตรวจสมรรถภาพล่าสุด </label>
                    <input
                        type="text"
                        id="capability_date"
                        name="capability_date"
                        ng-model="newDriver.capability_date"
                        class="form-control"
                    />
                    <span
                        class="glyphicon glyphicon-remove form-control-feedback"
                        ng-show="checkValidate('capability_date')"
                    ></span>
                    <span class="help-block" ng-show="checkValidate('capability_date')">
                        กรุณาเลือกวันที่ตรวจสมรรถภาพล่าสุด
                    </span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('capability_result')}">
                    <label for="capability_result">ผลการตรวจสมรรถภาพล่าสุด </label><br>
                    <div class="radio__wrapper">
                        <div style="flex: 1;">
                            <input
                                type="radio"
                                id="capability_result"
                                name="capability_result"
                                ng-checked="newDriver.capability_result === 0"
                            /> ปกติ
                        </div>
                        <div style="flex: 1;">
                            <input
                                type="radio"
                                id="capability_result"
                                name="capability_result"
                                ng-checked="newDriver.capability_result === 1"
                            /> ผิดปกติ
                        </div>
                    </div>
                    <span
                        class="glyphicon glyphicon-remove form-control-feedback"
                        ng-show="checkValidate('capability_result')"
                    ></span>
                    <span class="help-block" ng-show="checkValidate('capability_result')">
                        กรุณาระบุผลการตรวจสมรรถภาพล่าสุด
                    </span>
                </div>
            </div>
        </div><!-- end row -->

        <div class="page__title">
            <span>
                <i class="fa fa-sticky-note-o" aria-hidden="true"></i> การอบรม
            </span>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for=""></label>
                    <div class="radio__wrapper">
                        <div style="flex: 1;">
                            <input
                                type="checkbox"
                                id="is_certificated"
                                name="is_certificated"
                                ng-checked="newDriver.is_certificated === 1"
                            /> ผ่านการอบรมพนักงานขับรถฉุกเฉิน
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('certificated_date')}">
                    <label for="certificated_date">
                        วันที่ผ่านการอบรม
                    </label>
                    <input
                        type="text"
                        id="certificated_date"
                        name="certificated_date"
                        ng-model="newDriver.certificated_date"
                        class="form-control"
                    />
                    <span
                        class="glyphicon glyphicon-remove form-control-feedback"
                        ng-show="checkValidate('certificated_date')"
                    ></span>
                    <span class="help-block" ng-show="checkValidate('certificated_date')">
                        กรุณาเลือกวันที่ผ่านการอบรม
                    </span>
                </div>
            </div>
        </div><!-- end row -->

        <div class="row" style="margin-top: 1.5rem">
            <div class="col-md-4">
                <div class="form-group">
                    <label for=""></label>
                    <div class="radio__wrapper">
                        <div style="flex: 1;">
                            <input
                                type="checkbox"
                                id="is_emr"
                                name="is_emr"
                                ng-checked="newDriver.is_emr === 1"
                            /> ผ่านการอาสาสมัครฉุกเฉินการแพทย์ (อสพ.)
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('emr_sdate')}">
                    <label for="emr_sdate">
                        วันที่ผ่านการอบรม
                    </label>
                    <input
                        type="text"
                        id="emr_sdate"
                        name="emr_sdate"
                        ng-model="newDriver.emr_sdate"
                        class="form-control"
                    />
                    <span
                        class="glyphicon glyphicon-remove form-control-feedback"
                        ng-show="checkValidate('emr_sdate')"
                    ></span>
                    <span class="help-block" ng-show="checkValidate('emr_sdate')">
                        กรุณาเลือกวันที่ผ่านการอบรม
                    </span>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('emr_edate')}">
                    <label for="emr_edate">
                        ถึงวันที่
                    </label>
                    <input
                        type="text"
                        id="emr_edate"
                        name="emr_edate"
                        ng-model="newDriver.emr_edate"
                        class="form-control"
                    />
                    <span
                        class="glyphicon glyphicon-remove form-control-feedback"
                        ng-show="checkValidate('emr_edate')"
                    ></span>
                    <span class="help-block" ng-show="checkValidate('emr_edate')">
                        กรุณาเลือกถึงวันที่
                    </span>
                </div>
            </div>
        </div><!-- end row -->

        <div class="row">
            <div class="col-md-12">
                <button
                    class="btn btn-warning pull-right"
                    ng-click="formValidate($event, 'frmEditDriver')"
                >
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> แก้ไข
                </button>
            </div>
        </div>

        <input type="hidden" id="user" name="user" value="{{ Auth::user()->person_id }}">
        <input type="hidden" id="driver_id" name="driver_id" value="{{ $driver->driver_id }}">
        {{ csrf_field() }}
    </form>
    
    <script>
        $(document).ready(function($) {
            var dateNow = new Date();

            $('#checkup_date').datetimepicker({
                useCurrent: true,
                format: 'YYYY-MM-DD',
            });

            $('#capability_date').datetimepicker({
                useCurrent: true,
                format: 'YYYY-MM-DD',
            });

            $('#certificated_date').datetimepicker({
                useCurrent: true,
                format: 'YYYY-MM-DD',
            });

            $('#emr_sdate').datetimepicker({
                useCurrent: true,
                format: 'YYYY-MM-DD',
            });

            $('#emr_edate').datetimepicker({
                useCurrent: true,
                format: 'YYYY-MM-DD',
            });
        });
    </script>

</div><!-- /.container -->
@endsection
