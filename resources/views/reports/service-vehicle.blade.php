@extends('layouts.main')

@section('content')

<div class="container-fluid" ng-controller="reportCtrl" ng-init="getServiceVehicleData({{ json_encode($data) }})">
  
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
        <li class="breadcrumb-item"><a href="#">รายงาน</a></li>
        <li class="breadcrumb-item active">รายงานการให้บริการ รายรถ</li>
    </ol>

    <!-- page title -->
    <div class="page__title">
        <span>
            <i class="fa fa-calendar" aria-hidden="true"></i> รายงานการให้บริการ รายรถ
        </span>
    </div>

    <hr />
    <!-- page title -->

    <div class="row">
        <div class="col-md-12">
            <form action="{{ url('/report/service-vehicle') }}" method="GET" class="form-inline">
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

                            @foreach($vehicles as $vehicle)

                                <th class="text-center">{{ $vehicle->reg_no }}</th>

                            @endforeach

                        </tr>
                    </thead>
                    <tbody>
                        <tr>

                            @foreach($vehicles as $vehicle)

                                <?php $dataIndex = array_search($vehicle->vehicle_id, array_column($data, 'vehicle_id')); ?>

                                @if($dataIndex !== false)
                                    <td class="text-center">
                                        <a href="{{ url('/reserve/') }}">
                                            {{ $data[$dataIndex]['vehicle_count'] }}
                                        </a>
                                    </td>
                                @else 
                                    <td class="text-center"></td>
                                @endif

                            @endforeach 
                        </tr>
                    </tbody>
                </table>

            

            <div id="pieContainer" style="width: 800px; height: 500px; margin: 0 auto; margin-top: 20px;"></div>

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
