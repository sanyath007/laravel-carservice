app.controller('vehicleCtrl', function($scope, $http, toaster, ModalService, CONFIG) {
/** ################################################################################## */
    console.log(CONFIG.BASE_URL);
    let baseUrl = CONFIG.BASE_URL;
/** ################################################################################## */
    $scope._ = _;

    /** FORM VALIDATION */
    $scope.formError = null;
    $scope.newVehicle = {
        docNo: '',
        docDate: '',
        taxStartDate: '',
        taxRenewalDate: '',
        taxReceiptNo: '',
        taxCharge: '',
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

        $http.post(baseUrl + '/tax/validate', req_data)
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

    $scope.vehicleStatus = 0;

    $scope.showVehicleListWithStatus = function(status) {
        console.log(status);
        
        $http.get('/vehicles/list?status=' +status)
        .then(function(res) {
            console.log(res);
        }, function(err) {
            console.log(err);
        });
    }

/** ################################################################################## */
});
