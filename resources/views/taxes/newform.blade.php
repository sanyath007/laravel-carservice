    @extends('layouts.main')

    @section('content')
    <div class="container-fluid" ng-controller="taxCtrl" ng-init="popUpAllVehicle()">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">หน้าหลัก</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/taxes/list') }}">รายการเสียภาษี</a></li>
            <li class="breadcrumb-item active">บันทึกการเสียภาษี</li>
        </ol>

        <!-- page title -->
        <div class="page__title-wrapper">
            <div class="page__title">
                <span>
                    <i class="fa fa-calendar-plus-o" aria-hidden="true"></i> 
                    บันทึกการเสียภาษี
                    <span class="text-muted">
                        (@{{ frmVehicleDetail }})
                    </span>

                    <a class="btn btn-warning" ng-show="frmVehicleDetail" ng-click="popUpAllVehicle()">
                        <i class="fa fa-car" aria-hidden="true"></i>
                        เปลี่ยนรถ
                    </a>
                </span>
            </div>
            
            <hr />
        </div>
        <!-- page title -->
        
        <form id="frmNewTax" action="{{ url('/taxes/add') }}" method="post" enctype="multipart/form-data">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('doc_no')}">
                        <label for="doc_no">เลขที่หนังสือขออนุมัติ <span style="color: red;">*</span></label>
                        <input type="text" id="doc_no" name="doc_no" ng-model="newTax.docNo" class="form-control">
                        <span class="glyphicon glyphicon-remove form-control-feedback" ng-show="checkValidate('doc_no')"></span>
                        <span class="help-block" ng-show="checkValidate('doc_no')">กรุณาระบุเลขที่หนังสือขออนุมัติ</span>
                    </div>
                </div>
                <!-- left column -->
        
                <!-- right column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('docDate')}">
                        <label for="doc_date">วันที่หนังสือขออนุมัติ <span style="color: red;">*</span></label>
                        <input type="text" id="doc_date" name="doc_date" ng-model="newTax.docDate" class="form-control">
                        <span class="glyphicon glyphicon-remove form-control-feedback" ng-show="checkValidate('docDate')"></span>
                        <span class="help-block" ng-show="checkValidate('docDate')">กรุณาเลือกวันที่หนังสือขออนุมัติ</span>
                    </div>
                </div>
                <!-- right column -->
            </div><!-- end row -->

            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('taxStartDate')}">
                        <label class="control-label" for="tax_start_date">วันที่เสียภาษี <span style="color: red;">*</span></label>
                        <input type="text" id="tax_start_date" name="tax_start_date" class="form-control" ng-model="newTax.taxStartDate">
                        <span class="glyphicon glyphicon-remove form-control-feedback" ng-show="checkValidate('taxStartDate')"></span>
                        <span class="help-block" ng-show="checkValidate('taxStartDate')">กรุณาเลือกวันที่</span>
                    </div>
                </div>
                <!-- left column -->
            
                <!-- right column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('taxRenewalDate')}">
                        <label class="control-label" for="tax_renewal_date">วันที่ครบกำหนด <span style="color: red;">*</span></label>
                        <input type="text" id="tax_renewal_date" name="tax_renewal_date" ng-model="newTax.taxRenewalDate" class="form-control">
                        <span class="glyphicon glyphicon-remove form-control-feedback" ng-show="checkValidate('taxRenewalDate')"></span>
                        <span class="help-block" ng-show="checkValidate('taxRenewalDate')">กรุณาเลือกวันที่</span>
                    </div>
                </div><!-- right column -->
            </div><!-- end row -->

            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('tax_receipt_no')}">
                        <label for="tax_receipt_no">เลขที่ใบเสร็จ <span style="color: red;">*</span></label>
                        <input type="text" id="tax_receipt_no" name="tax_receipt_no" ng-model="newTax.taxReceiptNo" class="form-control">
                        <span class="glyphicon glyphicon-remove form-control-feedback" ng-show="checkValidate('tax_receipt_no')"></span>
                        <span class="help-block" ng-show="checkValidate('tax_receipt_no')">กรุณาระบุเลขที่ใบเสร็จ</span>
                    </div>
                </div>
                <!-- left column -->
        
                <!-- right column -->
                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('tax_charge')}">
                        <label for="tax_charge">
                            ค่าภาษี <span style="color: red;">*</span>
                        </label>
                        <input
                            type="text"
                            id="tax_charge"
                            name="tax_charge"
                            ng-model="newTax.taxCharge"
                            class="form-control"
                        >
                        <span
                            class="glyphicon glyphicon-remove form-control-feedback"
                            ng-show="checkValidate('tax_charge')"
                        ></span>
                        <span class="help-block" ng-show="checkValidate('tax_charge')">กรุณาระบุค่าภาษี หรือ ต้องระบุค่าภาษีเป็นตัวเลข</span>
                    </div>
                </div>
                <!-- right column -->
            </div><!-- end row -->

            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label" for="remark">หมายเหตุ</label>
                        <textarea id="remark" name="remark" ng-model="newTax.remark" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <!-- left column -->
            </div><!-- end row -->

            <div class="row">
                <!-- left column -->
                <div class="col-md-12">

                    <div class="form-group">
                        <label class="control-label" for="attachfile">แนบไฟล์</label>
                        <input type="file" id="attachfile" name="attachfile" class="form-control" placeholder="สถานที่&hellip;" ng-keyup="queryLocation($event)" autocomplete="off" ng-keypress="enterToAddLocation($event)">
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
            <input type="hidden" id="vehicle_id" name="vehicle_id">
            {{ csrf_field() }}
        </form>

        <!-- Modal -->
        @include('vehicles.modal-selection')
        
        <script>
            $(document).ready(function($) {
                var dateNow = new Date();

                $('#doc_date').datetimepicker({
                    useCurrent: true,
                    format: 'YYYY-MM-DD',
                    defaultDate: moment(dateNow)
                });

                $('#tax_start_date').datetimepicker({
                    useCurrent: true,
                    format: 'YYYY-MM-DD',
                    defaultDate: moment(dateNow)
                })
                .on("dp.change", function(e) {
                    let new_date = moment(e.date, "DD-MM-YYYY").add(1, 'years');
                    console.log(new_date);
                    $('#tax_renewal_date').data('DateTimePicker').date(new_date);
                }); 

                $('#tax_renewal_date').datetimepicker({
                    useCurrent: true,
                    format: 'YYYY-MM-DD',
                    defaultDate: moment(dateNow)
                });
            });
        </script>

    </div><!-- /.container -->
    @endsection
