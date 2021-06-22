app.controller('maintenanceCtrl', function($scope, $http, toaster, ModalService, CONFIG) {
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

		$http.get(`${CONFIG.baseUrl}/maintenances/ajaxchecklist/${$('#check_date').val()}/${$scope.selectedVehicle}`)
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

	$scope.edit = function (maintenance) {
		$scope.maintenanceList = maintenance.detail.split(',');

		if (maintenance.spare_parts) {
			maintenance.spare_parts.split(',').forEach(sp => {
				let item = sp.split('ราคา');
				$scope.sparePartList.push({ desc: item[0], price: item[1] });
			});
		}
	};

	/** ################################################################################## */
	/** สร้างรายการซ่อมและรายการอะไหล่สำหรับ insert ลงฐานข้อมูลแยกด้วย comma (,) */
	const createStringList = function (lists) {
		let count = 0;
		let _str = "";
		angular.forEach(lists, function(lst) {
			if(count != lists.length - 1){
				_str += `${lst.desc} ราคา ${lst.price} บาท,`;
			} else {
				_str += `${lst.desc} ราคา ${lst.price} บาท`;
			}

			count++;
		});

		return _str;
	}

	$scope.detailText = "";
	$scope.detailPrice = '';
    $scope.maintenanceList = [];
    $scope.fillinMaintenanceList = function(event) {
		event.preventDefault();
		
		if ($scope.detailText === '') {
			toaster.pop('error', "", "รายการอะไหล่ต้องไม่เป็นค่าว่าง !!!");
			return;
		}
		
		let reg = /^\d+$/;
		if (!reg.test($scope.detailPrice)) {
			toaster.pop('error', "", "ข้อมูลรวมเป็นเงินต้องเป็นตัวเลข !!!");
			return;
		}

		console.log($scope.detailText, $scope.detailPrice);
		$scope.maintenanceList.push({ desc: $scope.detailText.replace(',', ''), price: $scope.detailPrice });

		//เคลียร์ค่าใน textfield
		$scope.detailText = "";
		$scope.detailPrice = 0;

		$('#detail').val(createStringList($scope.maintenanceList));
		console.log($('#detail').val());
    };

    // ลบรายการ
    $scope.removeMaintenanceList = function(m) {
        let index = $scope.maintenanceList.indexOf(m);
        $scope.maintenanceList.splice(index, 1);
    }

	/** ################################################################################## */
    $scope.sparePartList = [];
	$scope.sparePartDesc = '';
	$scope.sparePartPrice = '';
    $scope.fillinSparePartList = function(event) {
		event.preventDefault();
		
		if ($scope.sparePartDesc === '') {
			toaster.pop('error', "", "รายการอะไหล่ต้องไม่เป็นค่าว่าง !!!");
			return;
		}
		
		let reg = /^\d+$/;
		if (!reg.test($scope.sparePartPrice)) {
			toaster.pop('error', "", "ข้อมูลรวมเป็นเงินต้องเป็นตัวเลข !!!");
			return;
		}

		console.log($scope.sparePartDesc, $scope.sparePartPrice);
		$scope.sparePartList.push({ desc: $scope.sparePartDesc.replace(',', ''), price: $scope.sparePartPrice });

		//เคลียร์ค่าใน textfield
		$scope.sparePartDesc = '';
		$scope.sparePartPrice = '';

		$('#spare_parts').val(createStringList($scope.sparePartList));
    };

    // ลบรายการ
    $scope.removeSparePartList = function(m) {
        let index = $scope.sparePartList.indexOf(m);
        $scope.sparePartList.splice(index, 1);
    }

	$scope.calculateMaintainedTotal = function (event) {
		var tmpAmt = $('#amt').val();
        var tmpVat = $('#vat').val();
        var tmpVatnet = parseFloat((tmpAmt * tmpVat) / 100);
        var tmpTotal = parseFloat(tmpAmt) + parseFloat(tmpVatnet);

        $('#total').val(tmpTotal.toFixed(2));
        $('#vatnet').val(tmpVatnet.toFixed(2));
    };

    $scope.calculateMaintainedVatnet = function (event) {
		var tmpAmt = $('#amt').val();
        var tmpVat = $(event.target).val();
        var tmpVatnet = parseFloat((tmpAmt * tmpVat) / 100);
        
        $('#vatnet').val(tmpVatnet.toFixed(2));

		$scope.calculateMaintainedTotal(event);
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
            maintained_type: $('#maintained_type').val(),
            garage: $('#garage').val(),
            amt: $('#amt').val(),
            vat: $('#vat').val(),
            total: $('#total').val(),
            detail: $('#detail').val(),
            spare_parts: $('#spare_parts').val(),
        };

        $http.post(CONFIG.baseUrl + '/maintenances/validate', req_data)
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
    };

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
    };

	$scope.showReceiveBillForm = function (event, id) {
		console.log(id);
		$('#_id').val(id);

		$('#dlgReceiveBillForm').modal('show');
    };
	
	$scope.updateReceiveBill = function (event) {
		const id = $('#_id').val();
		const req_data = {
			maintained_mileage: $('#maintained_mileage').val(),
			delivery_bill: $('#delivery_bill').val()
		}

        $http.put(CONFIG.baseUrl + `/maintenances/${id}/receive-bill`, req_data)
        .then(function (res) {
			if (res.data.status === 1) {
				toaster.pop('success', "", "บันทึกส่งเอกสารใบส่งของเรียบร้อย !!!");

				window.location.href = CONFIG.baseUrl + 'maintenances/list';
			}
        })
		.catch(function (err) {
			console.log(err);
		});
    };
});
