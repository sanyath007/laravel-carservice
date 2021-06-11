<div class="modal fade" id="dlgAllVehicle" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
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
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
            </div> -->
        </div>
    </div>
</div>