    @extends('layouts.main')

    @section('content')
    <div class="container-fluid" ng-controller="insuranceCtrl">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">หน้าหลัก</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/insurances/list') }}">รายการต่อประกันภัย</a></li>
            <li class="breadcrumb-item active">แก้ไขการต่อประกันภัย</li>
            <li class="breadcrumb-item active">{{ $insurance->id }}</li>
        </ol>

        <!-- page title -->
        <div class="page__title-wrapper">
            <div class="page__title">
                <span>
                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i> 
                    แก้ไขการต่อประกันภัย
                    <span class="text-muted">
                        (รหัสรายการ {{ $insurance->id }} / ทะเบียน {{ $insurance->vehicle->reg_no }})
                    </span>
                </span>
            </div>

            <hr />
        </div><!-- page title -->
        
        <form id="frmEditInsurance" action="{{ url('/insurance/update') }}" method="post" enctype="multipart/form-data">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('docNo')}">
                        <label for="doc_no">
                            เลขที่หนังสือขออนุมัติ <span style="color: red;">*</span>
                        </label>
                        <input
                            type="text"
                            id="doc_no"
                            name="doc_no"
                            ng-model="newInsurance.docNo"
                            class="form-control"
                        />
                        <!-- <span
                            class="glyphicon glyphicon-remove form-control-feedback"
                            ng-show="checkValidate('docNo')"
                        ></span> -->
                        <span class="help-block" ng-show="checkValidate('docNo')">
                            กรุณาระบุเลขที่หนังสือขออนุมัติ
                        </span>
                    </div>
                </div>
                <!-- left column -->
        
                <!-- right column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('docDate')}">
                        <label for="insurance_date">
                            วันที่หนังสือขออนุมัติ <span style="color: red;">*</span>
                        </label>
                        <input
                            type="text"
                            id="doc_date"
                            name="doc_date"
                            ng-model="newInsurance.docDate"
                            class="form-control"
                        />
                        <span
                            class="glyphicon glyphicon-remove form-control-feedback"
                            ng-show="checkValidate('docDate')"
                        ></span>
                        <span class="help-block" ng-show="checkValidate('docDate')">
                            กรุณาเลือกวันที่หนังสือขออนุมัติ
                        </span>
                    </div>
                </div>
                <!-- right column -->
            </div><!-- end row -->

            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('insuranceNo')}">
                        <label for="insurance_no">
                            เลขที่กรมธรรม์ <span style="color: red;">*</span>
                        </label>
                        <input
                            type="text"
                            id="insurance_no"
                            name="insurance_no"
                            ng-model="newInsurance.insuranceNo"
                            class="form-control"
                        />
                        <!-- <span
                            class="glyphicon glyphicon-remove form-control-feedback"
                            ng-show="checkValidate('insuranceNo')"
                        ></span> -->
                        <span class="help-block" ng-show="checkValidate('insuranceNo')">
                            กรุณาระบุเลขที่กรมธรรม์
                        </span>
                    </div>
                </div>
                <!-- left column -->
        
                <!-- right column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('company')}">
                        <label class="control-label" for="company">
                            บริษัทประกันภัย <span style="color: red;">*</span>
                        </label>
                        <select id="company" name="company" ng-model="newInsurance.company" class="form-control">
                            <option value="">-- กรุณาเลือกบริษัทประกันภัย --</option>
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
                            กรุณาเลือกบริษัทประกันภัย
                        </span>                        
                    </div>
                </div>
                <!-- right column -->
            </div><!-- end row -->

            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('insuranceType')}">
                        <label class="control-label" for="insurance_type">
                            ประเภทประกันภัย <span style="color: red;">*</span>
                        </label>
                        <select
                            id="insurance_type"
                            name="insurance_type"
                            ng-model="newInsurance.insuranceType"
                            class="form-control"
                        >
                            <option value="">-- กรุณาเลือกประเภทกิจกรรม --</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->insurance_type_id }}">
                                    {{ $type->insurance_type_name }}
                                </option>
                            @endforeach
                        </select>                        
                        <!-- <span
                            class="glyphicon glyphicon-remove form-control-feedback"
                            ng-show="checkValidate('insuranceType')"
                        ></span> -->
                        <span class="help-block" ng-show="checkValidate('insuranceType')">
                            กรุณาเลือกประเภทประกันภัย
                        </span>                        
                    </div>
                </div>
                <!-- left column -->
            </div><!-- end row -->

            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('insuranceDetail')}">
                        <label class="control-label" for="insurance_detail">
                            รายละเอียด <span style="color: red;">*</span>
                        </label>
                        <textarea
                            id="insurance_detail"
                            name="insurance_detail"
                            ng-model="newInsurance.insuranceDetail"
                            cols="30"
                            rows="5"
                            class="form-control"
                        ></textarea>
                        <span
                            class="glyphicon glyphicon-remove form-control-feedback"
                            ng-show="checkValidate('insuranceDetail')"
                        ></span>
                        <span class="help-block" ng-show="checkValidate('insuranceDetail')">
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
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('insuranceStartDate')}">
                        <label class="control-label" for="from_date">
                            เริ่มต้นวันที่ <span style="color: red;">*</span>
                        </label>
                        <input
                            type="text"
                            id="insurance_start_date"
                            name="insurance_start_date"
                            ng-model="newInsurance.insuranceStartDate"
                            class="form-control"
                        />
                        <span
                            class="glyphicon glyphicon-remove form-control-feedback"
                            ng-show="checkValidate('insuranceStartDate')"
                        ></span>
                        <span class="help-block" ng-show="checkValidate('insuranceStartDate')">
                            กรุณาเลือกวันที่
                        </span>
                    </div>
                </div>
                <!-- left column -->
            
                <!-- right column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('insuranceRenewalDate')}">
                        <label class="control-label" for="to_date">
                            ถึงวันที่ <span style="color: red;">*</span>
                        </label>
                        <input
                            type="text"
                            id="insurance_renewal_date"
                            name="insurance_renewal_date"
                            class="form-control"
                            ng-model="newInsurance.insuranceRenewalDate"
                        />
                        <span
                            class="glyphicon glyphicon-remove form-control-feedback"
                            ng-show="checkValidate('insuranceRenewalDate')"
                        ></span>
                        <span class="help-block" ng-show="checkValidate('insuranceRenewalDate')">
                            กรุณาเลือกวันที่
                        </span>
                    </div>
                </div><!-- right column -->
            </div><!-- end row -->

            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('startpoint')}">
                        <label class="control-label" for="remark">
                            หมายเหตุ
                        </label>
                        <textarea
                            id="remark"
                            name="remark"
                            cols="30"
                            rows="5"
                            class="form-control"
                        ></textarea>
                    </div>
                </div>
                <!-- left column -->
            </div><!-- end row -->

            <div class="row">
                <div
                    ng-class="{
                        'col-md-12': '{{ $insurance->attachfile }}' === '',
                        'col-md-6': '{{ $insurance->attachfile }}' !== ''
                    }"
                >
                    <div class="form-group">
                        <label class="control-label" for="attachfile">แนบไฟล์</label>
                        <input
                            type="file"
                            id="attachfile"
                            name="attachfile"
                            class="form-control"
                            placeholder="สถานที่&hellip;"
                            ng-keyup="queryLocation($event)"
                            ng-keypress="enterToAddLocation($event)"
                            autocomplete="off"
                        />
                    </div>
                </div>

                <div class="col-md-6">
                    <img
                        src="{{ url('/uploads/insurances/' .$insurance->attachfile) }}"
                        style="width: 200px; height: 200px;"
                        alt=""
                        ng-show="'{{ $insurance->attachfile }}' !== ''"
                    />
                </div>

                <div class="col-md-12">
                    <br><button class="btn btn-warning pull-right" ng-click="formValidate($event)">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> แก้ไข
                    </button>
                </div>
            </div>

            <input type="hidden" id="user" name="user" value="{{ Auth::user()->person_id }}">
            <input type="hidden" id="vehicle_id" name="vehicle_id">
            {{ csrf_field() }}
        </form>

        <!-- Modal -->
        <div class="modal fade" id="dlgAllVehicle" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
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
                                            <a class="btn btn-primary" ng-click="frmSetVehicle(vehicle)">
                                                <i class="fa fa-sign-in" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> 

                        <ul class="pagination">
                            <li>
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

                            <li>
                                <a ng-click="paginate($event, frmAllVehicles.path + '?page=' + frmAllVehicles.last_page)" aria-label="Last">
                                    <span aria-hidden="true">Last</span>
                                </a>
                            </li>
                        </ul> 

                    </div>
                    <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Close
                        </button>
                    </div> -->
                </div>
            </div>
        </div>
        <!-- Modal -->
        
        <script>
            $(document).ready(function($) {
                var dateNow = new Date();

                $('#insurance_start_date').datetimepicker({
                    useCurrent: true,
                    format: 'YYYY-MM-DD',
                    defaultDate: moment(dateNow)
                })
                .on("dp.change", function(e) {
                    let new_date = moment(e.date, "DD-MM-YYYY").add(1, 'years');
                    console.log(new_date);
                    $('#insurance_renewal_date').data('DateTimePicker').date(new_date);
                }); 

                $('#insurance_renewal_date').datetimepicker({
                    useCurrent: true,
                    format: 'YYYY-MM-DD',
                    defaultDate: moment(dateNow)
                });

                $('#doc_date').datetimepicker({
                    useCurrent: true,
                    format: 'YYYY-MM-DD',
                    defaultDate: moment(dateNow)
                });
            });
        </script>

    </div><!-- /.container -->
    @endsection
