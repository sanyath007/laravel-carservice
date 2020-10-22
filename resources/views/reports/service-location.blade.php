@extends('layouts.main')

@section('content')

<div class="container-fluid" ng-controller="reportCtrl" ng-init="getServiceLocationData({{ json_encode($locations) }})">
  
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
        <li class="breadcrumb-item"><a href="#">รายงาน</a></li>
        <li class="breadcrumb-item active">รายงานการให้บริการ รายพื้นที่</li>
    </ol>

    <!-- page title -->
    <div class="page__title">
        <span>
            <i class="fa fa-calendar" aria-hidden="true"></i> รายงานการให้บริการ รายพื้นที่
        </span>
    </div>

    <hr />
    <!-- page title -->

    <div class="row">
        <div class="col-md-12">
            <form action="{{ url('/report/service-location') }}" method="GET" class="form-inline">
                <div class="form-group">
                    <label>เดือน :</label>
                    <input id="selectMonth" name="selectMonth" value="{{ $month }}" class="form-control"></input>
                </div>

                <button type="submit" class="btn btn-primary">แสดง</button>
            </form>
        </div>
        <!-- right column -->
    </div><!-- /.row -->

    <br>

    <div class="row">
        <div class="col-md-12">

            

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>

                            <th class="text-center" style="width: 4%">รหัส</th>
                            <th class="text-center">สถานที่</th>
                            <th class="text-center" style="width: 10%">อำเภอ</th>
                            <th class="text-center" style="width: 10%">จังหวัด</th>
                            <th class="text-center" style="width: 8%">จำนวนที่ให้บริการ (ครั้ง)</th>
    
                        </tr>
                    </thead>
                    <tbody>
                        <?php $index = 0; ?>
                        @foreach($locations as $location)
                            @if($index < 10)
                                <tr>                            
                                    <td class="text-center">{{ ++$index }}</td>
                                    <td>{{ $location['name'] }}</td>
                                    <td class="text-center">{{ $location['amphur'] }}</td>
                                    <td class="text-center">{{ $location['changwat'] }}</td>
                                    <td class="text-right">{{ $location['count'] }}</td>
                                </tr>
                            @endif
                        @endforeach 

                        <tr>                            
                            <td class="text-center" colspan="5">
                                <a href="">
                                    more ...
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>

            
            <div class="col-md-6">
                <div id="pieContainer1" style="width: 100%; height: 400px; margin: 0; margin-top: 20px;"></div>
            </div>
            <div class="col-md-6">
                <div id="pieContainer2" style="width: 100%; height: 400px; margin: 0; margin-top: 20px;"></div>
            </div>

        </div><!-- col-md-12 -->
    </div><!-- /.row --> 
    
    <script>
        $(document).ready(function($) {
            var dateNow = new Date();
            
            $('#selectMonth').datetimepicker({
                useCurrent: true,
                format: 'YYYY-MM',
                defaultDate: moment(dateNow)
            });
            // .on("dp.change", function(e) {
            //     $('#to_date').data('DateTimePicker').date(e.date);
            // });
        });
    </script>

</div><!-- /.container -->

@endsection
