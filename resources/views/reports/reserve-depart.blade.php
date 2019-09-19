@extends('layouts.main')

@section('content')

    <div class="container-fluid" ng-controller="reserveCtrl">
      
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
            <li class="breadcrumb-item active">รายงานการการให้บริการ รายหน่วยงาน</li>
        </ol>

        <!-- page title -->
        <div class="page__title">
            <span>
                <i class="fa fa-calendar" aria-hidden="true"></i> รายงานการการให้บริการ รายหน่วยงาน
            </span>
        </div>

        <hr />
        <!-- page title -->

        <div class="row">
            <div class="col-md-12">
                <form action="{{ url('/report/reserve-depart') }}" method="GET" class="form-inline">
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
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th style="width: 3%; text-align: center;">#</th>
                            <th style="width: 6%; text-align: center;">รหัสหน่วยงาน</th>
                            <th>หน่วยงาน</th>
                            <th style="width: 12%; text-align: center;">จำนวนที่ขอ</th>
                        </tr>
                        <?php $cx = 0; ?>
                        @foreach($reserves as $reservation)
                        <tr>
                            <td style="text-align: center;">            
                                {{ ++$cx }}
                            </td>
                            <td style="text-align: center;">            
                                {{ $reservation->ward }}
                            </td>                        
                            <td style="text-align: left;">
                                {{ $reservation->ward_name }}
                            </td>
                            <td style="text-align: center;">
                                {{ $reservation->total }} 
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <!-- right column -->
        </div><!-- /.row -->

    </div><!-- /.container -->

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

@endsection
