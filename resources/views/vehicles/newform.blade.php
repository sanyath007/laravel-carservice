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
                        <label for="vehicle_no">เลขรถ </label>
                        <input type="text" id="vehicle_no" name="vehicle_no" ng-model="newVehicle.vehicle_no" class="form-control">
                        <span class="glyphicon glyphicon-remove form-control-feedback" ng-show="checkValidate('vehicle_no')"></span>
                        <span class="help-block" ng-show="checkValidate('vehicle_no')">กรุณาระบุเลขรถ</span>
                    </div>
                </div>
                <!-- left column -->
        
                <!-- right column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('purchased_date')}">
                        <label for="purchased_date">วันที่ซื้อ <span style="color: red;">*</span></label>
                        <input type="text" id="purchased_date" name="purchased_date" ng-model="newVehicle.purchased_date" class="form-control">
                        <span class="glyphicon glyphicon-remove form-control-feedback" ng-show="checkValidate('purchased_date')"></span>
                        <span class="help-block" ng-show="checkValidate('purchased_date')">กรุณาเลือกวันที่ซื้อ</span>
                    </div>
                </div>
                <!-- right column -->
            </div><!-- end row -->

            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('manufacturer')}">
                        <label class="control-label" for="manufacturer">
                            ยีห้อ <span style="color: red;">*</span>
                        </label>
                        <select id="manufacturer" name="manufacturer" ng-model="newVehicle.manufacturer" class="form-control">
                            <option value="">-- กรุณาเลือกยีห้อ --</option>
                            @foreach ($manufacturers as $manufacturer)
                                <option value="{{ $manufacturer->manufacturer_id }}">
                                    {{ $manufacturer->manufacturer_name }}
                                </option>
                            @endforeach
                        </select>
                        <span class="help-block" ng-show="checkValidate('manufacturer')">กรุณาเลือกยีห้อ</span>                        
                    </div>
                </div>
                <!-- left column -->
        
                <!-- right column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('model')}">
                        <label for="model">รุ่น <span style="color: red;">*</span></label>
                        <input type="text" id="model" name="model" ng-model="newVehicle.model" class="form-control">
                        <span class="help-block" ng-show="checkValidate('model')">กรุณาระบุรุ่น</span>
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
                        <label for="year">ปีรถ <span style="color: red;">*</span></label>
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
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('engine_no')}">
                        <label for="engine_no">เลขที่เครื่องยนต์ <span style="color: red;">*</span></label>
                        <input type="text" id="engine_no" name="engine_no" ng-model="newVehicle.engine_no" class="form-control">
                        <span class="glyphicon glyphicon-remove form-control-feedback" ng-show="checkValidate('engine_no')"></span>
                        <span class="help-block" ng-show="checkValidate('engine_no')">กรุณาระบุเลขที่เครื่องยนต์</span>
                    </div>
                </div>
                <!-- left column -->
                
                <!-- right column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('chassis_no')}">
                        <label for="chassis_no">เลขที่ตัวถัง <span style="color: red;">*</span></label>
                        <input type="text" id="chassis_no" name="chassis_no" ng-model="newVehicle.chassis_no" class="form-control">
                        <span class="glyphicon glyphicon-remove form-control-feedback" ng-show="checkValidate('chassis_no')"></span>
                        <span class="help-block" ng-show="checkValidate('chassis_no')">กรุณาระบุเลขที่ตัวถัง</span>
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
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('fuel_type')}">
                        <label class="control-label" for="fuel_type">
                            ประเภทน้ำมันเชื้อเพลิง <span style="color: red;">*</span>
                        </label>
                        <select id="fuel_type" name="fuel_type" ng-model="newVehicle.fuel_type" class="form-control">
                            <option value="">-- กรุณาเลือกประเภทน้ำมันเชื้อเพลิง --</option>
                            @foreach ($fuelTypes as $fuel)
                                <option value="{{ $fuel->fuel_type_id }}">
                                    {{ $fuel->fuel_type_name }}
                                </option>
                            @endforeach
                        </select>
                        <span class="help-block" ng-show="checkValidate('fuel_type')">กรุณาเลือกประเภทน้ำมันเชื้อเพลิง</span>                        
                    </div>
                </div>
                <!-- right column -->
            </div><!-- end row -->

            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('vehicle_cate')}">
                        <label for="vehicle_cate">ชนิดรถ <span style="color: red;">*</span></label>
                        <select id="vehicle_cate" name="vehicle_cate" ng-model="newVehicle.vehicle_cate" class="form-control">
                            <option value="">-- กรุณาเลือกชนิดรถ --</option>
                            @foreach ($vCates as $cate)
                                <option value="{{ $cate->vehicle_cate_id }}">
                                    {{ $cate->vehicle_cate_name }}
                                </option>
                            @endforeach
                        </select>
                        <span class="help-block" ng-show="checkValidate('vehicle_cate')">กรุณาเลือกชนิดรถ</span>
                    </div>
                </div>
                <!-- left column -->
        
                <!-- right column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('vehicle_type')}">
                        <label class="control-label" for="vehicle_type">
                            ประเภทการใช้งาน <span style="color: red;">*</span>
                        </label>
                        <select id="vehicle_type" name="vehicle_type" ng-model="newVehicle.vehicle_type" class="form-control">
                            <option value="">-- กรุณาเลือกประเภทการใช้งาน --</option>
                            @foreach ($vTypes as $type)
                                <option value="{{ $type->vehicle_type_id }}">
                                    {{ $type->vehicle_type_name }}
                                </option>
                            @endforeach
                        </select>
                        <span class="help-block" ng-show="checkValidate('vehicle_type')">กรุณาเลือกประเภทการใช้งาน</span>                        
                    </div>
                </div>
                <!-- right column -->
            </div><!-- end row -->

            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('reg_no')}">
                        <label for="reg_no">เลขทะเบียน <span style="color: red;">*</span></label>
                        <input type="text" id="reg_no" name="reg_no" ng-model="newVehicle.reg_no" class="form-control">
                        <span class="glyphicon glyphicon-remove form-control-feedback" ng-show="checkValidate('reg_no')"></span>
                        <span class="help-block" ng-show="checkValidate('reg_no')">กรุณาระบุเลขทะเบียน</span>
                    </div>
                </div>
                <!-- left column -->

                <!-- right column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('reg_chw')}">
                        <label class="control-label" for="reg_chw">
                            จังหวัด <span style="color: red;">*</span>
                        </label>
                        <select id="reg_chw" name="reg_chw" ng-model="newVehicle.reg_chw" class="form-control">
                            <option value="">-- กรุณาเลือกจังหวัด --</option>
                            @foreach ($changwats as $changwat)
                                <option value="{{ $changwat->chw_id }}">
                                    {{ $changwat->changwat }}
                                </option>
                            @endforeach
                        </select>
                        <span class="help-block" ng-show="checkValidate('reg_chw')">กรุณาเลือกจังหวัด</span>                        
                    </div>
                </div>
                <!-- right column -->
            </div><!-- end row -->

            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('reg_date')}">
                        <label for="reg_date">วันที่จดทะเบียน <span style="color: red;">*</span></label>
                        <input type="text" id="reg_date" name="reg_date" ng-model="newVehicle.reg_date" class="form-control">
                        <span class="glyphicon glyphicon-remove form-control-feedback" ng-show="checkValidate('reg_date')"></span>
                        <span class="help-block" ng-show="checkValidate('reg_date')">กรุณาเลือกวันที่จดทะเบียน</span>
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
                            @foreach ($methods as $method)
                                <option value="{{ $method->method_id }}">
                                    {{ $method->method_name }}
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
                            <input type="checkbox" id="cam_front" name="cam_front" value="1"> กล้องหน้า
                        </span>
                        <span>
                            <input type="checkbox" id="cam_back" name="cam_back" value="1"> กล้องหลัง
                        </span>
                        <span>
                            <input type="checkbox" id="cam_driver" name="cam_driver" value="1"> กล้องคนขับ
                        </span>
                        <span>
                            <input type="checkbox" id="gps" name="gps" value="1"> ระบบ GPS
                        </span>
                        <span>
                            <input type="checkbox" id="radio_com" name="radio_com" value="1"> วิทยุสื่อสาร
                        </span>
                        <span>
                            <input type="checkbox" id="light" name="light" value="1"> ไฟวับวาบ
                        </span>
                        <span>
                            <input type="checkbox" id="siren" name="siren" value="1"> ไซเรน
                        </span>
                        <span>
                            <input type="checkbox" id="tele_med" name="tele_med" value="1"> ระบบ Tele Med
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
                        <input type="file" id="attachfile" name="attachfile" class="form-control" placeholder="อัพโหลดรูป&hellip;" autocomplete="off">
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
                    format: 'YYYY-MM-DD'
                });

                $('#reg_date').datetimepicker({
                    useCurrent: true,
                    format: 'YYYY-MM-DD'
                });
            });
        </script>

    </div><!-- /.container -->
    @endsection
