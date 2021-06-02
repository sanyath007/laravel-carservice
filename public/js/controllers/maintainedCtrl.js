app.controller('maintainedCtrl', function($scope, $http, toaster, ModalService, CONFIG) {
/** ################################################################################## */
	$scope._ = _;
	
	$scope.selectedVehicle = '';
	$scope.date = [];
	$scope.tiresList = [];
	$scope.leakList = [];
	$scope.radiatorList = [];
	$scope.oilList = [];
	$scope.brakeClutchList = [];
	$scope.batteryList = [];
	$scope.windshieldList = [];
	$scope.fuelList = [];
	$scope.gaugesList = [];
	$scope.lightsList = [];
	$scope.oxygenList = [];
	$scope.sirenList = [];
	$scope.radioList = [];
	$scope.damageList = [];
	$scope.isWashedList = [];

	$scope.renderTable = function () {
		$scope.date = [];
		$scope.tiresList = [];
		$scope.leakList = [];
		$scope.radiatorList = [];
		$scope.oilList = [];
		$scope.brakeClutchList = [];
		$scope.batteryList = [];
		$scope.windshieldList = [];
		$scope.fuelList = [];
		$scope.gaugesList = [];
		$scope.lightsList = [];
		$scope.oxygenList = [];
		$scope.sirenList = [];
		$scope.radioList = [];
		$scope.damageList = [];
		$scope.isWashedList = [];

        console.log($scope.selectedVehicle);

		$http.get(CONFIG.baseUrl + '/maintained/ajaxchecklist/' + $('#check_date').val() + '/' + $scope.selectedVehicle)
		.then(function (res) {
			let checkList = res.data.dailycheck;
			console.log(checkList);

			angular.forEach (checkList, function (list) {
				let arrCheckDate = list.check_date.split('-');
				let checkdate = parseInt(arrCheckDate[2]);

				$scope.date.push(checkdate);

				$scope.tiresList.push({
					date: checkdate,
					state: list.tires,
					text: list.tires_text
				});

				$scope.leakList.push({
					date: list.check_date,
					state: list.leak,
					text: list.leak_text
				});

				$scope.radiatorList.push({
					date: list.check_date,
					state: list.radiator,
					text: list.radiator_text
				});

				$scope.oilList.push({
					date: list.check_date,
					state: list.oil,
					text: list.oil_text
				});

					$scope.brakeClutchList.push({
						date: list.check_date,
						state: list.brake_clutch,
						text: list.brake_clutch_text
					});

					$scope.batteryList.push({
						date: list.check_date,
						state: list.battery,
						text: list.battery_text
					});

					$scope.windshieldList.push({
						date: list.check_date,
						state: list.windshield,
						text: list.windshield_text
					});

					$scope.fuelList.push({
						date: list.check_date,
						state: list.fuel,
						text: list.fuel_text
					});

					$scope.gaugesList.push({
						date: list.check_date,
						state: list.gauges,
						text: list.gauges_text
					});

					$scope.lightsList.push({
						date: list.check_date,
						state: list.lights,
						text: list.lights_text
					});

					$scope.oxygenList.push({
						date: list.check_date,
						state: list.oxygen,
						text: list.oxygen_text
					});

					$scope.sirenList.push({
						date: list.check_date,
						state: list.siren,
						text: list.siren_text
					});

					$scope.radioList.push({
						date: list.check_date,
						state: list.radio,
						text: list.radio_text
					});

					$scope.damageList.push({
						date: list.check_date,
						state: list.damage,
						text: list.damage_text
					});

					$scope.isWashedList.push({
						date: list.check_date,
						state: list.is_washed
					});
			})
        });
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
                // console.log($scope.frmAllVehicles);
            });
        }
    }

    $scope.checkListPopup = function (list) {
		console.log(list);
		var popup = document.getElementById("myPopup");
		if (list.text != null) {
			popup.textContent = list.text;
			popup.classList.toggle("show");
		}
    };

	/** ################################################################################## */
    $scope.maintenanceList = [];
    $scope.fillinMaintenanceList = function(event) {
        if (event.which === 13) {
            event.preventDefault();
            $scope.maintenanceList.push($(event.target).val());

            //เคลียร์ค่าใน textfield
            $(event.target).val('');

			// สร้างข้อความรายการอะไหล่ที่จะบันทึกลงใน db โดยคั่นด้วย comma
            var maindetained_detail = "";
            var count = 0;
            angular.forEach($scope.maintenanceList, function(maintained) {
                if(count != $scope.maintenanceList.length - 1){
                    maindetained_detail += maintained + ",";
                } else {
                    maindetained_detail += maintained
                }

                count++;
            });

            $('#detail').val(maindetained_detail);
        }
    };

    // ลบรายการ
    $scope.removeMaintenanceList = function(m) {
        let index = $scope.maintenanceList.indexOf(m);
        $scope.maintenanceList.splice(index, 1);
    }

	/** ################################################################################## */
    $scope.sparePartList = [];
	$scope.sparePartDesc = '';
	$scope.sparePartPrice = 0;
    $scope.fillinSparePartList = function(event) {
		event.preventDefault();
		
		if ($scope.sparePartDesc === '') {
			toaster.pop('error', "", "รายการอะไหล่ต้องไม่เป็นค่าว่าง !!!");
			return;
		}
		
		let reg = /^\d+$/;
		if ($scope.sparePartPrice === 0 || !reg.test($scope.sparePartPrice)) {
			toaster.pop('error', "", "ข้อมูลราคาต้องเป็นตัวเลข และต้องมากกว่าศูนย์ !!!");
			return;
		}

		console.log($scope.sparePartDesc, $scope.sparePartPrice);
		$scope.sparePartList.push({ desc: $scope.sparePartDesc, price: $scope.sparePartPrice });

		//เคลียร์ค่าใน textfield
		$scope.sparePartDesc = '';
		$scope.sparePartPrice = 0;

		// สร้างข้อความรายการอะไหล่ที่จะบันทึกลงใน db โดยคั่นด้วย comma
		var sparePartList_detail = "";
		var count = 0;
		angular.forEach($scope.sparePartList, function(spare) {
			if(count != $scope.sparePartList.length - 1){
				sparePartList_detail += spare.desc+ ' (' +spare.price+ 'บาท)' + ", ";
			} else {
				sparePartList_detail += spare.desc+ ' (' +spare.price+ 'บาท)'
			}

			count++;
		});

		$('#spare_parts').val(sparePartList_detail);
    };

    // ลบรายการ
    $scope.removeSparePartList = function(m) {
        let index = $scope.sparePartList.indexOf(m);
        $scope.sparePartList.splice(index, 1);
    }

    $scope.calculateMaintainedVatnet = function (event) {
        var tmpVat = $(event.target).val();
        var tmpAmt = $('#amt').val();
        var tmpVatnet = parseFloat((tmpAmt * tmpVat) / 100);
        var tmpTotal = parseFloat(tmpAmt) + parseFloat(tmpVatnet);
        $('#total').val(tmpTotal);
        $('#vatnet').val(tmpVatnet);
        console.log(tmpTotal);
    };

	/** =============== FORM VALIDATION =============== */
    $scope.formError = null;
    // $scope.newReserve = {
    //     activity_type: '',
    //     activity: '',
    //     locationId: '',
    //     department: '',
    //     ward: '',
    //     transport: '',
    //     startpoint: '',
    // };

    $scope.formValidate = function (event) {
        event.preventDefault();

        var req_data = {
            mileage: $('#mileage').val(),
            garage: $('#garage').val(),
            amt: $('#amt').val(),
            vat: $('#vat').val(),
            total: $('#total').val(),
            detail: $('#detail').val(),
            spare_parts: $('#spare_parts').val(),
        };

        $http.post(CONFIG.baseUrl + '/maintained/validate', req_data)
        .then(function (res) {
            $scope.formError = res.data.errors;
			console.log($scope.formError);
            if (res.data.success === 1) {
                $('#frmNewMaintenance').submit();
            } else {
                toaster.pop('error', "", "คุณกรอกข้อมูลไม่ครบ !!!");
            }
        })
        .catch(function (err) {
            console.log(err);
        });
    }

    $scope.checkValidate = function (field) {
		if (!$scope.formError) return;
        // var status = false;
        // if (field == 'activity_type_text') {
        //     status = ($scope.formError && $scope.newReserve.activity_type === '99' && $scope.newReserve.activity_type_text === '') ? true : false;
        // } else if (field == 'locationId') {
        //     status = ($scope.formError && $('#locationId').val() === '') ? true : false;
        // } else {
        //     status = ($scope.formError[field].length > 0) ? true : false;
        // }

        return (field in $scope.formError);
    }
});
