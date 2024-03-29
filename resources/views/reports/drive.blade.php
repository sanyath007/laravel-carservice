@extends('layouts.main')

@section('content')
<div class="container-fluid" ng-controller="assignCtrl">
  
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
        <li class="breadcrumb-item active">รายงานการเดินรถ</li>
    </ol>

    <!-- page title -->
    <div class="page__title">
        <span>
            <i class="fa fa-calendar" aria-hidden="true"></i> รายงานการเดินรถ
        </span>
    </div>

    <hr />
    <!-- page title -->

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th style="width: 4%; text-align: center;">#</th>
                        <th style="width: 12%; text-align: center;">วันเดินทาง</th>
                        <th>รายละเอียดการขอใช้รถ</th>
                        <th style="width: 8%; text-align: center;">รถทะเบียน</th>
                        <th style="width: 12%; text-align: center;">พขร.</th>
                    </tr>

                    @foreach($assignments as $assignment)
                        <?php $vehicle = App\Models\Vehicle::where(['vehicle_id' => $assignment->vehicle_id])->with('changwat')->first();
                        ?>

                        <?php $driver = App\Models\Driver::where(['driver_id' => $assignment->driver_id])->with('person')->first();
                        ?>
                    <tr>
                        <td style="text-align: center;">
                            <h4><span class="label label-<?= (($assignment->approved == '1') ? 'success' : (($assignment->approved == '0') ? 'default' : 'danger')) ?>">
                                ASS60-{{ $assignment->id }}
                            </span></h4>
                        </td>
                        <td style="text-align: center;">
                            {{ $assignment->depart_date }} {{ $assignment->depart_time }}
                        </td>
                        <td style="text-align: left;">
                            @foreach($assignment->assignreserve as $reserve)
                                <?php $reservation = App\Models\Reservation::where(['id' => $reserve->reserve_id])->with('user')->first();
                                ?>

                                <?php
                                    $locationIds = [];
                                    $locationList = '';
                                    $locationIds = explode(",", $reservation->location);
                                    $locations = App\Models\Location::where('id','<>','1')
                                                    ->pluck('name','id')->toArray();
                                    // print_r($locations);
                                    $locationList = '<ul class="tag__list">';
                                    foreach ($locationIds as $key => $value) {
                                        if (!empty($value)) {                                    
                                            $locationList .= '                                        
                                                    <li>
                                                        <h5><span class="label label-info">' .$locations[$value]. '</span></h5>
                                                    </li>';
                                        }
                                    }
                                    $locationList .= '</ul>';
                                ?>

                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <span class="label label-primary">
                                            {{ $reservation->id }}
                                        </span> 
                                        <b>ไปราชการ</b> {{ $reservation->activity }}
                                        <span class="label label-{{ ($assignment->status=='1') ? 'success' : 'danger' }}">
                                            {{ ($assignment->status=='1') ? 'เที่ยวเดียว' : 'รอไปรับ/ส่ง' }}
                                        </span>

                                        <span class="label label-{{ ($reserve->times=='1') ? 'warning' : 'success' }}" ng-show="{{ ($reservation->transport == 5) ? true : false }}">
                                            {{ ($reserve->times=='1') ? 'เที่ยวไป' : 'เที่ยวกลับ' }}
                                        </span><br>

                                        <b>ณ</b> <?= $locationList ?><br>
                                        <b>วันเวลาไป-กลับ</b> {{ $reservation->from_date }} {{ $reservation->from_time }} - {{ $reservation->to_date }} {{ $reservation->to_time }}<br>                      
                                        <b>จำนวนผู้โดยสาร</b> <a ng-click="showPassengers($event, {{ $reservation->id }})" class="btn btn-primary btn-xs">
                                            {{ $reservation->passengers }}
                                        </a> ราย ( <b>ผู้ขอ</b> {{ $reservation->user->person_firstname. ' ' .$reservation->user->person_lastname. ' / ' .$reservation->user->person_tel }} )
                                    </li>
                                </ul>
                            @endforeach
                        </td>
                        <td style="text-align: center;">
                            <?= (($vehicle) ? $vehicle->reg_no. ' ' .$vehicle->changwat->short : ''); ?>
                        </td>
                        <td style="text-align: center;">
                            <?= (($driver) ? $driver->description : ''); ?>
                            <div class="desc" ng-show="{{ ($assignment->start_time) ? true : false }}">
                                <p>เวลาออก {{ $assignment->start_time }}</p>
                                <p>เวลาถึง {{ $assignment->end_time }}</p>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            
            <ul class="pagination">
                @if($assignments->currentPage() !== 1)
                    <li>
                        <a href="{{ $assignments->url($assignments->url(1)) }}" aria-label="Previous">
                            <span aria-hidden="true">First</span>
                        </a>
                    </li>
                @endif

                <li class="{{ ($assignments->currentPage() === 1) ? 'disabled' : '' }}">
                    <a href="{{ $assignments->url($assignments->currentPage() - 1) }}" aria-label="Prev">
                        <span aria-hidden="true">Prev</span>
                    </a>
                </li>
                
                @for($i=$assignments->currentPage(); $i < $assignments->currentPage() + 10; $i++)
                    @if ($assignments->currentPage() <= $assignments->lastPage() && ($assignments->lastPage() - $assignments->currentPage()) > 10)
                        <li class="{{ ($assignments->currentPage() === $i) ? 'active' : '' }}">
                            <a href="{{ $assignments->url($i) }}">
                                {{ $i }}
                            </a>
                        </li> 
                    @else
                        @if ($i <= $assignments->lastPage())
                            <li class="{{ ($assignments->currentPage() === $i) ? 'active' : '' }}">
                                <a href="{{ $assignments->url($i) }}">
                                    {{ $i }}
                                </a>
                            </li>
                        @endif
                    @endif
                @endfor

                <li class="{{ ($assignments->currentPage() === $assignments->lastPage()) ? 'disabled' : '' }}">
                    <a href="{{ $assignments->url($assignments->currentPage() + 1) }}" aria-label="Next">
                        <span aria-hidden="true">Next</span>
                    </a>
                </li>

                @if($assignments->currentPage() !== $assignments->lastPage())
                    <li>
                        <a href="{{ $assignments->url($assignments->lastPage()) }}" aria-label="Previous">
                            <span aria-hidden="true">Last</span>
                        </a>
                    </li>
                @endif
            </ul>

        </div>
        <!-- right column -->
    </div><!-- /.row -->
    
    <script>
        $(document).ready(function($) {
            var dateNow = new Date();
            
            $('#_date').datetimepicker({
                useCurrent: true,
                format: 'YYYY-MM-DD',
                defaultDate: moment(dateNow)
            })
            // .on("dp.change", function(e) {
            //     $('#to_date').data('DateTimePicker').date(e.date);
            // });

            $('#_time').datetimepicker({
                useCurrent: true,
                format: 'HH:mm',
                defaultDate: moment(dateNow).hours(8).minutes(0).seconds(0).milliseconds(0) 
            });
        });
    </script>
</div><!-- /.container -->
@endsection
