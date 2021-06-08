app.controller('taxCtrl', function($scope, $http, toaster, ModalService, CONFIG) {
/** ################################################################################## */
    $scope._ = _;

    /** FORM VALIDATION */
    $scope.formError = null;
    $scope.newTax = {
        id: '',
        docNo: '',
        docDate: '',
        taxStartDate: '',
        taxRenewalDate: '',
        taxReceiptNo: '',
        taxCharge: '',
        remark: ''
    };

    $scope.formValidate = function (event) {
        event.preventDefault();

        $scope.newTax.docDate = $('#doc_date').val();
        $scope.newTax.taxStartDate = $('#tax_start_date').val();
        $scope.newTax.taxRenewalDate = $('#tax_renewal_date').val();
        
        var req_data = {
            doc_no: $scope.newTax.docNo,
            doc_date: $scope.newTax.docDate,
            tax_start_date: $scope.newTax.taxStartDate,
            tax_renewal_date: $scope.newTax.taxRenewalDate,
            tax_receipt_no: $scope.newTax.taxReceiptNo,
            tax_charge: $scope.newTax.taxCharge,
        };
        console.log(req_data);

        $http.post(CONFIG.baseUrl + '/tax/validate', req_data)
        .then(function (res) {
            // console.log(res);
            $scope.formError = res.data;
            console.log($scope.formError);

            if ($scope.formError.success === 1) {
                $('#frmNewTax').submit();
            } else {
                toaster.pop('error', "", "คุณกรอกข้อมูลไม่ครบ !!!");
            }
        })
        .catch(function (res) {
            console.log(res);
        });
    }

    $scope.checkValidate = function (field) {
        var status = false;

        status = ($scope.formError && $scope.newTax[field] === '') ? true : false;

        return status;
    }

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

    $scope.edit = function (tax) {
        $scope.newTax = {
            id: tax.id,
            docNo: tax.doc_no,
            docDate: tax.doc_date,
            taxStartDate: tax.tax_start_date,
            taxRenewalDate: tax.tax_renewal_date,
            taxReceiptNo: tax.tax_receipt_no,
            taxCharge: tax.tax_charge,
            remark: tax.remark
        };
    }
/** ################################################################################## */
});
