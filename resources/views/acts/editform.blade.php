    @extends('layouts.main')

    @section('content')
    <div class="container-fluid" ng-controller="actCtrl" ng-init="edit({{ $act }})">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">หน้าหลัก</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/acts/list') }}">รายการต่อ พรบ.</a></li>
            <li class="breadcrumb-item active">แก้ไขการต่อ พรบ.</li>
            <li class="breadcrumb-item active">{{ $act->id }}</li>
        </ol>

        <!-- page title -->
        <div class="page__title-wrapper">
            <div class="page__title">
                <span>
                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i> 
                    แก้ไขการต่อ พรบ.
                    <span class="text-muted">
                        (รหัสรายการ {{ $act->id }} / ทะเบียน {{ $act->vehicle->reg_no }})
                    </span>
                </span>
            </div>

            <hr />
        </div>
        <!-- page title -->
        
        <form
            id="frmEditAct"
            action="{{ url('/acts/' .$act->id. '/update') }}"
            method="post"
            enctype="multipart/form-data"
        >
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('docNo')}">
                        <label for="doc_no">เลขที่หนังสือขออนุมัติ <span style="color: red;">*</span></label>
                        <input type="text" id="doc_no" name="doc_no" ng-model="newAct.docNo" class="form-control">
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
                        <label for="act_date">วันที่หนังสือขออนุมัติ <span style="color: red;">*</span></label>
                        <input type="text" id="doc_date" name="doc_date" ng-model="newAct.docDate" class="form-control">
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
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('act_no')}">
                        <label for="act_no">
                            เลขที่กรมธรรม์ <span style="color: red;">*</span>
                        </label>
                        <input type="text" id="act_no" name="act_no" ng-model="newAct.actNo" class="form-control">
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
            
            <div class="page__title" style="margin: 20px auto 10px;">
                <span>
                    <i class="fa fa-sticky-note-o" aria-hidden="true"></i> ระยะเวลาประกัน
                </span>
            </div>

            <div class="row">
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
                </div>

                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('act_renewal_date')}">
                        <label class="control-label" for="to_date">
                            ถึงวันที่ <span style="color: red;">*</span>
                        </label>
                        <input
                            type="text"
                            id="act_renewal_date"
                            name="act_renewal_date"
                            class="form-control"
                            ng-model="newAct.actRenewalDate"
                        />
                        <span
                            class="glyphicon glyphicon-remove form-control-feedback"
                            ng-show="checkValidate('act_renewal_date')"
                        ></span>
                        <span class="help-block" ng-show="checkValidate('act_renewal_date')">
                            กรุณาเลือกวันที่
                        </span>
                    </div>
                </div>

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
            </div><!-- end row -->

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('actNet')}">
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
                            ng-show="checkValidate('actNet')"
                        ></span>
                        <span class="help-block" ng-show="checkValidate('actNet')">
                            กรุณาเลือกวันที่
                        </span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('actStamp')}">
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
                            ng-show="checkValidate('actStamp')"
                        ></span>
                        <span class="help-block" ng-show="checkValidate('actStamp')">
                            กรุณากรอกอากร
                        </span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('actVat')}">
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
                            ng-show="checkValidate('actVat')"
                        ></span>
                        <span class="help-block" ng-show="checkValidate('actVat')">
                            กรุณากรอกภาษีมูลค่าเพิ่มเบี้ยประกัน
                        </span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('actTotal')}">
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
                        <span class="glyphicon glyphicon-remove form-control-feedback" ng-show="checkValidate('actTotal')"></span>
                        <span class="help-block" ng-show="checkValidate('actTotal')">
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
                            ng-model="newAct.remark"
                            cols="30"
                            rows="5"
                            class="form-control"
                        ></textarea>
                    </div>
                </div>

                <div
                    ng-class="{
                        'col-md-12': '{{ $act->attachfile }}' === '',
                        'col-md-6': '{{ $act->attachfile }}' !== ''
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
                        src="{{ url('/uploads/acts/' .$act->attachfile) }}"
                        style="width: 200px; height: 200px;"
                        alt=""
                        ng-show="'{{ $act->attachfile }}' !== ''"
                    />
                </div>

                <div class="col-md-12">
                    <button class="btn btn-warning pull-right" ng-click="formValidate($event, 'frmEditAct')">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> แก้ไข
                    </button>
                </div>
            </div>

            <input type="hidden" id="vehicle_id" name="vehicle_id" value="{{ $act->vehicle_id }}">
            <input type="hidden" id="user" name="user" value="{{ Auth::user()->person_id }}">
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
                    defaultDate: moment(dateNow).hours(8).minutes(0).seconds(0).milliseconds(0) 
                });

                $('#act_renewal_time').datetimepicker({
                    useCurrent: true,
                    format: 'HH:mm',
                    defaultDate: moment(dateNow).hours(8).minutes(0).seconds(0).milliseconds(0) 
                });
            });
        </script>

    </div><!-- /.container -->
    @endsection
