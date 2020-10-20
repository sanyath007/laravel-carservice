    @extends('layouts.main')

    @section('content')
    <div class="container-fluid" ng-controller="vehicleCtrl">
      
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
            <li class="breadcrumb-item active">บันทึกการรถใหม่</li>
        </ol>

        <!-- page title -->
        <div class="page__title">
            <span>
                <i class="fa fa-calendar-plus-o" aria-hidden="true"></i> 
                บันทึกการรถใหม่
            </span>
        </div>

        <hr />
        <!-- page title -->
        
        <form id="frmNewVehicle" action="{{ url('/vehicles/add') }}" method="post" enctype="multipart/form-data">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('vehicle_no')}">
                        <label for="doc_no">เลขรถ <span style="color: red;">*</span></label>
                        <input type="text" id="doc_no" name="vehicle_no" ng-model="newVehicle.vehicle_no" class="form-control">
                        <span class="glyphicon glyphicon-remove form-control-feedback" ng-show="checkValidate('vehicle_no')"></span>
                        <span class="help-block" ng-show="checkValidate('vehicle_no')">กรุณาระบุเลขรถ</span>
                    </div>
                </div>
                <!-- left column -->
        
                <!-- right column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('purchasedDate')}">
                        <label for="purchased_date">วันที่ซื้อ <span style="color: red;">*</span></label>
                        <input type="text" id="purchased_date" name="purchased_date" ng-model="newVehicle.purchasedDate" class="form-control">
                        <span class="glyphicon glyphicon-remove form-control-feedback" ng-show="checkValidate('purchasedDate')"></span>
                        <span class="help-block" ng-show="checkValidate('purchasedDate')">กรุณาเลือกวันที่ซื้อ</span>
                    </div>
                </div>
                <!-- right column -->
            </div><!-- end row -->

            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('color')}">
                        <label for="insurance_no">สี <span style="color: red;">*</span></label>
                        <input type="text" id="color" name="color" ng-model="newVehicle.color" class="form-control">
                        <span class="glyphicon glyphicon-remove form-control-feedback" ng-show="checkValidate('color')"></span>
                        <span class="help-block" ng-show="checkValidate('color')">กรุณาระบุสี</span>
                    </div>
                </div>
                <!-- left column -->
                
                <!-- right column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('year')}">
                        <label for="insurance_date">ปีรถ <span style="color: red;">*</span></label>
                        <input type="text" id="year" name="year" ng-model="newVehicle.year" class="form-control">
                        <span class="glyphicon glyphicon-remove form-control-feedback" ng-show="checkValidate('year')"></span>
                        <span class="help-block" ng-show="checkValidate('year')">กรุณาระบุปีรถ</span>
                    </div>
                </div>
                <!-- right column -->
            </div><!-- end row -->

            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('engineNo')}">
                        <label for="engine_no">เลขที่เครื่องยนต์ <span style="color: red;">*</span></label>
                        <input type="text" id="engine_no" name="engine_no" ng-model="newVehicle.engineNo" class="form-control">
                        <span class="glyphicon glyphicon-remove form-control-feedback" ng-show="checkValidate('engineNo')"></span>
                        <span class="help-block" ng-show="checkValidate('engineNo')">กรุณาระบุเลขที่เครื่องยนต์</span>
                    </div>
                </div>
                <!-- left column -->
                
                <!-- right column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('chassisNo')}">
                        <label for="chassis_no">เลขที่ตัวถัง <span style="color: red;">*</span></label>
                        <input type="text" id="chassis_no" name="chassis_no" ng-model="newVehicle.chassisNo" class="form-control">
                        <span class="glyphicon glyphicon-remove form-control-feedback" ng-show="checkValidate('chassisNo')"></span>
                        <span class="help-block" ng-show="checkValidate('chassisNo')">กรุณาระบุเลขที่ตัวถัง</span>
                    </div>
                </div>
                <!-- right column -->
            </div><!-- end row -->

            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('capacity')}">
                        <label for="capacity">ปริมาตรกระบอกสูบ (ซีซี.) <span style="color: red;">*</span></label>
                        <input type="text" id="capacity" name="capacity" ng-model="newVehicle.capacity" class="form-control">
                        <span class="help-block" ng-show="checkValidate('capacity')">กรุณาระบุปริมาตรกระบอกสูบ (ซีซี.)</span>
                    </div>
                </div>
                <!-- left column -->
        
                <!-- right column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('fuelType')}">
                        <label class="control-label" for="fuel_type">
                            ประเภทน้ำมันเชื้อเพลิง <span style="color: red;">*</span>
                        </label>
                        <select id="fuel_type" name="fuel_type" ng-model="newVehicle.fuelType" class="form-control">
                            <option value="">-- กรุณาเลือกประเภทน้ำมันเชื้อเพลิง --</option>
                            @foreach ($fuelTypes as $fuel)
                                <option value="{{ $fuel->fuel_type_id }}">
                                    {{ $fuel->fuel_type_name }}
                                </option>
                            @endforeach
                        </select>
                        <span class="help-block" ng-show="checkValidate('fuelType')">กรุณาเลือกประเภทน้ำมันเชื้อเพลิง</span>                        
                    </div>
                </div>
                <!-- right column -->
            </div><!-- end row -->

            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('regNo')}">
                        <label for="reg_no">เลขทะเบียน <span style="color: red;">*</span></label>
                        <input type="text" id="reg_no" name="reg_no" ng-model="newVehicle.regNo" class="form-control">
                        <span class="glyphicon glyphicon-remove form-control-feedback" ng-show="checkValidate('regNo')"></span>
                        <span class="help-block" ng-show="checkValidate('regNo')">กรุณาระบุเลขทะเบียน</span>
                    </div>
                </div>
                <!-- left column -->

                <!-- right column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('regChw')}">
                        <label class="control-label" for="regChw">
                            จังหวัด <span style="color: red;">*</span>
                        </label>
                        <select id="reg_chw" name="reg_chw" ng-model="newVehicle.regChw" class="form-control">
                            <option value="">-- กรุณาเลือกจังหวัด --</option>
                            @foreach ($changwats as $changwat)
                                <option value="{{ $changwat->chw_id }}">
                                    {{ $changwat->changwat }}
                                </option>
                            @endforeach
                        </select>
                        <span class="help-block" ng-show="checkValidate('regChw')">กรุณาเลือกจังหวัด</span>                        
                    </div>
                </div>
                <!-- right column -->
            </div><!-- end row -->

            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('regDate')}">
                        <label for="reg_date">วันที่จดทะเบียน <span style="color: red;">*</span></label>
                        <input type="text" id="reg_date" name="reg_date" ng-model="newVehicle.regDate" class="form-control">
                        <span class="glyphicon glyphicon-remove form-control-feedback" ng-show="checkValidate('regDate')"></span>
                        <span class="help-block" ng-show="checkValidate('regDate')">กรุณาเลือกวันที่จดทะเบียน</span>
                    </div>
                </div>
                <!-- left column -->
        
                <!-- right column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('vender')}">
                        <label class="control-label" for="vender">
                            ตัวแทนจำหน่าย <span style="color: red;">*</span>
                        </label>
                        <select id="vender" name="vender" ng-model="newVehicle.vender" class="form-control">
                            <option value="">-- กรุณาเลือกตัวแทนจำหน่าย --</option>
                            @foreach ($venders as $vender)
                                <option value="{{ $vender->vender_id }}">
                                    {{ $vender->vender_name }}
                                </option>
                            @endforeach
                        </select>
                        <span class="help-block" ng-show="checkValidate('vender')">กรุณาเลือกตัวแทนจำหน่าย</span>                        
                    </div>
                </div>
                <!-- right column -->
            </div><!-- end row -->

            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('method')}">
                        <label class="control-label" for="method">
                            ประเภทการได้มา <span style="color: red;">*</span>
                        </label>
                        <select id="method" name="method" ng-model="newVehicle.method" class="form-control">
                            <option value="">-- กรุณาเลือกประเภทการได้มา --</option>
                            @foreach ($venders as $vender)
                                <option value="{{ $vender->vender_id }}">
                                    {{ $vender->vender_name }}
                                </option>
                            @endforeach
                        </select>
                        <span class="help-block" ng-show="checkValidate('method')">กรุณาเลือกประเภทการได้มา</span>                        
                    </div>
                </div>
                <!-- left column -->
        
                <!-- right column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('cost')}">
                        <label for="cost">ราคา <span style="color: red;">*</span></label>
                        <input type="text" id="cost" name="cost" ng-model="newVehicle.cost" class="form-control">
                        <span class="help-block" ng-show="checkValidate('cost')">กรุณาระบุราคา</span>
                    </div>
                </div>
                <!-- right column -->
            </div><!-- end row -->
            
            <div class="page__title">
                <span>
                    <i class="fa fa-sticky-note-o" aria-hidden="true"></i> Accessories
                </span>
            </div>

            <div class="row" style="margin-top: 1.5rem">
                <!-- left column -->
                <div class="col-md-9">
                    <div style="display: flex; justify-content: space-around;">
                        <span>
                            <input type="checkbox" id="cam_front" name="cam_front"> กล้องหน้า
                        </span>
                        <span>
                            <input type="checkbox" id="cam_back" name="cam_back"> กล้องหลัง
                        </span>
                        <span>
                            <input type="checkbox" id="cam_driver" name="cam_driver"> กล้องคนขับ
                        </span>
                        <span>
                            <input type="checkbox" id="gps" name="gps"> ระบบ GPS
                        </span>
                        <span>
                            <input type="checkbox" id="radio_com" name="radio_com"> วิทยุสื่อสาร
                        </span>
                        <span>
                            <input type="checkbox" id="light" name="light"> ไฟวับวาบ
                        </span>
                        <span>
                            <input type="checkbox" id="siren" name="siren"> ไซเรน
                        </span>
                        <span>
                            <input type="checkbox" id="tele_med" name="tele_med"> ระบบ Tele Med
                        </span>
                    </div>
                </div>
                <!-- left column -->
            </div><!-- end row -->

            <div class="page__title" style="margin-top: 1.5rem">
                <span>
                    <i class="fa fa-sticky-note-o" aria-hidden="true"></i> หมายเหตุ
                </span>

                <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                   <div class="form-group">
                        <textarea id="remark" name="remark" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <!-- left column -->
            </div><!-- end row -->
            </div>

            <div class="row">
                <!-- left column -->
                <div class="col-md-12">

                    <div class="form-group">
                        <label class="control-label" for="attachfile">รูป</label>
                        <input type="file" id="attachfile" name="attachfile" class="form-control" placeholder="สถานที่&hellip;" ng-keyup="queryLocation($event)" autocomplete="off" ng-keypress="enterToAddLocation($event)">
                    </div>

                </div>
                <!-- left column -->
            </div>

            <div class="row">
                <div class="col-md-12">
                    <br>
                    <button class="btn btn-primary pull-right" ng-click="formValidate($event)">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก
                    </button>
                </div>
            </div>

            <input type="hidden" id="user" name="user" value="{{ Auth::user()->person_id }}">
            <input type="hidden" id="vehicle_id" name="vehicle_id" ng-model="newVehicle.vehicleId">
            {{ csrf_field() }}
        </form>
        
        <script>
            $(document).ready(function($) {
                var dateNow = new Date();

                $('#purchased_date').datetimepicker({
                    useCurrent: true,
                    format: 'YYYY-MM-DD',
                    defaultDate: moment(dateNow)
                })
                .on("dp.change", function(e) {
                    let new_date = moment(e.date, "DD-MM-YYYY").add(1, 'years');
                    console.log(new_date);
                    $('#insurance_renewal_date').data('DateTimePicker').date(new_date);
                }); 

                $('#reg_date').datetimepicker({
                    useCurrent: true,
                    format: 'YYYY-MM-DD',
                    defaultDate: moment(dateNow)
                });
            });
        </script>

    </div><!-- /.container -->
    @endsection
