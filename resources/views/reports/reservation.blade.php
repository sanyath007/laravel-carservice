@extends('layouts.main')

@section('content')
<div class="container-fluid" ng-controller="reserveCtrl">
  
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
        <li class="breadcrumb-item active">รายงานการขอใช้รถ</li>
    </ol>

    <!-- page title -->
    <div class="page__title">
        <span>
            <i class="fa fa-calendar" aria-hidden="true"></i> รายงานการขอใช้รถ
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
                        <th style="width: 10%; text-align: center;">วันที่ขอ</th>
                        <th style="width: 15%; text-align: center;">วันเวลา ไป-กลับ</th>
                        <th style="width: 12%; text-align: center;">ผู้ขอ</th>
                        <th style="width: 15%; text-align: center;">ไปราชการ</th>
                        <th>สถานที่ไป</th>
                        <th style="width: 6%; text-align: center;">ผู้ร่วมเดินทาง</th>
                        <th style="width: 8%; text-align: center;">รถทะเบียน</th>
                        <th style="width: 12%; text-align: center;">พขร.</th>
                        <th style="width: 12%; text-align: center;">สถานะ</th>
                    </tr>
                    @foreach($reservations as $reservation)
                        <?php 
                            $reserveStatus = [
                                'ยังไม่เปิดดู',
                                'รับเรื่องแล้ว',
                                'อนุมัติแล้ว',
                                'เหลืออีกเที่ยว',
                                'จบงาน',
                                'ยกเลิก'
                            ];
                            $vehicle = App\Models\Vehicle::where(['vehicle_id' => $reservation->vehicle_id])->with('changwat')->first();
                            $driver = App\Models\Driver::where(['driver_id' => $reservation->driver_id])->with('person')->first();
                        ?>

                        <?php
                            $locationIds = [];
                            $locationIds = explode(",", $reservation->location);
                            $locations = App\Models\Location::where('id','<>','1')
                                            ->pluck('name','id')->toArray();

                            $locationList = '<ul class="tag__list">';
                            foreach ($locationIds as $key => $value) {
                                if (!empty($value)) {                                    
                                    $locationList .= '                                        
                                            <li>
                                                <span class="label label-info">' .$locations[$value]. '</span>
                                            </li>';
                                }
                            }
                            $locationList .= '</ul>';                         
                        ?>
                    <tr>
                        <td style="text-align: center;">
                            <h4><span class="label label-<?= (($reservation->approved == '1') ? 'success' : (($reservation->approved == '0') ? 'default' : 'danger')) ?>">
                                REV60-{{ $reservation->id }}
                            </span></h4>
                        </td>                        
                        <td style="text-align: center;">
                            {{ $reservation->reserve_date }}
                        </td>
                        <td style="text-align: center;">
                            {{ $reservation->from_date }} {{ $reservation->from_time }}<br>
                            {{ $reservation->to_date }} {{ $reservation->to_time }}
                        </td>
                        <td style="text-align: center;">
                            <?= (($reservation->user) ? $reservation->user->person_firstname. ' ' .$reservation->user->person_lastname : ''); ?>
                        </td>
                        <td>
                            {{ $reservation->activity }}
                        </td>
                        <td>
                            <div><?= $locationList ?></div>
                        </td>
                        <td style="text-align: center;">
                            <a class="btn btn-success btn-xs" ng-click="showPassengers($event, {{ $reservation->id }})">
                                {{ $reservation->passengers }}
                            </a>
                        </td>
                        <td style="text-align: center;">
                            <?= (($vehicle) ? $vehicle->reg_no. ' ' .$vehicle->changwat->short : ''); ?>
                        </td>
                        <td style="text-align: center;">
                            <?= (($driver) ? $driver->description. ' / ' .$driver->tel : ''); ?>
                        </td>
                        <td style="text-align: center;">
                            <?= $reserveStatus[$reservation->status]; ?>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            
            <ul class="pagination">
                @if($reservations->currentPage() !== 1)
                    <li>
                        <a href="{{ $reservations->url($reservations->url(1)) }}" aria-label="First">
                            <span aria-hidden="true">First</span>
                        </a>
                    </li>
                @endif

                <li class="{{ ($reservations->currentPage() === 1) ? 'disabled' : '' }}">
                    <a href="{{ $reservations->url($reservations->currentPage() - 1) }}" aria-label="Prev">
                        <span aria-hidden="true">Prev</span>
                    </a>
                </li>
                
                @for($i=$reservations->currentPage(); $i < $reservations->currentPage() + 10; $i++)
                    @if ($reservations->currentPage() <= $reservations->lastPage() && ($reservations->lastPage() - $reservations->currentPage()) > 10)
                        <li class="{{ ($reservations->currentPage() === $i) ? 'active' : '' }}">
                            <a href="{{ $reservations->url($i) }}">
                                {{ $i }}
                            </a>
                        </li> 
                    @else
                        @if ($i <= $reservations->lastPage())
                            <li class="{{ ($reservations->currentPage() === $i) ? 'active' : '' }}">
                                <a href="{{ $reservations->url($i) }}">
                                    {{ $i }}
                                </a>
                            </li>
                        @endif
                    @endif
                @endfor
                
                @if ($reservations->currentPage() < $reservations->lastPage() && ($reservations->lastPage() - $reservations->currentPage()) > 10)
                    <li>
                        <a href="{{ $reservations->url($reservations->currentPage() + 10) }}">
                            ...
                        </a>
                    </li>
                @endif
                
                <li class="{{ ($reservations->currentPage() === $reservations->lastPage()) ? 'disabled' : '' }}">
                    <a href="{{ $reservations->url($reservations->currentPage() + 1) }}" aria-label="Next">
                        <span aria-hidden="true">Next</span>
                    </a>
                </li>

                @if($reservations->currentPage() !== $reservations->lastPage())
                    <li>
                        <a href="{{ $reservations->url($reservations->lastPage()) }}" aria-label="Last">
                            <span aria-hidden="true">Last</span>
                        </a>
                    </li>
                @endif
            </ul>

        </div>
        <!-- right column -->
    </div><!-- /.row -->

</div><!-- /.container -->
@endsection
