<div class="modal fade" id="dlgReceiveBillForm" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="">ฟอร์มส่งเอกสาร (ใบส่งของ/ใบกำกับภาษี/ใบเสร็จ ซ่อมบำรุงรถยนต์)</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="_id" name="_id" />

                <div class="form-group">
                    <label for="">เลขระยะทางเมื่อเข้าซ่อมจริง</label>
                    <input type="text" id="maintained_mileage" name="maintained_mileage" class="form-control">
                </div>
                <div class="form-group">
                    <label for="maintained_date">วันที่เข้าซ่อม</label>
                    <input type="text" id="maintained_date" name="maintained_date" value="{{ $maintenance->maintained_date }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="receive_date">วันที่ซ่อมเสร็จ</label>
                    <input type="text" id="receive_date" name="receive_date" value="{{ $maintenance->receive_date }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">เลขที่ใบส่งของ/ใบกำกับภาษี/ใบเสร็จ</label>
                    <input type="text" id="delivery_bill" name="delivery_bill" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" ng-click="updateReceiveBill()" data-dismiss="modal">
                    <i class="fa fa-paper-plane" aria-hidden="true"></i> บันทึกส่งเอกสาร
                </button>
            </div>
        </div>
    </div>
</div>