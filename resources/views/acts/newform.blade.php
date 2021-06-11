    @extends('layouts.main')

    @section('content')
    <div class="container-fluid" ng-controller="actCtrl" ng-init="popUpAllVehicle()">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">หน้าหลัก</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/acts/list') }}">รายการต่อ พรบ.</a></li>
            <li class="breadcrumb-item active">บันทึกการต่อ พรบ.</li>
        </ol>

        <!-- page title -->
        <div class="page__title-wrapper">
            <div class="page__title">
                <span>
                    <i class="fa fa-calendar-plus-o" aria-hidden="true"></i> 
                    บันทึกการต่อ พรบ.
                    <span class="text-muted">
                        (@{{ frmVehicleDetail }})
                    </span>

                    <a class="btn btn-warning btn-sm" ng-show="frmVehicleDetail" ng-click="popUpAllVehicle()">
                        <i class="fa fa-car" aria-hidden="true"></i>
                        เปลี่ยนรถ
                    </a>
                </span>
            </div>

            <hr />
        </div><!-- page title -->
        
        <form id="frmNewAct" action="{{ url('/acts/add') }}" method="post" enctype="multipart/form-data">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('doc_no')}">
                        <label for="doc_no">
                            เลขที่หนังสือขออนุมัติ <span style="color: red;">*</span>
                        </label>
                        <input
                            type="text"
                            id="doc_no"
                            name="doc_no"
                            ng-model="newAct.docNo"
                            class="form-control"
                        />
                        <span
                            class="glyphicon glyphicon-remove form-control-feedback"
                            ng-show="checkValidate('doc_no')"
                        ></span>
                        <span class="help-block" ng-show="checkValidate('doc_no')">
                            กรุณาระบุเลขที่หนังสือขออนุมัติ
                        </span>
                    </div>
                </div>
                <!-- left column -->
        
                <!-- right column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('doc_date')}">
                        <label for="act_date">
                            วันที่หนังสือขออนุมัติ <span style="color: red;">*</span>
                        </label>
                        <input
                            type="text"
                            id="doc_date"
                            name="doc_date"
                            ng-model="newAct.docDate"
                            class="form-control"
                        />
                        <span
                            class="glyphicon glyphicon-remove form-control-feedback"
                            ng-show="checkValidate('doc_date')"
                        ></span>
                        <span class="help-block" ng-show="checkValidate('doc_date')">
                            กรุณาเลือกวันที่หนังสือขออนุมัติ
                        </span>
                    </div>
                </div>
                <!-- right column -->
            </div><!-- end row -->

            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('act_no')}">
                        <label for="act_no">
                            เลขที่กรมธรรม์ <span style="color: red;">*</span>
                        </label>
                        <input
                            type="text"
                            id="act_no"
                            name="act_no"
                            ng-model="newAct.actNo"
                            class="form-control"
                        />
                        <span
                            class="glyphicon glyphicon-remove form-control-feedback"
                            ng-show="checkValidate('act_no')"
                        ></span>
                        <span class="help-block" ng-show="checkValidate('act_no')">
                            กรุณาระบุเลขที่กรมธรรม์
                        </span>
                    </div>
                </div>
                <!-- left column -->
        
                <!-- right column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('company')}">
                        <label class="control-label" for="company">
                            บริษัท <span style="color: red;">*</span>
                        </label>
                        <select id="company" name="company" ng-model="newAct.company" class="form-control">
                            <option value="">-- กรุณาเลือกบริษัท --</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->insurance_company_id }}">
                                    {{ $company->insurance_company_name }}
                                </option>
                            @endforeach
                        </select>                        
                        <!-- <span
                            class="glyphicon glyphicon-remove form-control-feedback"
                            ng-show="checkValidate('company')"
                        ></span> -->
                        <span class="help-block" ng-show="checkValidate('company')">
                            กรุณาเลือกบริษัท
                        </span>                        
                    </div>
                </div>
                <!-- right column -->
            </div><!-- end row -->

            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('act_detail')}">
                        <label class="control-label" for="act_detail">
                            รายละเอียด
                        </label>
                        <textarea
                            id="act_detail"
                            name="act_detail"
                            ng-model="newAct.actDetail"
                            cols="30"
                            rows="5"
                            class="form-control"
                        ></textarea>
                        <span
                            class="glyphicon glyphicon-remove form-control-feedback"
                            ng-show="checkValidate('act_detail')"
                        ></span>
                        <span class="help-block" ng-show="checkValidate('act_detail')">
                            กรุณาระบุรายละเอียด
                        </span>
                    </div>
                </div>
                <!-- left column -->
            </div><!-- end row -->
            
            <div class="page__title">
                <span>
                    <i class="fa fa-sticky-note-o" aria-hidden="true"></i> ระยะเวลาประกัน
                </span>
            </div>

            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('act_start_date')}">
                        <label class="control-label" for="from_date">
                            เริ่มต้นวันที่ <span style="color: red;">*</span>
                        </label>
                        <input
                            type="text"
                            id="act_start_date"
                            name="act_start_date"
                            ng-model="newAct.actStartDate"
                            class="form-control"
                        />
                        <span
                            class="glyphicon glyphicon-remove form-control-feedback"
                            ng-show="checkValidate('act_start_date')"
                        ></span>
                        <span class="help-block" ng-show="checkValidate('act_start_date')">
                            กรุณาเลือกวันที่
                        </span>
                    </div>
                </div>
                <!-- left column -->
            
                <!-- right column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('act_start_time')}">
                        <label class="control-label" for="to_date">
                            เวลาเริ่ม <span style="color: red;">*</span>
                        </label>
                        <input
                            type="text"
                            id="act_start_time"
                            name="act_start_time"
                            ng-model="newAct.actStartTime"
                            class="form-control"
                        />
                        <span
                            class="glyphicon glyphicon-remove form-control-feedback"
                            ng-show="checkValidate('act_start_time')"
                        ></span>
                        <span class="help-block" ng-show="checkValidate('act_start_time')">
                            กรุณากรอกเวลาเริ่ม
                        </span>
                    </div>
                </div><!-- right column -->
            </div><!-- end row -->

            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('act_renewal_date')}">
                        <label class="control-label" for="to_date">
                            วันที่สิ้นสุด <span style="color: red;">*</span>
                        </label>
                        <input
                            type="text"
                            id="act_renewal_date"
                            name="act_renewal_date"
                            ng-model="newAct.actRenewalDate"
                            class="form-control"
                        />
                        <span
                            class="glyphicon glyphicon-remove form-control-feedback"
                            ng-show="checkValidate('act_renewal_date')"
                        ></span>
                        <span class="help-block" ng-show="checkValidate('act_renewal_date')">
                            กรุณาเลือกวันที่สิ้นสุด
                        </span>
                    </div>
                </div>
                <!-- left column -->
            
                <!-- right column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('act_renewal_time')}">
                        <label class="control-label" for="from_date">
                            เวลาสิ้นสุด <span style="color: red;">*</span>
                        </label>
                        <input
                            type="text"
                            id="act_renewal_time"
                            name="act_renewal_time"
                            ng-model="newAct.actRenewalTime"
                            class="form-control"
                        />
                        <span
                            class="glyphicon glyphicon-remove form-control-feedback"
                            ng-show="checkValidate('act_renewal_time')"
                        ></span>
                        <span class="help-block" ng-show="checkValidate('act_renewal_time')">
                            กรุณากรอกเวลาสิ้นสุด
                        </span>
                    </div>
                </div>
                <!-- right column -->
            </div><!-- end row -->

            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('act_net')}">
                        <label class="control-label" for="from_date">
                            เบี้ยประกันสุทธิ <span style="color: red;">*</span>
                        </label>
                        <input
                            type="text"
                            id="act_net"
                            name="act_net"
                            ng-model="newAct.actNet"
                            ng-keypress="calculateTotal($event)"
                            class="form-control"
                        />
                        <span
                            class="glyphicon glyphicon-remove form-control-feedback"
                            ng-show="checkValidate('act_net')"
                        ></span>
                        <span class="help-block" ng-show="checkValidate('act_net')">
                            กรุณากรอกเบี้ยประกันสุทธิ หรือ ระบุเบี้ยประกันสุทธิเป็นตัวเลข
                        </span>
                    </div>
                </div>
                <!-- left column -->
            
                <!-- right column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('act_stamp')}">
                        <label class="control-label" for="to_date">
                            อากร <span style="color: red;">*</span>
                        </label>
                        <input
                            type="text"
                            id="act_stamp"
                            name="act_stamp"
                            ng-model="newAct.actStamp"
                            ng-keypress="calculateTotal($event)"
                            class="form-control"
                        />
                        <span
                            class="glyphicon glyphicon-remove form-control-feedback"
                            ng-show="checkValidate('act_stamp')"
                        ></span>
                        <span class="help-block" ng-show="checkValidate('act_stamp')">
                            กรุณากรอกอากร หรือ ระบุอากรเป็นตัวเลข
                        </span>
                    </div>
                </div><!-- right column -->
            </div><!-- end row -->

            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('act_vat')}">
                        <label class="control-label" for="from_date">
                            ภาษีมูลค่าเพิ่ม/VAT <span style="color: red;">*</span>
                        </label>
                        <input
                            type="text"
                            id="act_vat"
                            name="act_vat"
                            ng-model="newAct.actVat"
                            ng-keypress="calculateTotal($event)"
                            class="form-control"
                        />
                        <span
                            class="glyphicon glyphicon-remove form-control-feedback"
                            ng-show="checkValidate('act_vat')"
                        ></span>
                        <span class="help-block" ng-show="checkValidate('act_vat')">
                            กรุณากรอกภาษีมูลค่าเพิ่มก่อน หรือ ระบุภาษีมูลค่าเพิ่มเป็นตัวเลข
                        </span>
                    </div>
                </div>
                <!-- left column -->
            
                <!-- right column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('act_total')}">
                        <label class="control-label" for="to_date">
                            รวม/Total <span style="color: red;">*</span>
                        </label>
                        <input
                            type="text"
                            id="act_total"
                            name="act_total"
                            ng-model="newAct.actTotal"
                            class="form-control"
                        />
                        <span
                            class="glyphicon glyphicon-remove form-control-feedback"
                            ng-show="checkValidate('act_total')"
                        ></span>
                        <span class="help-block" ng-show="checkValidate('act_total')">
                            กรุณากรอกยอดรวมก่อน หรือ ระบุยอดรวมเป็นตัวเลข
                        </span>
                    </div>
                </div><!-- right column -->
            </div><!-- end row -->

            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label" for="remark">
                            หมายเหตุ
                        </label>
                        <textarea
                            id="remark"
                            name="remark"
                            ng-model="newAct.remark"
                            cols="30"
                            rows="5"
                            class="form-control"
                        ></textarea>
                    </div>
                </div>
                <!-- left column -->
            </div><!-- end row -->

            <div class="row">
                <!-- left column -->
                <div class="col-md-12">

                    <div class="form-group">
                        <label class="control-label" for="attachfile">แนบไฟล์</label>
                        <input
                            type="file"
                            id="attachfile"
                            name="attachfile"
                            class="form-control"
                        />
                    </div>

                </div>
                <!-- left column -->
            </div>

            <div class="row">
                <div class="col-md-12">
                    <br><button class="btn btn-primary pull-right" ng-click="formValidate($event, 'frmNewAct')">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก
                    </button>
                </div>
            </div>

            <input type="hidden" id="user" name="user" value="{{ Auth::user()->person_id }}">
            <input type="hidden" id="vehicle_id" name="vehicle_id" ng-model="newAct.vehicleId">
            {{ csrf_field() }}
        </form>

        <!-- Modal -->
        <div class="modal fade" id="dlgAllVehicle" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="">กรุณาเลือกรถ</h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 4%; text-align: center;">#</th>
                                        <th style="width: 15%; text-align: center;">ทะเบียน</th>
                                        <th>รายละเอียดรถ</th>
                                        <th style="width: 30%; text-align: center;">ผู้รับผิดชอบ</th>
                                        <th style="width: 5%; text-align: center;">เลือก</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="(index, vehicle) in frmAllVehicles.data">
                                        <td>@{{ index + 1 }}</td>
                                        <td>@{{ vehicle.reg_no }} @{{ vehicle.changwat.short }}</td>
                                        <td>
                                            @{{ vehicle.cate.vehicle_cate_name }}
                                            @{{ vehicle.manufacturer.manufacturer_name }}
                                            @{{ vehicle.model }}
                                            @{{ (vehicle.remark) ? '(' + vehicle.remark + ')' : '' }}
                                        </td>
                                        <td>@{{   }}</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" ng-click="frmSetVehicle(vehicle)">
                                                <i class="fa fa-sign-in" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> 

                        <ul class="pagination" style="margin: 0 auto;">
                            <li ng-class="{ 'disabled': (frmAllVehicles.current_page === 1) }">
                                <a ng-click="paginate($event, frmAllVehicles.path)" aria-label="First">
                                    <span aria-hidden="true">First</span>
                                </a>
                            </li>

                            <li ng-class="{ 'disabled': (frmAllVehicles.current_page === 1) }">
                                <a  ng-click="paginate($event, frmAllVehicles.prev_page_url)" 
                                    aria-label="Prev">
                                    <span aria-hidden="true">Prev</span>
                                </a>
                            </li>                         

                            <li ng-repeat="i in _.range(1, frmAllVehicles.last_page + 1)"
                                ng-class="{ 'active': (frmAllVehicles.current_page === i) }">
                                <a ng-click="paginate($event, frmAllVehicles.path + '?page=' + i)">
                                    {{ i }}
                                </a>
                            </li>
                            
                            <li ng-class="{ 'disabled': (frmAllVehicles.current_page === frmAllVehicles.last_page) }">
                                <a ng-click="paginate($event, frmAllVehicles.next_page_url)" aria-label="Next">
                                    <span aria-hidden="true">Next</span>
                                </a>
                            </li>

                            <li ng-class="{ 'disabled': (frmAllVehicles.current_page === frmAllVehicles.last_page) }">
                                <a ng-click="paginate($event, frmAllVehicles.path + '?page=' + frmAllVehicles.last_page)" aria-label="Last">
                                    <span aria-hidden="true">Last</span>
                                </a>
                            </li>
                        </ul> 

                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        
        <script>
            $(document).ready(function($) {
                var dateNow = new Date();

                $('#doc_date').datetimepicker({
                    useCurrent: true,
                    format: 'YYYY-MM-DD',
                    defaultDate: moment(dateNow)
                });

                $('#act_start_date').datetimepicker({
                    useCurrent: true,
                    format: 'YYYY-MM-DD',
                    defaultDate: moment(dateNow)
                })
                .on("dp.change", function(e) {
                    let new_date = moment(e.date, "DD-MM-YYYY").add(1, 'years');
                    console.log(new_date);
                    $('#act_renewal_date').data('DateTimePicker').date(new_date);
                }); 

                $('#act_renewal_date').datetimepicker({
                    useCurrent: true,
                    format: 'YYYY-MM-DD',
                    defaultDate: moment(dateNow)
                });

                $('#act_start_time').datetimepicker({
                    useCurrent: true,
                    format: 'HH:mm',
                    locale: 'th',
                    defaultDate: moment().minutes(0)
                });
                // .on("dp.change", function(e) {
                //     let new_date = moment(e.date, "DD-MM-YYYY").add(1, 'years');
                //     console.log(new_date);
                //     $('#act_renewal_date').data('DateTimePicker').date(new_date);
                // });

                $('#act_renewal_time').datetimepicker({
                    useCurrent: true,
                    format: 'HH:mm',
                    locale: 'th',
                    defaultDate: moment().minutes(0)
                });
            });
        </script>

    </div><!-- /.container -->
    @endsection
