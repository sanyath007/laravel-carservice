    @extends('layouts.main')

    @section('content')
    <div class="container-fluid" ng-controller="maintainedCtrl">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
            <li class="breadcrumb-item active">บันทึกการบำรุงรักษารถ</li>
        </ol>

        <!-- page title -->
        <div class="page__title">
            <span>
                <i class="fa fa-car" aria-hidden="true"></i> บันทึกการบำรุงรักษารถ
                {{ $vehicle->cate->vehicle_cate_name }}
                {{ $vehicle->type->vehicle_type_name }}
                {{ $vehicle->manufacturer->manufacturer_name }}
                ทะเบียน {{ $vehicle->reg_no }} {{ $vehicle->changwat->short }}
            </span>
        </div>

        <hr />
        <!-- page title -->
        
        <form id="frmNewMaintenance" action="{{ url('/maintained/add') }}" method="post">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ID">เลขที่รายการ</label>
                        <input type="text" value="MT60-NEW" class="form-control" readonly>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('mileage')}">
                        <label for="ID">เลขระยะทางเมื่อเข้าซ่อม</label>
                        <input type="text" id="mileage" name="mileage" class="form-control">
                        <span class="glyphicon glyphicon-remove form-control-feedback" ng-show="checkValidate('mileage')"></span>
                        <span class="help-block" ng-show="checkValidate('mileage')">กรุณาระบุเลขระยะทางเมื่อเข้าซ่อม</span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ID">วันที่ขออนุมัติ</label>
                        <input type="text" id="doc_date" name="doc_date" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ID">เลขที่เอกสาร</label>
                        <input type="text" id="doc_no" name="doc_no" value="นม0032.001.8.1/NEW" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ID">วันที่เข้าซ่อม</label>
                        <input type="text" id="maintained_date" name="maintained_date" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ID">วันที่ซ่อมเสร็จ</label>
                        <input type="text" id="receive_date" name="receive_date" class="form-control">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('garage')}">
                        <label for="garage">สถานที่ซ่อม</label>
                        <select id="garage" name="garage" class="form-control">
                            <option value="">-- กรุณาเลือกสถานที่ซ่อม --</option>
                            <?php $garages = App\Garage::all(); ?>                      
                            @foreach($garages as $garage)
                                <option value="{{ $garage->garage_id }}">
                                    {{ $garage->garage_name }}
                                </option>
                            @endforeach
                        </select>
                        <span class="glyphicon glyphicon-remove form-control-feedback" ng-show="checkValidate('garage')"></span>
                        <span class="help-block" ng-show="checkValidate('garage')">กรุณาเลือกสถานที่ซ่อม</span>
                    </div>         
                        
                </div>

                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('detail')}">
                        <label for="ID">รายการซ่อม</label>
                        
                        <input type="text" id="addDetail" name="addDetail" class="form-control" placeholder="รายการซ่อม&hellip;" ng-keypress="fillinMaintenanceList($event)">
                        <span class="help-block" ng-show="checkValidate('detail')">รายการซ่อม</span>
                    </div>

                    <div class="table-responsive" style="height: 165px;border: 1px solid #D8D8D8;">
                        <table id="products-list" class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 5%; text-align: center;">#</th>
                                    <th>รายการซ่อม</th>
                                    <!-- <th style="width: 30%; text-align: center;">ประเภท</th> -->
                                    <th style="width: 10%; text-align: center;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="(index, m) in maintenanceList">
                                    <td style="text-align: center;">@{{ index + 1 }}</td>
                                    <td>@{{ m }}</td>
                                    <!-- <td></td> -->
                                    <td style="text-align: center;">
                                        <a ng-click="removeMaintenanceList(m)" style="color: red;cursor: pointer;">
                                            <i class="fa fa-times-circle" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('spare_parts')}">
                        <label for="ID">รายการอะไหล่</label>
                        
                        <div style="display: flex; flex-direction: row;">
                            <input
                                type="text"
                                id="sparePartDesc"
                                name="sparePartDesc"
                                ng-model="sparePartDesc"
                                class="form-control"
                                placeholder="รายการอะไหล่&hellip;"
                            >
                            
                            <input
                                type="text"
                                id="sparePartPrice"
                                name="sparePartPrice"
                                ng-model="sparePartPrice"
                                class="form-control"
                                placeholder="ราคา&hellip;"
                                style="width: 20%; margin-left: 5px;"
                            >
                            <button
                                type="button"
                                class="btn btn-success"
                                style="margin-left: 5px;"
                                ng-click="fillinSparePartList($event)"
                            >
                                เพิ่ม
                            </button>
                        </div>
                        <span class="help-block" ng-show="checkValidate('spare_parts')">รายการอะไหล่</span>
                    </div>

                    <div class="table-responsive" style="height: 165px;border: 1px solid #D8D8D8;">
                        <table id="products-list" class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 5%; text-align: center;">#</th>
                                    <th>รายการอะไหล่</th>
                                    <th style="width: 10%; text-align: center;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="(index, spare) in sparePartList">
                                    <td style="text-align: center;">@{{ index + 1 }}</td>
                                    <td>@{{ spare.desc+ ' (' +spare.price+ 'บาท)' }}</td>
                                    <td style="text-align: center;">
                                        <a ng-click="removeSparePartList(spare)" style="color: red;cursor: pointer;">
                                            <i class="fa fa-times-circle" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="ID">หมายเหตุ</label>
                        <textarea id="remark" name="remark" cols="30" rows="4" class="form-control"></textarea>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('amt')}">
                        <label for="ID">(ก) ค่าใช้จ่าย (ไม่ต้องใส่เครื่องหมายคอมมา หรือ ,)</label>
                        <input type="text" id="amt" name="amt" class="form-control">
                        <span class="glyphicon glyphicon-remove form-control-feedback" ng-show="checkValidate('amt')"></span>
                        <span class="help-block" ng-show="checkValidate('amt')">กรุณาระบุค่าใช้จ่าย</span>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('vat')}">
                        <label for="ID">(ข) VAT</label>
                        <input type="text" id="vat" name="vat" class="form-control" ng-keyup="calculateMaintainedVatnet($event)">
                        <span class="glyphicon glyphicon-remove form-control-feedback" ng-show="checkValidate('vat')"></span>
                        <span class="help-block" ng-show="checkValidate('vat')">กรุณาระบุจำนวน VAT</span>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group" ng-class="{'has-error has-feedback': checkValidate('total')}">
                        <label for="ID">(ก+ข) ยอดรวมทั้งสิ้น</label>
                        <input type="text" id="total" name="total" class="form-control">
                        <span class="glyphicon glyphicon-remove form-control-feedback" ng-show="checkValidate('total')"></span>
                        <span class="help-block" ng-show="checkValidate('total')">กรุณาระบุยอดรวมทั้งสิ้น</span>
                    </div>
                </div>

                <div class="col-md-12">
                    <br><button class="btn btn-primary pull-right" ng-click="formValidate($event)">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก
                    </button>
                </div>

            </div><!-- /.row -->

            <input type="hidden" id="detail" name="detail">
            <input type="hidden" id="spare_parts" name="spare_parts">
            <input type="hidden" id="vatnet" name="vatnet">
            <input type="hidden" id="staff" name="staff" value="{{ Auth::user()->person_id }}">
            <input type="hidden" id="vehicle" name="vehicle" value="{{ $vehicle->vehicle_id }}">
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

    </div><!-- /.container -->
    @endsection
