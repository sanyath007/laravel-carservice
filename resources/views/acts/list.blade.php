@extends('layouts.main')

@section('content')
<div class="container-fluid" ng-controller="reserveCtrl">
  
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
        <li class="breadcrumb-item active">รายการต่อ พรบ.</li>
    </ol>

    <!-- page title -->
    <div class="page__title">
        <span>
            <i class="fa fa-calendar" aria-hidden="true"></i> รายการต่อ พรบ.
        </span>
        <a href="{{ url('/act/new') }}" class="btn btn-primary pull-right">
            <i class="fa fa-plus" aria-hidden="true"></i>
            เพิ่มรายการ
        </a>
    </div>

    <hr />
    <!-- page title -->

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th style="width: 4%; text-align: center;">#</th>
                        <th style="width: 15%; text-align: center;">รถ</th>
                        <th style="width: 10%; text-align: center;">เลขที่กรมธรรม์</th>
                        <th style="width: 12%; text-align: center;">บริษัท</th>
                        <th style="width: 15%; text-align: center;">ระยะเวลาประกัน</th>
                        <th style="width: 6%; text-align: center;">ค่าเบี้ย พรบ.</th>
                        <th style="width: 10%; text-align: center;">Actions</th>
                    </tr>
                    @foreach($acts as $act)
                        <?php $vehicle = App\Vehicle::where(['vehicle_id' => $act->vehicle_id])->with('changwat')->first();
                        ?>
                    <tr>
                        <td style="text-align: center;">
                            <h4><span class="label label-<?= (($act->status == '1') ? 'success' : (($act->status == '0') ? 'default' : 'danger')) ?>">
                                ACT60-{{ $act->id }}
                            </span></h4>
                        </td>                        
                        <td style="text-align: center;">
                            {{ $act->vehicle->reg_no }}
                        </td>
                        <td style="text-align: center;">{{ $act->act_no }}</td>
                        <td style="text-align: center;">
                            {{ $act->company->insurance_company_name }}
                        </td>
                        <td style="text-align: center;">
                            {{ $act->act_start_date }} - {{ $act->act_renewal_date }}
                        </td>
                        <td style="text-align: right;">
                            {{ number_format($act->act_total,2) }}
                        </td>
                        <td style="text-align: center;">
                            <a  href="{{ url('/reserve/edit/' . $act->id) }}" 
                                class="btn btn-warning btn-xs">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>

                            @if ($act->status != '3')
                                <a  href="{{ url('/reserve/cancel/' . $act->id) }}" 
                                    ng-click="cancel($event)"
                                    class="btn btn-primary btn-xs">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </a>

                                <form id="cancel-form" action="{{ url('/reserve/cancel/' . $act->id) }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                </form>
                            @endif

                            @if (Auth::user()->person_id == '1300200009261')
                                @if ($act->status == '3')
                                    <a  href="{{ url('/reserve/return/' . $act->id) }}" 
                                        ng-click="return($event)"
                                        class="btn btn-default btn-xs">
                                        <i class="fa fa-retweet" aria-hidden="true"></i>
                                    </a>

                                    <form id="return-form" action="{{ url('/reserve/return/' . $act->id) }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                    </form>
                                @endif

                                <a  href="{{ url('/reserve/delete/' . $act->id) }}" 
                                    ng-click="delete($event)"
                                    class="btn btn-danger btn-xs">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>

                                <form id="delete-form" action="{{ url('/reserve/delete/' . $act->id) }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            
            <ul class="pagination">
                @if($acts->currentPage() !== 1)
                    <li>
                        <a href="{{ $acts->url($acts->url(1)) }}" aria-label="Previous">
                            <span aria-hidden="true">First</span>
                        </a>
                    </li>
                @endif
                
                @for($i=1; $i<=$acts->lastPage(); $i++)
                    <li class="{{ ($acts->currentPage() === $i) ? 'active' : '' }}">
                        <a href="{{ $acts->url($i) }}">
                            {{ $i }}
                        </a>
                    </li>
                @endfor

                @if($acts->currentPage() !== $acts->lastPage())
                    <li>
                        <a href="{{ $acts->url($acts->lastPage()) }}" aria-label="Previous">
                            <span aria-hidden="true">Last</span>
                        </a>
                    </li>
                @endif
            </ul>

        </div>
        <!-- right column -->
    </div><!-- /.row -->
    
    <!-- Modal -->
    <div class="modal fade" id="dlgPassengers" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="">รายชื่อผู้ร่วมเดินทาง</h4>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 4%; text-align: center;">#</th>
                                    <th style="width: 8%; text-align: center;">CID</th>
                                    <th>ชื่อ-สกุล</th>
                                    <th style="width: 30%; text-align: center;">ตำแหน่ง</th>
                                    <!-- <th style="width: 30%; text-align: center;">สังกัด</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="(index, passenger) in passengers">
                                    <td>@{{ index + 1 }}</td>
                                    <td>@{{ passenger.id }}</td>
                                    <td>@{{ passenger.name  }}</td>
                                    <td>@{{ passenger.position  }}</td>
                                    <!-- <td></td> -->
                                </tr>
                            </tbody>
                        </table>
                    </div>           
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->   

    <!-- The actual modal template, just a bit o bootstrap -->
    <script type="text/ng-template" id="modal.html">
        <div class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="">เพิ่มบุคลากร</h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10%; text-align: center;">CID</th>
                                        <th>ชื่อ-สกุล</th>
                                        <th style="width: 20%; text-align: center;">ตำแหน่ง</th>
                                        <th style="width: 30%; text-align: center;">สังกัด</th>
                                        <th style="width: 10%; text-align: center;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="passenger in passengers">
                                        <td>@{{ passenger.person_id }}</td>
                                        <td>@{{ passenger.user }}</td>
                                        <td>@{{ passenger.user }}</td>
                                        <td>@{{ passenger.user }}</td>
                                        <td>@{{ passenger.user }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </script>

</div><!-- /.container -->
@endsection
