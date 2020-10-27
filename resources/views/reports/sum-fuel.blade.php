@extends('layouts.main')

@section('content')

<div class="container-fluid" ng-controller="reportCtrl" ng-init="getSumFuelData({{ json_encode($data) }})">
  
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
        <li class="breadcrumb-item"><a href="#">รายงาน</a></li>
        <li class="breadcrumb-item active">สรุปยอดค่าใช้จ่ายน้ำมันเชื้อเพลิง</li>
    </ol>

    <!-- page title -->
    <div class="page__title">
        <span>
            <i class="fa fa-calendar" aria-hidden="true"></i> สรุปยอดค่าใช้จ่ายน้ำมันเชื้อเพลิง
        </span>
    </div>

    <hr />
    <!-- page title -->

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <form action="{{ url('/report/sum-fuel') }}" method="GET" class="form-inline">
                <div class="form-group">
                    <label>ปีงบประมาณ :</label>
                    <input id="selectMonth" name="selectMonth" value="{{ $year }}" class="form-control" autocomplete="off">
                </div>

                <button type="submit" class="btn btn-primary">แสดง</button>
            </form>
        </div>
        <!-- right column -->
    </div><!-- /.row -->

    <br>

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">

            @foreach($data as $fuel) 

                <?php $diff = (float)((float)$budget->fuel - (float)($fuel->total)); ?>

                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center">รถพยาบาล</th>
                        <th class="text-center">รถทั่วไป</th>
                        <th class="text-center">รถใช้ภายใน</th>
                        <th class="text-center">เครื่องตัดหญ้า</th>
                        <th class="text-center">เครื่องปั่นไฟ</th>
                        <th class="text-center">รวมทั้งสิ้น</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-center">{{ number_format($fuel->ambu, 2) }}</td>
                        <td class="text-center">{{ number_format($fuel->gen, 2) }}</td>
                        <td class="text-center">{{ number_format($fuel->inter, 2) }}</td>
                        <td class="text-center">{{ number_format($fuel->glass, 2) }}</td>
                        <td class="text-center">{{ number_format($fuel->elec, 2) }}</td>
                        <td class="text-right">{{ number_format($fuel->total, 2) }}</td>
                    </tr>
                    <tr>
                        <td class="text-right" colspan="5">งบประมาณประจำปี</td>
                        <td class="text-right">{{ number_format($budget->fuel, 2) }}</td>
                    </tr>
                    <tr>
                        <td class="text-right" colspan="5">คงเหลือ</td>
                        <td class="text-right" style="font-weight: bold; text-decoration: underline; <?=($diff < 1) ? 'color: red;' : 'color: green;'; ?>">                            
                            {{ number_format($diff, 2) }}
                        </td>
                    </tr>
                    </tbody>
                </table>

            @endforeach

            <div id="pieContainer" style="width: 800px; height: 500px; margin: 0 auto; margin-top: 20px;"></div>

        </div><!-- col-md-12 -->
    </div><!-- /.row --> 
    
    <script>
        $(document).ready(function($) {
            var dateNow = new Date();
            
            $('#selectMonth').datetimepicker({
                useCurrent: true,
                format: 'YYYY',
                defaultDate: moment(dateNow)
            });
            // .on("dp.change", function(e) {
            //     $('#to_date').data('DateTimePicker').date(e.date);
            // });
        });
    </script>

</div><!-- /.container -->

@endsection
