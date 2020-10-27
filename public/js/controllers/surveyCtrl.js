app.controller('surveyCtrl', function($scope, $http, toaster, ModalService, CONFIG) {
/** ################################################################################## */
    $scope._ = _;

    /** FORM VALIDATION */
    $scope.formError = null;
    $scope.survey = {
        survey_date: '',
        survey_time: '',
        driver_id: '',
        vehicle_id: '',
        used_type: '',
        hn: '',
        result_vehicle: '',
        result_driver: '',
        user_id: '',
    };

    $scope.loadEditData = function() {
        $scope.newFuel.department = $("#department:checked").val()
        $scope.newFuel.vehicle = $("#vehicle").val()
        $scope.newFuel.fuelType = $("#fuel_type").val()
        $scope.newFuel.billNo = $("#bill_no").val()
        $scope.newFuel.billDate = $("#bill_date").val()
        $scope.newFuel.volume = $("#volume").val()
        $scope.newFuel.unitPrice = $("#unit_price").val()
        $scope.newFuel.total = $("#total").val()
        $scope.newFuel.jobDesc = $("#job_desc").val()
    }

    $scope.formValidate = function(event) {
        event.preventDefault();

        $scope.newFuel.billDate = $('#bill_date').val();
        
        var req_data = {
            department: $scope.newFuel.department,
            vehicle_id: $scope.newFuel.vehicle,
            fuel_type: $scope.newFuel.fuelType,
            bill_no: $scope.newFuel.billNo,
            bill_date: $scope.newFuel.billDate,
            volume: $scope.newFuel.volume,
            unit_price: $scope.newFuel.unitPrice,
            total: $scope.newFuel.total,
            job_desc: $scope.newFuel.jobDesc,
        };
        console.log(req_data);

        $http.post(CONFIG.baseUrl + '/fuel/validate', req_data)
        .then(function (res) {
            // console.log(res);
            $scope.formError = res.data;
            console.log($scope.formError);

            if ($scope.formError.success === 1) {
                let formId = $(event.target).closest("form").attr("id")
                $("#"+formId).submit();
            } else {
                toaster.pop('error', "", "คุณกรอกข้อมูลไม่ครบ !!!");
            }
        })
        .catch(function (res) {
            console.log(res);
        });
    }

    $scope.checkValidate = function(field) {
        var status = false;

        status = ($scope.formError && $scope.newFuel[field] === '') ? true : false;

        return status;
    };

    $scope.validateBulletChecked = function(bullets) {
        let checkedCount = 0;
        angular.forEach($('input[type="radio"]'), function(radio, val) {
            angular.forEach(bullets, function(bullet, val) {
                if($(radio).attr('id') == bullet.id && $(radio).is(":checked")) {
                    checkedCount++;
                }   
            });      
        });

        return !(checkedCount == bullets.length);
    };

    $scope.add = function(event, form, bullets) {
        event.preventDefault();

        if (form.$invalid || $scope.validateBulletChecked(bullets)) {
            if($scope.validateBulletChecked(bullets)){
                toaster.pop('warning', "", 'กรุณาประเมินความพึงพอใจของท่านในแต่ละข้อก่อน !!!');
            }

            toaster.pop('warning', "", 'กรุณาข้อมูลให้ครบก่อน !!!');
            return;
        } else {
            document.getElementById('frmSurvey').submit();

            // $http.post(CONFIG.BASE_URL + '/survey/store', $scope.survey)
            // .then(function(res) {
            //     console.log(res);
            //     toaster.pop('success', "", 'บันทึกข้อมูลเรียบร้อยแล้ว !!!');
            // }, function(err) {
            //     console.log(err);
            //     toaster.pop('error', "", 'พบข้อผิดพลาด !!!');
            // });            
        }

        // document.getElementById('frmSurvey').reset();
    };

    // $scope.frmAllVehicles = [];
    // $scope.frmVehicle = null;
    // $scope.frmVehicleDetail = '';
    // $scope.popUpAllVehicle = function () {
    //     $http.get(CONFIG.baseUrl + '/ajaxvehicles')
    //     .then(function (res) {
    //         console.log(res);
    //         $scope.frmAllVehicles = res.data.vehicles;
    //         console.log($scope.frmAllVehicles);
    //         $('#dlgAllVehicle').modal('show');
    //     });
    // }

    $scope.frmSetVehicle = function(vehicle) {
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

    $scope.paginate = function(event, url) {
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
/** ################################################################################## */
    /** CRUD ACTION */
    $scope.delete = function(event, id) {
        console.log(event);     
        event.preventDefault();

        if (confirm('คุณต้องการลบข้อมูล ID ' + id +' ใช่หรือไม่?')) {
            document.getElementById(id + '-delete-form').submit();
        }
    }

    $scope.cancel = function(event, id) {
        console.log(event);     
        event.preventDefault();

        if (confirm('คุณต้องการยกเลิกข้อมูล ID ' + id +' ใช่หรือไม่?')) {
            document.getElementById(id + '-cancel-form').submit();
        }
    }
/** ################################################################################## */
});
