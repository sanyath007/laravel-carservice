app.controller('mainCtrl', function($scope, $http, toaster, ModalService, CONFIG) {
/** ################################################################################## */
    console.log(CONFIG.BASE_URL);
    let baseUrl = CONFIG.BASE_URL;
/** ################################################################################## */
    // $scope.selectText = function(form) {
    //     var input = form.$editables[0].inputEl;
    //     input.select();
    // }

    // $scope.updateQty = function(data) {
    //     $scope.orderList.qty = data;
    // }

    // $scope.updateDisc = function(data) {
    //     $scope.orderList.disc = data;
    // }

    // $scope.popover=null;
    // $scope.showEditable = function($event) {
    //   $scope.popover = $event.currentTarget;
    //   let target = $event.target;
    //   $($scope.popover).popover({
    //     html : true,
    //     title: function() {
    //       return $("#popover-head").html();
    //     },
    //     content: function() {
    //       return $("#popover-content").html();
    //     }
    //   });
    //
    //   $($scope.popover).popover("toggle");
    // }
    //
    // $scope.hideEditable = function($event) {
    //   let target = $event.target;
    //   $($scope.popover).popover("hide");
    //   $($scope.popover).on('hidden.bs.popover', function () {
    //     target.text('1');
    //   })
    //   $scope.popover=null;
    // }

/** ################################################################################## */
    // Calendar variables
    $scope.today = moment().format('YYYY-MM-DD');
    $scope.fdMonth = moment().format('YYYY-01-01');
    $scope.ldMonth = moment().format('YYYY-12-31');
    // $scope.ldMonth = moment($scope.fdMonth).endOf('month').format('YYYY-MM-DD');
    $scope.events = [];

    $scope.initCalendar = function ($scope) {
        console.log(this.today);
        var callback = this.showEvent;

        $http.get(baseUrl + '/reserve/ajaxcalendar/' + this.fdMonth + '/' + this.ldMonth)
        .then(function (data) {
            this.events = data.data;
            console.log(this.events);

            $('#calendar').fullCalendar({
                locale: 'th',
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },
                defaultDate: this.today,
                navLinks: true, // can click day/week names to navigate views
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                events: this.events,
                eventClick: callback,
                dayClick: function (date) {
                    console.log(date)
                }
            });
        });
    }

    $scope.showEvent = function (event) {
        alert(event.title);
    }

/** ################################################################################## */
    //################## autocomplete ##################
    $scope.maintenanceList = [];
    $scope.fillinMaintenanceList = function(event) {
        console.log(event.keyCode);
        if (event.which === 13) {
            event.preventDefault();
            $scope.maintenanceList.push($(event.target).val());

            //เคลียร์ค่าใน text searchProduct
            $(event.target).val('');

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
    }

    // ลบรายการ
    $scope.removeMaintenanceList = function(m) {
        let index = $scope.maintenanceList.indexOf(m);
        $scope.maintenanceList.splice(index, 1);
    }

    $scope.calculateMaintainedVatnet = function (event) {
        var tmpVat = $(event.target).val();
        var tmpAmt = $('#amt').val();
        var tmpVatnet = parseFloat((tmpAmt * tmpVat) / 100);
        var tmpTotal = parseFloat(tmpAmt) + parseFloat(tmpVatnet);
        $('#total').val(tmpTotal);
        $('#vatnet').val(tmpVatnet);
        console.log(tmpTotal);
    }
/** ################################################################################## */
    $scope.passengers = [];
    $scope.showPassengers = function (event, reserveid) {
        $http.get(baseUrl + '/ajaxpassenger/' + reserveid + '/0')
        .then(function (data) {
            $scope.passengers = data.data[1];
            console.log($scope.passengers);

            $('#dlgPassengers').modal('show')
            
            //     ModalService.showModal({
            //         templateUrl: "modal.html",
            //         controller: "ModalController"
            //     }).then(function(modal) {
            //         //it's a bootstrap element, use 'modal' to show it
            //         modal.element.modal();
            //         modal.close.then(function(result) {
            //             console.log(result);
            //         });                
            //     });
        });
    }
/** ################################################################################## */
});
