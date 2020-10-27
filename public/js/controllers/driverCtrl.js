app.controller('driverCtrl', function($scope, $http, toaster, ModalService, CONFIG) {
/** ################################################################################## */
    $scope._ = _;

    /** FORM VALIDATION */
    $scope.formError = null;
    $scope.newDriver = {
        person_id: '',
        description: '',
        tel: '',
        tel2: '',
        license_no: '',
        license_type: '',
        checkup_date: '',
        checkup_result: '',
        capability_date: '',
        capability_result: '',
        is_certificated: '',
        certificated_date: '',
        is_emr: '',
        emr_sdate: '',
        emr_edate: '',
        driver_type: '',
        remark: '',
    };

    $scope.formValidate = function (event) {
        event.preventDefault();

        $scope.newDriver.checkup_date = $('#checkup_date').val();
        $scope.newDriver.capability_date = $('#capability_date').val();
        $scope.newDriver.certificated_date = $('#certificated_date').val();
        $scope.newDriver.emr_sdate = $('#emr_sdate').val();
        $scope.newDriver.emr_edate = $('#emr_edate').val();

        // ใบประกาศนียบัตร
        $scope.newDriver.is_certificated = $('#is_certificated').is(':checked') ? $('#is_certificated').val() : 0;
        $scope.newDriver.is_emr = $('#is_emr').is(':checked') ? $('#is_emr').val() : 0;

        $http.post(CONFIG.baseUrl + '/drivers/validate', { ...$scope.newDriver })
        .then(function (res) {
            $scope.formError = res.data;
            console.log($scope.formError)

            if ($scope.formError.success === 0) {
                toaster.pop('error', "", "คุณกรอกข้อมูลไม่ครบ !!!");
            } else {
                $('#frmNewDriver').submit();
            }
        })
        .catch(function (res) {
            console.log(res);
        });
    }

    $scope.checkValidate = function (field) {
        var status = false;
        
        if($scope.formError) {
            status = ($scope.formError.errors.hasOwnProperty(field) && $scope.newDriver[field] === '') ? true : false;
        }

        return status;
    }

    $scope.vehicleStatus = 0;
    $scope.showVehicleListWithStatus = function(status) {
        console.log(status);
        
        $("#formVehicleList").submit();
    }

    $scope.setVehicleStatus = function(status) {
        $scope.vehicleStatus = status;
    }
/** ################################################################################## */
});
