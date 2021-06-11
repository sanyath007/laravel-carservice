app.controller('actCtrl', function($scope, $http, toaster, ModalService, CONFIG) {
/** ################################################################################## */
    $scope._ = _;
    
    /** FORM VALIDATION */
    $scope.formError = null;
    $scope.newAct = {
        id: '',
        docNo: '',
        docDate: '',
        vehicleId: '',
        actNo: '',
        company: '',
        actType: '',
        actDetail: '',
        actStartDate: '',
        actStartTime: '',
        actRenewalDate: '',
        actRenewalTime:'',
        actNet: '',
        actStamp: '',
        actVat: '',
        actTotal: '',
        remark: ''
    };

    $scope.formValidate = function (event, frmName) {
        event.preventDefault();

        $scope.newAct.docDate = $('#doc_date').val();
        $scope.newAct.actStartDate = $('#act_start_date').val();
        $scope.newAct.actRenewalDate = $('#act_renewal_date').val();
        
        var req_data = {
            doc_no: $scope.newAct.docNo,
            doc_date: $scope.newAct.docDate,
            vehicle_id: $scope.newAct.vehicleId,
            act_no: $scope.newAct.actNo,
            act_company_id: $scope.newAct.company,
            act_type: $scope.newAct.actType,
            act_detail: $scope.newAct.actDetail,
            act_start_date: $scope.newAct.actStartDate,
            act_start_time: $scope.newAct.actStartTime,
            act_renewal_date: $scope.newAct.actRenewalDate,
            act_renewal_time: $scope.newAct.actRenewalTime,
            act_net: $scope.newAct.actNet,
            act_stamp: $scope.newAct.actStamp,
            act_vat: $scope.newAct.actVat,
            act_total: $scope.newAct.actTotal,
        };

        $http.post(CONFIG.baseUrl + '/act/validate', req_data)
        .then(function (res) {
            // console.log(res);
            $scope.formError = res.data;
            console.log($scope.formError);

            if ($scope.formError.success === 1) {
                $(`#${frmName}`).submit();
            } else {
                toaster.pop('error', "", "คุณกรอกข้อมูลไม่ครบ !!!");
            }
        })
        .catch(function (res) {
            console.log(res);
        });
    }

    $scope.checkValidate = function (field) {
        if (!$scope.formError) return;

        return (field in $scope.formError.errors);
    }

    $scope.calculateTotal = function (event) {
		var tmpNet = parseFloat($('#act_net').val());
        var tmpStamp = parseFloat($('#act_stamp').val());
        var tmpVat = parseFloat($('#act_vat').val());
        var tmpTotal = parseFloat(tmpNet + tmpStamp + tmpVat);

        $scope.newAct.actTotal = tmpTotal.toFixed(2);
    };

    $scope.frmAllVehicles = [];
    $scope.frmVehicle = null;
    $scope.frmVehicleDetail = '';
    $scope.popUpAllVehicle = function () {
        $http.get(CONFIG.baseUrl + '/ajaxvehicles')
        .then(function (res) {
            console.log(res);
            $scope.frmAllVehicles = res.data.vehicles;
            console.log($scope.frmAllVehicles);
            $('#dlgAllVehicle').modal('show');
        });
    }

    $scope.frmSetVehicle = function (vehicle) {
        $('#vehicle_id').val(vehicle.vehicle_id);       
        console.log($('#vehicle_id').val());

        $scope.frmVehicle = vehicle;
        $scope.frmVehicleDetail = vehicle.cate.vehicle_cate_name;
        $scope.frmVehicleDetail += ' ประเภท ' + vehicle.type.vehicle_type_name;
        $scope.frmVehicleDetail += ' ' + vehicle.manufacturer.manufacturer_name;
        $scope.frmVehicleDetail += ' ' + vehicle.model;
        $scope.frmVehicleDetail += ' ทะเบียน ' + vehicle.reg_no + vehicle.changwat.short;
        
        $('#dlgAllVehicle').modal('hide');
    }

    $scope.paginate = function (event, url) {
        if ($(event.target).closest('li').hasClass('disabled')) {
            event.preventDefault();
        } else {
            $http.get(url).then(function (res) {
                console.log(res);
                $scope.frmAllVehicles = res.data.vehicles;
            });
        }
    }

    $scope.edit = function (act) {
        $scope.newAct = {
            id: act.id,
            docNo: act.doc_no,
            docDate: act.doc_date,
            vehicleId: act.vehicle_id,
            actNo: act.act_no,
            company: act.insurance_company_id.toString(),
            actDetail: act.act_detail,
            actStartDate: act.act_start_date,
            actStartTime: act.act_start_time,
            actRenewalDate: act.act_renewal_date,
            actRenewalTime:act.act_renewal_time,
            actNet: act.act_net,
            actStamp: act.act_stamp,
            actVat: act.act_vat,
            actTotal: act.act_total,
            remark: act.remark
        };
    }
/** ################################################################################## */
});
