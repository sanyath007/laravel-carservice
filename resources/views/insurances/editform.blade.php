    @extends('layouts.main')

    @section('content')
    <div class="container-fluid" ng-controller="insuranceCtrl" ng-init="edit({{ $insurance }})">
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
        
        <form
            id="frmEditInsurance"
            action="{{ url('/insurances/' .$insurance->id. '/update') }}"
            method="post"
            enctype="multipart/form-data"
        >
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
                            ng-model="newInsurance.docNo"
                            class="form-control"
                        />
                        <!-- <span
                            class="glyphicon glyphicon-remove form-control-feedback"
                            ng-show="checkValidate('doc_no')"
                        ></span> -->
                        <span class="help-block" ng-show="checkValidate('doc_no')">
                            กรุณาระบุเลขที่หนังสือขออนุมัติ
                        </span>
                    </div>
                </div>
                <!-- left column -->
        
                <!-- right column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('doc_date')}">
                        <label for="doc_date">
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
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('insurance_no')}">
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
                            ng-show="checkValidate('insurance_no')"
                        ></span> -->
                        <span class="help-block" ng-show="checkValidate('insurance_no')">
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
                        <select
                            id="company"
                            name="company" 
                            ng-model="newInsurance.company"
                            class="form-control"
                        >
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
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('insurance_type')}">
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
                            ng-show="checkValidate('insurance_type')"
                        ></span> -->
                        <span class="help-block" ng-show="checkValidate('insurance_type')">
                            กรุณาเลือกประเภทประกันภัย
                        </span>                        
                    </div>
                </div>
                <!-- left column -->
            </div><!-- end row -->

            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('insurance_detail')}">
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
                            ng-show="checkValidate('insurance_detail')"
                        ></span>
                        <span class="help-block" ng-show="checkValidate('insurance_detail')">
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
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('insurance_start_date')}">
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
                            ng-show="checkValidate('insurance_start_date')"
                        ></span>
                        <span class="help-block" ng-show="checkValidate('insurance_start_date')">
                            กรุณาเลือกวันที่
                        </span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('insurance_start_time')}">
                        <label class="control-label" for="to_date">
                            เวลาเริ่ม <span style="color: red;">*</span>
                        </label>
                        <input
                            type="text"
                            id="insurance_start_time"
                            name="insurance_start_time"
                            ng-model="newInsurance.insuranceStartTime"
                            class="form-control"
                        />
                        <span
                            class="glyphicon glyphicon-remove form-control-feedback"
                            ng-show="checkValidate('insurance_start_time')"
                        ></span>
                        <span class="help-block" ng-show="checkValidate('insurance_start_time')">
                            กรุณากรอกเวลาเริ่ม
                        </span>
                    </div>
                </div>
            
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('insurance_renewal_date')}">
                        <label class="control-label" for="to_date">
                            วันที่สิ้นสุด <span style="color: red;">*</span>
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
                            ng-show="checkValidate('insurance_renewal_date')"
                        ></span>
                        <span class="help-block" ng-show="checkValidate('insurance_renewal_date')">
                            กรุณาเลือกวันที่
                        </span>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('insurance_renewal_time')}">
                        <label class="control-label" for="from_date">
                            เวลาสิ้นสุด <span style="color: red;">*</span>
                        </label>
                        <input
                            type="text"
                            id="insurance_renewal_time"
                            name="insurance_renewal_time"
                            ng-model="newInsurance.insuranceRenewalTime"
                            class="form-control"
                        />
                        <span
                            class="glyphicon glyphicon-remove form-control-feedback"
                            ng-show="checkValidate('insurance_renewal_time')"
                        ></span>
                        <span class="help-block" ng-show="checkValidate('insurance_renewal_time')">
                            กรุณากรอกเวลาสิ้นสุด
                        </span>
                    </div>
                </div>
            </div><!-- end row -->

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('insurance_net')}">
                        <label class="control-label" for="from_date">
                            เบี้ยประกันสุทธิ <span style="color: red;">*</span>
                        </label>
                        <input
                            type="text"
                            id="insurance_net"
                            name="insurance_net"
                            ng-model="newInsurance.insuranceNet"
                            ng-keyup="calculateTotal($event)"
                            class="form-control"
                        />
                        <span
                            class="glyphicon glyphicon-remove form-control-feedback"
                            ng-show="checkValidate('insurance_net')"
                        ></span>
                        <span class="help-block" ng-show="checkValidate('insurance_net')">
                            กรุณาเลือกวันที่
                        </span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('insurance_stamp')}">
                        <label class="control-label" for="to_date">
                            อากร <span style="color: red;">*</span>
                        </label>
                        <input
                            type="text"
                            id="insurance_stamp"
                            name="insurance_stamp"
                            ng-model="newInsurance.insuranceStamp"
                            ng-keyup="calculateTotal($event)"
                            class="form-control"
                        />
                        <span
                            class="glyphicon glyphicon-remove form-control-feedback"
                            ng-show="checkValidate('insurance_stamp')"
                        ></span>
                        <span class="help-block" ng-show="checkValidate('insurance_stamp')">
                            กรุณากรอกอากร
                        </span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('insurance_vat')}">
                        <label class="control-label" for="from_date">
                            ภาษีมูลค่าเพิ่ม/VAT <span style="color: red;">*</span>
                        </label>
                        <input
                            type="text"
                            id="insurance_vat"
                            name="insurance_vat"
                            ng-model="newInsurance.insuranceVat"
                            ng-keyup="calculateTotal($event)"
                            class="form-control"
                        />
                        <span
                            class="glyphicon glyphicon-remove form-control-feedback"
                            ng-show="checkValidate('insurance_vat')"
                        ></span>
                        <span class="help-block" ng-show="checkValidate('insurance_vat')">
                            กรุณากรอกภาษีมูลค่าเพิ่มเบี้ยประกัน
                        </span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('insurance_total')}">
                        <label class="control-label" for="to_date">
                            รวม/Total <span style="color: red;">*</span>
                        </label>
                        <input
                            type="text"
                            id="insurance_total"
                            name="insurance_total"
                            ng-model="newInsurance.insuranceTotal"
                            class="form-control"
                        />
                        <span
                            class="glyphicon glyphicon-remove form-control-feedback"
                            ng-show="checkValidate('insurance_total')"
                        ></span>
                        <span class="help-block" ng-show="checkValidate('insurance_total')">
                            กรุณากรอกยอดรวม
                        </span>
                    </div>
                </div>
            </div><!-- end row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('startpoint')}">
                        <label class="control-label" for="remark">
                            หมายเหตุ
                        </label>
                        <textarea
                            id="remark"
                            name="remark"
                            ng-model="newInsurance.remark"
                            cols="30"
                            rows="5"
                            class="form-control"
                        ></textarea>
                    </div>
                </div>

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
                    <button
                        class="btn btn-warning pull-right"
                        ng-click="formValidate($event, 'frmEditInsurance')"
                    >
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> แก้ไข
                    </button>
                </div>
            </div><!-- end row -->

            <input type="hidden" id="user" name="user" value="{{ Auth::user()->person_id }}">
            <input type="hidden" id="vehicle_id" name="vehicle_id" value="{{ $insurance->vehicle_id }}">
            {{ csrf_field() }}
        </form>
        
        <script>
            $(document).ready(function($) {
                var dateNow = new Date();
                
                $('#doc_date').datetimepicker({
                    useCurrent: true,
                    format: 'YYYY-MM-DD',
                    defaultDate: moment(dateNow)
                });

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

                $('#insurance_start_time').datetimepicker({
                    useCurrent: true,
                    format: 'HH:mm',
                    defaultDate: moment(dateNow).hours(8).minutes(0).seconds(0).milliseconds(0) 
                });
                
                $('#insurance_renewal_time').datetimepicker({
                    useCurrent: true,
                    format: 'HH:mm',
                    defaultDate: moment(dateNow).hours(8).minutes(0).seconds(0).milliseconds(0) 
                });
            });
        </script>

    </div><!-- /.container -->
    @endsection
