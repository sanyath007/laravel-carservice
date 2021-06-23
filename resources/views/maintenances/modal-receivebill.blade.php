<div class="modal fade" id="dlgReceiveBillForm" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="">ฟอร์มส่งเอกสาร (ใบส่งของ/ใบกำกับภาษี/ใบเสร็จ ซ่อมบำรุงรถยนต์)</h4>
            </div>
            <div class="modal-body">

                <input type="hidden" id="_id" name="_id" />
                <input type="hidden" id="vatnet" name="vatnet">

                <div class="row">                
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="doc_date">
                                วันที่ขออนุมัติ 
                                <span style="font-weight: 200; font-style: italic;">
                                    (กรุณาแก้ไขหากมีการเปลี่ยนแปลง)
                                </span>
                            </label>
                            <input
                                type="text"
                                id="doc_date"
                                name="doc_date"
                                ng-model="maintenanceSelected.doc_date"
                                class="form-control"
                            />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="doc_no">
                                เลขที่เอกสาร
                                <span style="font-weight: 200; font-style: italic;">
                                    (กรุณาแก้ไขหากมีการเปลี่ยนแปลง)
                                </span>
                            </label>
                            <input
                                type="text"
                                id="doc_no"
                                name="doc_no"
                                value="นม0032.201.1/"
                                ng-model="maintenanceSelected.doc_no"
                                class="form-control"
                            />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">เลขระยะทางเมื่อเข้าซ่อมจริง</label>
                            <input
                                type="text"
                                id="maintained_mileage"
                                name="maintained_mileage"
                                class="form-control"
                            />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="maintained_date">วันที่เข้าซ่อม</label>
                            <input
                                type="text"
                                id="maintained_date"
                                name="maintained_date"
                                ng-model="maintenanceSelected.maintained_date"
                                class="form-control"
                            />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="receive_date">วันที่ซ่อมเสร็จ</label>
                            <input
                                type="text"
                                id="receive_date"
                                name="receive_date"
                                ng-model="maintenanceSelected.receive_date"
                                class="form-control"
                            />
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">เลขที่ใบส่งของ/ใบกำกับภาษี/ใบเสร็จ</label>
                            <input type="text" id="delivery_bill" name="delivery_bill" class="form-control" />
                        </div>
                    </div>

                    <div class="page__title" style="margin: 10px 18px 5px;">
                        <span>
                            <i class="fa fa-calculator" aria-hidden="true"></i> ยอดค่าใช้จ่าย
                        </span>

                        <input
                            type="checkbox"
                            id="is_equal_quotation"
                            name="is_equal_quotation"
                            style="margin-left: 5px;"
                            ng-click="disabledCostInput($event)"
                        /> ยอดเท่าใบเสนอราคา (@{{ maintenanceSelected.total | currency:"":2 }} บาท)

                        <hr style="margin: 5px auto 10px;" />
                    </div>

                    <div class="col-md-12">
                        <div class="alert alert-success" style="padding: 5px; margin-bottom: 10px;">
                            <span><b>หมายเหตุ :</b> ไม่ต้องใส่เครื่องหมาย Comma (,)</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('amt')}">
                            <label for="amt">
                                ค่าใช้จ่ายก่อน VAT(ก)
                            </label>
                            <input
                                type="text"
                                id="amt"
                                name="amt"
                                class="form-control"
                                ng-keyup="calculateMaintainedTotal($event)"
                            />
                            <span
                                class="glyphicon glyphicon-remove form-control-feedback"
                                ng-show="checkValidate('amt')"
                            ></span>
                            <span class="help-block" ng-show="checkValidate('amt')">
                                กรุณาระบุค่าใช้จ่ายก่อน VAT และ ต้องระบุเป็นตัวเลข
                            </span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('vat')}">
                            <label for="vat">VAT(ข)</label>
                            <input
                                type="text"
                                id="vat"
                                name="vat"
                                class="form-control"
                                ng-keyup="calculateMaintainedVatnet($event)"
                            />
                            <span
                                class="glyphicon glyphicon-remove form-control-feedback"
                                ng-show="checkValidate('vat')"
                            ></span>
                            <span class="help-block" ng-show="checkValidate('vat')">
                                กรุณาระบุจำนวน VAT และ ต้องระบุเป็นตัวเลข
                            </span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('total')}">
                            <label for="total">ยอดรวมทั้งสิ้น(ค = ก + ข)</label>
                            <input type="text" id="total" name="total" class="form-control" />
                            <span
                                class="glyphicon glyphicon-remove form-control-feedback"
                                ng-show="checkValidate('total')"
                            ></span>
                            <span
                                class="glyphicon glyphicon-remove form-control-feedback"
                                ng-show="checkValidate('total')"
                            ></span>
                            <span class="help-block" ng-show="checkValidate('total')">
                                กรุณาระบุยอดรวมทั้งสิ้น และ ต้องระบุเป็นตัวเลข
                            </span>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <button
                            type="button"
                            class="btn btn-primary pull-right"
                            ng-click="updateReceiveBill()"
                            data-dismiss="modal"
                        >
                            <i class="fa fa-paper-plane" aria-hidden="true"></i> บันทึกส่งเอกสาร
                        </button>
                    </div>
                
                </div><!-- /.row -->

            </div><!-- /.modal-body -->
        </div><!-- /.modal-content -->
    </div>
</div>
<script>
    $(document).ready(function($) {
        var dateNow = new Date(); 

        $('#doc_date').datetimepicker({
            useCurrent: true,
            format: 'YYYY-MM-DD',
            defaultDate: moment(dateNow)
        });

        $('#maintained_date').datetimepicker({
            useCurrent: true,
            format: 'YYYY-MM-DD',
            defaultDate: moment(dateNow)
        }); 

        $('#receive_date').datetimepicker({
            useCurrent: true,
            format: 'YYYY-MM-DD',
            defaultDate: moment(dateNow)
        });
    });
</script>