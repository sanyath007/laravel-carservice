app.controller('reportCtrl', function(CONFIG, $scope, limitToFilter, $scope, ReportService) {
/** ################################################################################## */
    console.log(CONFIG.BASE_URL);
    let baseUrl = CONFIG.BASE_URL;
    
    $scope.pieOptions = {};
    $scope.initPieChart = function(_container, _title) {
        $scope.pieOptions = {
            chart: {
                renderTo: _container,
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: _title
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>',
                percentageDecimals: 1
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'สัดส่วนการให้บริการ',
                data: []
            }]
        };
    };

    $scope.barOptions = {};
    $scope.initBarChart = function(_container, _title, _categories) {
        $scope.barOptions = {
            chart: {
                renderTo: _container,
                type: 'column'
            },
            title: {
                text: _title
            },
            xAxis: {
                categories: _categories
            },
            series: []
        };
    };

    $scope.getServiceData = function () {
        ReportService.getServiceData()
        .then(function(res) {
            var requestSeries = [];
            var serviceSeries = [];
            var cancelSeries = [];

            angular.forEach(res.data, function(value, key) {
                requestSeries.push(value.request);
                serviceSeries.push(value.service);
                cancelSeries.push(value.cancel);
            });

            var categories = ['ตค', 'พย', 'ธค', 'มค', 'กพ', 'มีค', 'เมย', 'พค', 'มิย', 'กค', 'สค', 'กย']
            $scope.initBarChart("barContainer", "รายงานการให้บริการทั้งหมด", categories);
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
        ReportService.getPeriodData()
        .then(function(res) {
            console.log(res);
            var nSeries = [];
            var mSeries = [];
            var aSeries = [];
            var eSeries = [];

            angular.forEach(res.data, function(value, key) {
                nSeries.push(value.n);
                mSeries.push(value.m);
                aSeries.push(value.a);
                eSeries.push(value.e);
            });

            var categories = ['ตค', 'พย', 'ธค', 'มค', 'กพ', 'มีค', 'เมย', 'พค', 'มิย', 'กค', 'สค', 'กย']
            $scope.initBarChart("barContainer", "รายงานการให้บริการ ตามช่วงเวลา", categories);
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
        ReportService.getDepartData()
        .then(function(res) {
            console.log(res);
            var dataSeries = [];

            $scope.initPieChart("pieContainer", "รายงานการให้บริการ ตามหน่วยงาน");
            angular.forEach(res.data, function(value, key) {
                $scope.pieOptions.series[0].data.push({name: value.depart, y: value.request});
            });

            var chart = new Highcharts.Chart($scope.pieOptions);
        }, function(err) {
            console.log(err);
        });
    };

    $scope.getReferData = function () {
        ReportService.getReferData()
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

            $scope.initBarChart("barContainer", "รายงานการให้บริการให้บริการรับ-ส่งต่อผู้ป่วย", categories);
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
});