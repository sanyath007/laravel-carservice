app.controller('vehicleCtrl', function($scope, $http, toaster, ModalService, CONFIG) {
/** ################################################################################## */
    $scope._ = _;

    /** FORM VALIDATION */
    $scope.formError = null;
    $scope.newVehicle = {
        vehicle_no: '',
        purchased_date: '',
        manufacturer: '',
        model: '',
        color: '',
        year: '',
        engine_no: '',
        chassis_no: '',
        capacity: '',
        fuel_type: '',
        vehicle_cate: '',
        vehicle_type: '',
        reg_no: '',
        reg_chw: '',
        reg_date: '',
        vender: '',
        method: '',
        cost: '',

        // Accessories
        cam_front: '',
        cam_back: '',
        cam_driver: '',
        gps: '',
        radio_com: '',
        light: '',
        siren: '',
        tele_med: '',
    };

    $scope.formValidate = function (event) {
        event.preventDefault();

        $scope.newVehicle.purchased_date = $('#purchased_date').val();
        $scope.newVehicle.reg_date = $('#reg_date').val();

        // Accessories
        $scope.newVehicle.cam_front = $('#cam_front').is(':checked') ? $('#cam_front').val() : 0;
        $scope.newVehicle.cam_back = $('#cam_back').is(':checked') ? $('#cam_back').val() : 0;
        $scope.newVehicle.cam_driver = $('#cam_driver').is(':checked') ? $('#cam_driver').val() : 0;
        $scope.newVehicle.gps = $('#gps').is(':checked') ? $('#gps').val() : 0;
        $scope.newVehicle.radio_com = $('#radio_com').is(':checked') ? $('#radio_com').val() : 0;
        $scope.newVehicle.light = $('#light').is(':checked') ? $('#light').val() : 0;
        $scope.newVehicle.siren = $('#siren').is(':checked') ? $('#siren').val() : 0;
        $scope.newVehicle.tele_med = $('#tele_med').is(':checked') ? $('#tele_med').val() : 0;

        $http.post(CONFIG.baseUrl + '/vehicles/validate', { ...$scope.newVehicle })
        .then(function (res) {
            $scope.formError = res.data;

            if ($scope.formError.success === 0) {
                toaster.pop('error', "", "คุณกรอกข้อมูลไม่ครบ !!!");
            } else {
                $('#frmNewVehicle').submit();
            }
        })
        .catch(function (res) {
            console.log(res);
        });
    }

    $scope.checkValidate = function (field) {
        var status = false;

        if($scope.formError) {
            status = ($scope.formError.errors.hasOwnProperty(field) && $scope.newVehicle[field] === '') ? true : false;
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
