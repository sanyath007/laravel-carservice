app.service('ReportService', function($http) {
	this.getServiceData = function () {
		return $http.get('http://localhost/carservice/public/report/service-chart');
	}

	this.getPeriodData = function () {
		return $http.get('http://localhost/carservice/public/report/period-chart');
	}

	this.getDepartData = function () {
		return $http.get('http://localhost/carservice/public/report/depart-chart');
	}
});