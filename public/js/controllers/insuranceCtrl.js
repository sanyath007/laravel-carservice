app.controller('insuranceCtrl', function($scope, $http, toaster, ModalService, CONFIG) {
/** ################################################################################## */
    $scope._ = _;
    
    /** FORM VALIDATION */
    $scope.formError = null;
    $scope.newInsurance = {
        id: '',
        docNo: '',
        docDate: '',
        vehicleId: '',
        insuranceNo: '',
        company: '',
        insuranceType: '',
        insuranceDetail: '',
        insuranceStartDate: '',
        insuranceStartTime: '',
        insuranceRenewalDate: '',
        insuranceRenewalTime:'',
        insuranceNet: '',
        insuranceStamp: '',
        insuranceVat: '',
        insuranceTotal: '',
        remark: ''
    };

    $scope.formValidate = function (event, frmName) {
        event.preventDefault();

        $scope.newInsurance.docDate = $('#doc_date').val();
        $scope.newInsurance.insuranceStartDate = $('#insurance_start_date').val();
        $scope.newInsurance.insuranceRenewalDate = $('#insurance_renewal_date').val();
        $scope.newInsurance.insuranceStartTime = $('#insurance_start_time').val();
        $scope.newInsurance.insuranceRenewalTime = $('#insurance_renewal_time').val();
        
        var req_data = {
            doc_no: $scope.newInsurance.docNo,
            doc_date: $scope.newInsurance.docDate,
            vehicle_id: $scope.newInsurance.vehicleId,
            insurance_no: $scope.newInsurance.insuranceNo,
            company: $scope.newInsurance.company,
            insurance_type: $scope.newInsurance.insuranceType,
            insurance_detail: $scope.newInsurance.insuranceDetail,
            insurance_start_date: $scope.newInsurance.insuranceStartDate,
            insurance_start_time: $scope.newInsurance.insuranceStartTime,
            insurance_renewal_date: $scope.newInsurance.insuranceRenewalDate,
            insurance_renewal_time: $scope.newInsurance.insuranceRenewalTime,
            insurance_net: $scope.newInsurance.insuranceNet,
            insurance_stamp: $scope.newInsurance.insuranceStamp,
            insurance_vat: $scope.newInsurance.insuranceVat,
            insurance_total: $scope.newInsurance.insuranceTotal,
        };

        $http.post(CONFIG.baseUrl + '/insurances/validate', req_data)
        .then(function (res) {
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
		var tmpNet = $('#insurance_net').val() === '' ? 0 : parseFloat($('#insurance_net').val());
        var tmpStamp = $('#insurance_stamp').val() === '' ? 0 : parseFloat($('#insurance_stamp').val());
        var tmpVat = $('#insurance_vat').val() === '' ? 0 : parseFloat($('#insurance_vat').val());
        var tmpTotal = parseFloat(tmpNet + tmpStamp + tmpVat);

        $scope.newInsurance.insuranceTotal = tmpTotal.toFixed(2);
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
                // console.log($scope.frmAllVehicles);
            });
        }
    }

    $scope.edit = function (insurance) {
        console.log(insurance);
        $scope.newInsurance = {
            id: insurance.id,
            docNo: insurance.doc_no,
            docDate: insurance.doc_date,
            vehicleId: insurance.vehicle_id,
            insuranceNo: insurance.insurance_no,
            company: insurance.insurance_company_id.toString(),
            insuranceType: insurance.insurance_type.toString(),
            insuranceDetail: insurance.insurance_detail,
            insuranceStartDate: insurance.insurance_start_date,
            insuranceStartTime: insurance.insurance_start_time,
            insuranceRenewalDate: insurance.insurance_renewal_date,
            insuranceRenewalTime:insurance.insurance_renewal_time,
            insuranceNet: insurance.insurance_net,
            insuranceStamp: insurance.insurance_stamp,
            insuranceVat: insurance.insurance_vat,
            insuranceTotal: insurance.insurance_total,
            remark: insurance.remark
        };
    }
/** ################################################################################## */
});
