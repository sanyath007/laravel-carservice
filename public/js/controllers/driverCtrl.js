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

    $scope.formValidate = function (event, frmName) {
        event.preventDefault();

        $scope.newDriver.checkup_date = $('#checkup_date').val();
        $scope.newDriver.capability_date = $('#capability_date').val();
        $scope.newDriver.certificated_date = $('#certificated_date').val();
        
        $scope.newDriver.checkup_result = $('#checkup_result').is(':checked') ? $('#checkup_result').val() : '';
        $scope.newDriver.capability_result = $('#capability_result').is(':checked') ? $('#capability_result').val() : '';
        
        $scope.newDriver.emr_sdate = $('#emr_sdate').val();
        $scope.newDriver.emr_edate = $('#emr_edate').val();

        // ใบประกาศนียบัตร
        $scope.newDriver.is_certificated = $('#is_certificated').is(':checked') ? $('#is_certificated').val() : 0;
        $scope.newDriver.is_emr = $('#is_emr').is(':checked') ? $('#is_emr').val() : 0;
        console.log($scope.newDriver);

        $http.post(CONFIG.baseUrl + '/drivers/validate', { ...$scope.newDriver })
        .then(function (res) {
            $scope.formError = res.data;
            console.log($scope.formError)

            if ($scope.formError.success === 0) {
                toaster.pop('error', "", "คุณกรอกข้อมูลไม่ครบ !!!");
            } else {
                $(`#${frmName}`).submit();
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

    $scope.edit = function (driver) {
        console.log(driver);

        $scope.newDriver = {
            person_id: driver.person_id,
            description: driver.description,
            tel: driver.tel,
            tel2: driver.tel2,
            license_no: driver.license_no,
            license_type: driver.license_type ? driver.license_type.toString() : '',
            checkup_date: driver.checkup_date,
            checkup_result: driver.checkup_result,
            capability_date: driver.capability_date,
            capability_result: driver.capability_result,
            is_certificated: driver.is_certificated,
            certificated_date: driver.certificated_date,
            is_emr: driver.is_emr,
            emr_sdate: driver.emr_sdate,
            emr_edate: driver.emr_edate,
            driver_type: driver.driver_type,
            remark: driver.remark,
        };
    }
/** ################################################################################## */
});
