app.controller('reportCtrl', function(CONFIG, $scope, limitToFilter, $scope, ReportService) {
/** ################################################################################## */
    console.log(CONFIG.BASE_URL);
    let baseUrl = CONFIG.BASE_URL;
    
    $scope.pieOptions = {};
    $scope.barOptions = {};

    $scope.getServiceData = function () {
        var selectMonth = document.getElementById('selectMonth').value;
        var year = (selectMonth == '') ? moment().format('YYYY') : selectMonth;
        console.log(year);

        ReportService.getSeriesData('/report/service-chart/', year)
        .then(function(res) {
            console.log(res);
            var requestSeries = [];
            var serviceSeries = [];
            var cancelSeries = [];

            angular.forEach(res.data, function(value, key) {
                requestSeries.push(value.request);
                serviceSeries.push(value.service);
                cancelSeries.push(value.cancel);
            });

            var categories = ['ตค', 'พย', 'ธค', 'มค', 'กพ', 'มีค', 'เมย', 'พค', 'มิย', 'กค', 'สค', 'กย']
            $scope.barOptions = ReportService.initBarChart("barContainer", "รายงานการให้บริการทั้งหมด", categories, 'จำนวน');
            $scope.barOptions.series.push({
                name: 'ร้องขอ',
                data: requestSeries
            }, {
                name: 'ให้บริการ',
                data: serviceSeries
            }, {
                name: 'ยกเลิก',
                data: cancelSeries
            });

            var chart = new Highcharts.Chart($scope.barOptions);
        }, function(err) {
            console.log(err);
        });
    };

    $scope.getPeriodData = function () {
        var selectMonth = document.getElementById('selectMonth').value;
        var month = (selectMonth == '') ? moment().format('YYYY-MM') : selectMonth;
        console.log(month);

        ReportService.getSeriesData('/report/period-chart/', month)
        .then(function(res) {
            console.log(res);
            
            var categories = [];
            var nSeries = [];
            var mSeries = [];
            var aSeries = [];
            var eSeries = [];

            angular.forEach(res.data, function(value, key) {
                categories.push(value.d);
                nSeries.push(value.n);
                mSeries.push(value.m);
                aSeries.push(value.a);
                eSeries.push(value.e);
            });

            $scope.barOptions = ReportService.initStackChart("barContainer", "รายงานการให้บริการ ตามช่วงเวลา", categories, 'จำนวนการให้บริการ');
            $scope.barOptions.series.push({
                name: '00.00-08.00น.',
                data: nSeries
            }, {
                name: '08.00-12.00น.',
                data: mSeries
            }, {
                name: '12.00-16.00น.',
                data: aSeries
            }, {
                name: '16.00-00.00น.',
                data: eSeries
            });

            var chart = new Highcharts.Chart($scope.barOptions);
        }, function(err) {
            console.log(err);
        });
    };

    $scope.getDepartData = function () {
        var selectMonth = document.getElementById('selectMonth').value;
        var month = (selectMonth == '') ? moment().format('YYYY-MM') : selectMonth;
        console.log(month);

        ReportService.getSeriesData('/report/depart-chart/', month)
        .then(function(res) {
            console.log(res);
            var dataSeries = [];

            $scope.pieOptions = ReportService.initPieChart("pieContainer", "รายงานการให้บริการ ตามหน่วยงาน");
            angular.forEach(res.data, function(value, key) {
                $scope.pieOptions.series[0].data.push({name: value.depart, y: value.request});
            });

            var chart = new Highcharts.Chart($scope.pieOptions);
        }, function(err) {
            console.log(err);
        });
    };

    $scope.getReferData = function () {
        var selectMonth = document.getElementById('selectMonth').value;
        var month = (selectMonth == '') ? moment().format('YYYY-MM') : selectMonth;
        console.log(month);

        ReportService.getSeriesData('/report/refer-chart/', month)
        .then(function(res) {
            console.log(res);
            var nSeries = [];
            var mSeries = [];
            var aSeries = [];
            var eSeries = [];
            var categories = [];

            angular.forEach(res.data, function(value, key) {
                categories.push(value.d)
                nSeries.push(value.n);
                mSeries.push(value.m);
                aSeries.push(value.a);
            });

            $scope.barOptions = ReportService.initStackChart("barContainer", "รายงานการให้บริการให้บริการรับ-ส่งต่อผู้ป่วย", categories, 'จำนวน Refer');
            $scope.barOptions.series.push({
                name: 'เวรดึก',
                data: nSeries
            }, {
                name: 'เวรเช้า',
                data: mSeries
            }, {
                name: 'เวรบ่าย',
                data: aSeries
            });

            var chart = new Highcharts.Chart($scope.barOptions);
        }, function(err) {
            console.log(err);
        });
    };

    $scope.getFuelDayData = function () {
        var selectMonth = document.getElementById('selectMonth').value;
        var month = (selectMonth == '') ? moment().format('YYYY-MM') : selectMonth;
        console.log(month);

        ReportService.getSeriesData('/report/fuel-day-chart/', month)
        .then(function(res) {
            console.log(res);
            var nSeries = [];
            var mSeries = [];
            var categories = [];

            angular.forEach(res.data, function(value, key) {
                categories.push(value.bill_date)
                nSeries.push(value.qty);
                mSeries.push(value.net);
            });

            $scope.barOptions = ReportService.initBarChart("barContainer", "รายงานการใช้น้ำมันรวม รายเดือน", categories, 'จำนวน');
            $scope.barOptions.series.push({
                name: 'ปริมาณ(ลิตร)',
                data: nSeries
            }, {
                name: 'มูลค่า(บาท)',
                data: mSeries
            });

            var chart = new Highcharts.Chart($scope.barOptions);
        }, function(err) {
            console.log(err);
        });
    };

    $scope.getFuelVehicleData = function () {
        var selectMonth = document.getElementById('selectMonth').value;
        var month = (selectMonth == '') ? moment().format('YYYY-MM') : selectMonth;
        console.log(month);

        ReportService.getSeriesData('/report/fuel-vehicle-chart/', month)
        .then(function(res) {
            console.log(res);
            var nSeries = [];
            var mSeries = [];
            var categories = [];

            angular.forEach(res.data, function(value, key) {
                categories.push(value.vehicle)
                nSeries.push(value.qty);
                mSeries.push(value.net);
            });

            $scope.barOptions = ReportService.initBarChart("barContainer", "รายงานการใช้น้ำมันรวม รายรถ", categories, 'จำนวน');
            $scope.barOptions.series.push({
                name: 'ปริมาณ(ลิตร)',
                data: nSeries
            }, {
                name: 'มูลค่า(บาท)',
                data: mSeries
            });

            var chart = new Highcharts.Chart($scope.barOptions);
        }, function(err) {
            console.log(err);
        });
    };

    $scope.getSumMaintainedData = function (data) {
        console.log(data);

        $scope.pieOptions = ReportService.initPieChart("pieContainer", "สรุปยอดการซ่อมรถยนต์");
        $scope.pieOptions.series[0].data.push({name: "บำรุงรักษาตามระยะ", y: data[0].type1});
        $scope.pieOptions.series[0].data.push({name: "ซ่อมตามอาการเสีย", y: data[0].type2});
        $scope.pieOptions.series[0].data.push({name: "ติดตั้งเพิ่ม", y: data[0].type3});

        var chart = new Highcharts.Chart($scope.pieOptions);
    };

    $scope.getSumFuelData = function (data) {
        console.log(data);

        $scope.pieOptions = ReportService.initPieChart("pieContainer", "สรุปยอดค่าใช้จ่ายน้ำมันเชื้อเพลิง");
        $scope.pieOptions.series[0].data.push({name: "รถพยาบาล", y: data[0].ambu});
        $scope.pieOptions.series[0].data.push({name: "รถทั่วไป", y: data[0].gen});
        $scope.pieOptions.series[0].data.push({name: "รถใช้ภายใน", y: data[0].inter});
        $scope.pieOptions.series[0].data.push({name: "เครื่องตัดหญ้า", y: data[0].glass});
        $scope.pieOptions.series[0].data.push({name: "เครื่องปั่นไฟ", y: data[0].elec});

        var chart = new Highcharts.Chart($scope.pieOptions);
    };

    $scope.getServiceVehicleData = function (data) {
        console.log(data);

        $scope.pieOptions = ReportService.initPieChart("pieContainer", "รายงานการให้บริการ รายรถ");
        angular.forEach(data, function(val) {
            console.log(val);
            if(val.reg_no) { 
                $scope.pieOptions.series[0].data.push({name: val.reg_no, y: val.vehicle_count});
            } else {
                $scope.pieOptions.series[0].data.push({name: "ไม่ได้ระบุ", y: val.vehicle_count});
            }
            
        });

        var chart = new Highcharts.Chart($scope.pieOptions);
    };

    $scope.getServiceLocationData = function (data) {
        /** จังหวัด */
        var nmSeries = 0;
        var buSeries = 0;
        var suSeries = 0;
        var chSeries = 0;
        var bkSeries = 0;
        var nonSeries = 0;
        var othSeries = 0;
        /** อำเภอ */
        var dmSeries = 0;
        var notdmSeries = 0;

        console.log(data)
        angular.forEach(data, function(value, key) {
            /** จังหวัด */
            if (value.chw_id == 30) {
                nmSeries += parseInt(value.count);
            } else if (value.chw_id == 31) {
                buSeries += parseInt(value.count);
            } else if (value.chw_id == 32) {
                suSeries += parseInt(value.count);
            } else if (value.chw_id == 36) {
                chSeries += parseInt(value.count);
            } else if (value.chw_id == 10) {
                bkSeries += parseInt(value.count);
            } else if (value.chw_id == 12) {
                nonSeries += parseInt(value.count);
            } else {
                othSeries += parseInt(value.count);
            }

            /** อำเภอ */
            if (value.chw_id == 30 && value.amp_id == 3001) {
                dmSeries += parseInt(value.count);
            } else if (value.chw_id == 30 && value.amp_id != 3001) {
                notdmSeries += parseInt(value.count);
            }
        });

        console.log('nm=' + nmSeries + ', br=' + buSeries + ', sr=' + suSeries + ', cp=' + chSeries + ', bkk=' + bkSeries + ', oth=' + (parseInt(nonSeries) + parseInt(othSeries)))
        $scope.pieOptions1 = ReportService.initPieChart("pieContainer1", "รายงานการให้บริการ รายพื้นที่จังหวัด");
        $scope.pieOptions1.series[0].data.push({name: 'นครราชสีมา', y: nmSeries});
        $scope.pieOptions1.series[0].data.push({name: "บุรีรัมย์", y: buSeries});
        $scope.pieOptions1.series[0].data.push({name: "สุรินทร์", y: suSeries});
        $scope.pieOptions1.series[0].data.push({name: "ชัยภูมิ", y: chSeries});
        $scope.pieOptions1.series[0].data.push({name: "กทม.", y: bkSeries});
        $scope.pieOptions1.series[0].data.push({name: "นนทบุรี", y: nonSeries});
        $scope.pieOptions1.series[0].data.push({name: "อื่นๆ", y: othSeries});
        var chart = new Highcharts.Chart($scope.pieOptions1);

        $scope.pieOptions2 = ReportService.initPieChart("pieContainer2", "รายงานการให้บริการ รายพื้นที่อำเภอ");
        $scope.pieOptions2.series[0].data.push({name: 'อ.เมือง', y: dmSeries});
        $scope.pieOptions2.series[0].data.push({name: "ต่าง อ.", y: notdmSeries});

        console.log('อ.เมือง=' + dmSeries + ', ต่าง อ.=' + notdmSeries)
        var chart = new Highcharts.Chart($scope.pieOptions2);
    }
});