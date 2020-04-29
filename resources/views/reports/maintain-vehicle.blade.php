@extends('layouts.main')

@section('content')
<div class="container-fluid" ng-controller="reportCtrl" ng-init="getMaintainVehicleData()">
  
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
        <li class="breadcrumb-item"><a href="#">รายงาน</a></li>
        <li class="breadcrumb-item active">รายงานการซ่อมรถยนต์ รายรถ</li>
    </ol>

    <!-- page title -->
    <div class="page__title">
        <span>
            <i class="fa fa-calendar" aria-hidden="true"></i> รายงานการซ่อมรถยนต์ รายรถ
        </span>
    </div>

    <hr />
    <!-- page title -->

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <form class="form-inline">
                <div class="form-group">
                    <label>ปีงบประมาณ :</label>
                    <input id="selectMonth" name="selectMonth" value="{{ $year }}" class="form-control"></input>
                </div>

                <button ng-click="getMaintainVehicleData()" class="btn btn-primary">แสดง</button>
            </form>

            <div id="barContainer" style="width: 800px; height: 520px; margin: 0 auto; margin-top: 20px;"></div>

        </div><!-- right column -->
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
