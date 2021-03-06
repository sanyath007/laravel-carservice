    @extends('layouts.main')

    @section('content')
    <div class="container-fluid" ng-controller="driverCtrl">
      
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
            <li class="breadcrumb-item active">บันทึกการพนักงานขับรถใหม่</li>
        </ol>

        <!-- page title -->
        <div class="page__title">
            <span>
                <i class="fa fa-calendar-plus-o" aria-hidden="true"></i> 
                บันทึกการพนักงานขับรถใหม่
            </span>
        </div>

        <hr />
        <!-- page title -->
        
        <form id="frmNewDriver" action="{{ url('/drivers/add') }}" method="post" enctype="multipart/form-data">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('person_id')}">
                        <label for="person_id">เลขบัตรประชาชน <span style="color: red;">*</span></label>
                        <input type="text" id="person_id" name="person_id" ng-model="newDriver.person_id" class="form-control">
                        <span class="glyphicon glyphicon-remove form-control-feedback" ng-show="checkValidate('person_id')"></span>
                        <span class="help-block" ng-show="checkValidate('person_id')">กรุณาระบุเลขบัตรประชาชน</span>
                    </div>
                </div>
                <!-- left column -->
        
                <!-- right column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('description')}">
                        <label for="description">ชื่อ-สกุล <span style="color: red;">*</span></label>
                        <input type="text" id="description" name="description" ng-model="newDriver.description" class="form-control">
                        <span class="glyphicon glyphicon-remove form-control-feedback" ng-show="checkValidate('description')"></span>
                        <span class="help-block" ng-show="checkValidate('description')">กรุณาระบุชื่อ-สกุล</span>
                    </div>
                </div>
                <!-- right column -->
            </div><!-- end row -->

            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('tel')}">
                        <label for="tel">โทรศัพท์ติดต่อ 1 <span style="color: red;">*</span></label>
                        <input type="text" id="tel" name="tel" ng-model="newDriver.tel" class="form-control">
                        <span class="glyphicon glyphicon-remove form-control-feedback" ng-show="checkValidate('tel')"></span>
                        <span class="help-block" ng-show="checkValidate('tel')">กรุณาระบุโทรศัพท์ติดต่อ 1</span>
                    </div>
                </div>
                <!-- left column -->
                
                <!-- right column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('tel2')}">
                        <label for="tel2">โทรศัพท์ติดต่อ 2 </label>
                        <input type="text" id="tel2" name="tel2" ng-model="newDriver.tel2" class="form-control">
                        <span class="glyphicon glyphicon-remove form-control-feedback" ng-show="checkValidate('tel2')"></span>
                        <span class="help-block" ng-show="checkValidate('tel2')">กรุณาระบุโทรศัพท์ติดต่อ 2</span>
                    </div>
                </div>
                <!-- right column -->
            </div><!-- end row -->

            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('license_no')}">
                        <label for="insurance_date">เลขที่ใบขับขี่ <span style="color: red;">*</span></label>
                        <input type="text" id="license_no" name="license_no" ng-model="newDriver.license_no" class="form-control">
                        <span class="glyphicon glyphicon-remove form-control-feedback" ng-show="checkValidate('license_no')"></span>
                        <span class="help-block" ng-show="checkValidate('license_no')">กรุณาระบุเลขที่ใบขับขี่</span>
                    </div>
                </div>
                <!-- left column -->
                
                <!-- right column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('license_type')}">
                        <label class="control-label" for="license_type">
                            ประเภทใบขับขี่ <span style="color: red;">*</span>
                        </label>
                        <select id="license_type" name="license_type" ng-model="newDriver.license_type" class="form-control">
                            <option value="">-- กรุณาเลือกประเภทใบขับขี่ --</option>
                            @foreach ($licenseTypes as $ltype)
                                <option value="{{ $ltype->license_type_id }}">
                                    {{ $ltype->license_type_name }}
                                </option>
                            @endforeach
                        </select>
                        <span class="help-block" ng-show="checkValidate('license_type')">กรุณาเลือกประเภทใบขับขี่</span>                        
                    </div>
                </div>
                <!-- right column -->
            </div><!-- end row -->
            
            <div class="page__title">
                <span>
                    <i class="fa fa-sticky-note-o" aria-hidden="true"></i> การตรวจสุขภาพ/สมรรถภาพ
                </span>
            </div>

            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('checkup_date')}">
                        <label for="checkup_date">วันที่ตรวจสุขภาพล่าสุด </label>
                        <input type="text" id="checkup_date" name="checkup_date" ng-model="newDriver.checkup_date" class="form-control">
                        <span class="glyphicon glyphicon-remove form-control-feedback" ng-show="checkValidate('checkup_date')"></span>
                        <span class="help-block" ng-show="checkValidate('checkup_date')">กรุณาเลือกวันที่ตรวจสุขภาพล่าสุด</span>
                    </div>
                </div>
                <!-- left column -->
                
                <!-- right column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('checkup_result')}">
                        <label for="checkup_result">ผลการตรวจสุขภาพล่าสุด </label>
                        <input type="text" id="checkup_result" name="checkup_result" ng-model="newDriver.checkup_result" class="form-control">
                        <span class="glyphicon glyphicon-remove form-control-feedback" ng-show="checkValidate('checkup_result')"></span>
                        <span class="help-block" ng-show="checkValidate('checkup_result')">กรุณาระบุผลการตรวจสุขภาพล่าสุด</span>
                    </div>
                </div>
                <!-- right column -->
            </div><!-- end row -->

            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('capability_date')}">
                        <label for="capability_date">วันที่ตรวจสมรรถภาพล่าสุด </label>
                        <input type="text" id="capability_date" name="capability_date" ng-model="newDriver.capability_date" class="form-control">
                        <span class="glyphicon glyphicon-remove form-control-feedback" ng-show="checkValidate('capability_date')"></span>
                        <span class="help-block" ng-show="checkValidate('capability_date')">กรุณาเลือกวันที่ตรวจสมรรถภาพล่าสุด</span>
                    </div>
                </div>
                <!-- left column -->
                
                <!-- right column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('capability_result')}">
                        <label for="capability_result">ผลการตรวจสมรรถภาพล่าสุด </label>
                        <input type="text" id="capability_result" name="capability_result" ng-model="newDriver.capability_result" class="form-control">
                        <span class="glyphicon glyphicon-remove form-control-feedback" ng-show="checkValidate('capability_result')"></span>
                        <span class="help-block" ng-show="checkValidate('capability_result')">กรุณาระบุผลการตรวจสมรรถภาพล่าสุด</span>
                    </div>
                </div>
                <!-- right column -->
            </div><!-- end row -->

            <div class="page__title">
                <span>
                    <i class="fa fa-sticky-note-o" aria-hidden="true"></i> การอบรม
                </span>
            </div>

            <div class="row" style="margin-top: 1.5rem">
                <!-- left column -->
                <div class="col-md-6">
                    <div style="min-height: 60px; display: flex; justify-content: flex-start; align-items: center;">
                        <span>
                            <input type="checkbox" id="cam_front" name="cam_front"> ผ่านการอบรมพนักงานขับรถฉุกเฉิน
                        </span>
                    </div>
                </div>
                <!-- left column -->

                <!-- right column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('certificated_date')}">
                        <label for="certificated_date">วันที่ผ่านการอบรม </label>
                        <input type="text" id="certificated_date" name="certificated_date" ng-model="newDriver.certificated_date" class="form-control">
                        <span class="glyphicon glyphicon-remove form-control-feedback" ng-show="checkValidate('certificated_date')"></span>
                        <span class="help-block" ng-show="checkValidate('certificated_date')">กรุณาเลือกวันที่ผ่านการอบรม</span>
                    </div>
                </div>
                <!-- right column -->
            </div><!-- end row -->

            <div class="row" style="margin-top: 1.5rem">
                <div class="col-md-12">
                    <div style="display: flex; justify-content: flex-start; margin-bottom: 1.5rem;">
                        <span>
                            <input type="checkbox" id="cam_back" name="cam_back"> ผ่านการอาสาสมัครฉุกเฉินการแพทย์ (อสพ.)
                        </span>
                    </div>
                </div>

                <!-- left column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('emr_sdate')}">
                        <label for="emr_sdate">วันที่ผ่านการอบรม </label>
                        <input type="text" id="emr_sdate" name="emr_sdate" ng-model="newDriver.emr_sdate" class="form-control">
                        <span class="glyphicon glyphicon-remove form-control-feedback" ng-show="checkValidate('emr_sdate')"></span>
                        <span class="help-block" ng-show="checkValidate('emr_sdate')">กรุณาเลือกวันที่ผ่านการอบรม</span>
                    </div>
                </div>
                <!-- left column -->

                <!-- right column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('emr_edate')}">
                        <label for="emr_edate">ถึงวันที่ </label>
                        <input type="text" id="emr_edate" name="emr_edate" ng-model="newDriver.emr_edate" class="form-control">
                        <span class="glyphicon glyphicon-remove form-control-feedback" ng-show="checkValidate('emr_edate')"></span>
                        <span class="help-block" ng-show="checkValidate('emr_edate')">กรุณาเลือกถึงวันที่</span>
                    </div>
                </div>
                <!-- right column -->
            </div><!-- end row -->

            <div class="page__title" style="margin-top: 1.5rem">
                <span>
                    <i class="fa fa-sticky-note-o" aria-hidden="true"></i> หมายเหตุ
                </span>
            </div>

            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <div style="min-height: 50px; display: flex; justify-content: flex-start; align-items: center;">
                        <span>
                            <input type="radio" id="driver_type" name="driver_type" value="1"> พขร. หลัก
                        </span>
                        <span style="margin-left: 20px;">
                            <input type="radio" id="driver_type" name="driver_type" value="2"> พขร. สำรอง
                        </span>
                    </div>

                   <div class="form-group">
                        <textarea id="remark" name="remark" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <!-- left column -->
            </div>
            <!-- end row -->            

            <div class="row">
                <!-- left column -->
                <div class="col-md-12">

                    <div class="form-group">
                        <label class="control-label" for="attachfile">รูป</label>
                        <input type="file" id="attachfile" name="attachfile" class="form-control" placeholder="รูป พขร.&hellip;">
                    </div>

                </div>
                <!-- left column -->
            </div>

            <div class="row">
                <div class="col-md-12">
                    <br><button class="btn btn-primary pull-right" ng-click="formValidate($event)">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก
                    </button>
                </div>
            </div>

            <input type="hidden" id="user" name="user" value="{{ Auth::user()->person_id }}">
            <input type="hidden" id="driver_id" name="driver_id" ng-model="newDriver.driverId">
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
