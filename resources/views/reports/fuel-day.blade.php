@extends('layouts.main')

@section('content')
<div class="container-fluid" ng-controller="reportCtrl" ng-init="getFuelDayData()">
  
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
        <li class="breadcrumb-item"><a href="#">รายงาน</a></li>
        <li class="breadcrumb-item active">รายงานการใช้น้ำมันรวม รายเดือน</li>
    </ol>

    <!-- page title -->
    <div class="page__title">
        <span>
            <i class="fa fa-calendar" aria-hidden="true"></i> รายงานการใช้น้ำมันรวม รายเดือน
        </span>
    </div>

    <hr />
    <!-- page title -->

    <div class="row">
        <div class="col-md-12">
            <form class="form-inline">
                <div class="form-group">
                    <label>ปีงบประมาณ :</label>
                    <input id="selectMonth" name="selectMonth" class="form-control" autocomplete="off">
                </div>

                <button ng-click="getFuelDayData()" class="btn btn-primary">แสดง</button>
            </form>

            <div id="barContainer" style="width: 800px; height: 400px; margin: 0 auto; margin-top: 20px;"></div>

        </div><!-- col-md-12 -->
    </div><!-- /.row --> 
    
    <script>
        $(document).ready(function($) {
            var dateNow = new Date();
            
            $('#selectMonth').datetimepicker({
                useCurrent: true,
                format: 'YYYY',
                defaultDate: moment(dateNow)
            })
            // .on("dp.change", function(e) {
            //     $('#to_date').data('DateTimePicker').date(e.date);
            // });
        });
    </script>
</div><!-- /.container -->
@endsection
