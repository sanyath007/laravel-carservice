@extends('layouts.main')

@section('content')
<div class="container-fluid" ng-controller="fuelCtrl">
  
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">หน้าหลัก</a></li>
        <li class="breadcrumb-item active">รายการใช้น้ำมันเชื้อเพลิง</li>
    </ol>

    <!-- page title -->
    <div class="page__title">
        <span>
            <i class="fa fa-calendar" aria-hidden="true"></i> รายการใช้น้ำมันเชื้อเพลิง
        </span>
        <a href="{{ url('/fuel/new') }}" class="btn btn-primary pull-right">
            <i class="fa fa-plus" aria-hidden="true"></i>
            เพิ่มรายการ
        </a>
    </div>

    <hr />
    <!-- page title -->

    <div class="row">
        <div class="col-md-12">
            <form id="frm_search" action="{{ url('daily/received/list') }}" method="GET" class="form-inline">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="">ประจำเดือน :</label>
                    <input  type="text" 
                            id="_month" 
                            name="_month" 
                            value="" 
                            class="form-control"
                            style="text-align: center; width: 150px;">
                </div>
            </form><br>

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th style="width: 2%; text-align: center;">#</th>
                        <th style="width: 8%; text-align: center;">วันที่บิล</th>
                        <th style="width: 10%; text-align: center;">รถ</th>
                        <th style="width: 10%; text-align: center;">เลขที่บิล</th>
                        <th style="width: 10%; text-align: center;">ประเภทน้ำมัน</th>
                        <th style="width: 8%; text-align: center;">จำนวนลิตร</th>
                        <th style="width: 8%; text-align: center;">ราคา/ลิตร</th>
                        <th style="width: 10%; text-align: center;">รวมราคา</th>
                        <th style="text-align: center;">งานที่ปฏิบัติ</th>
                        <th style="width: 10%; text-align: center;">Actions</th>
                    </tr>
                    @foreach($fuels as $fuel)
                        <?php $vehicle = App\Vehicle::where(['vehicle_id' => $fuel->vehicle_id])->with('changwat')->first();
                        ?>
                    <tr>
                        <td style="text-align: center;">
                            <h4><span class="label label-<?= (($fuel->status == '1') ? 'success' : (($fuel->status == '0') ? 'default' : 'danger')) ?>">
                                61-{{ $fuel->id }}
                            </span></h4>
                        </td>                        
                        <td style="text-align: center;">{{ $fuel->bill_date }}</td>
                        <td style="text-align: center;">{{ $fuel->vehicle[0]->reg_no }}</td>
                        <td style="text-align: center;">{{ $fuel->bill_no }}</td>
                        <td style="text-align: center;">{{ $fuel->fuel_type[0]->fuel_type_name }}</td>
                        <td style="text-align: right;">{{ $fuel->volume }}</td>
                        <td style="text-align: right;">{{ $fuel->unit_price }}</td>
                        <td style="text-align: right;">{{ $fuel->total }}</td>
                        <td style="text-align: center;">{{ $fuel->job_desc }}</td>
                        <td style="text-align: center;">
                            <a  href="{{ url('/reserve/edit/' . $fuel->id) }}" 
                                class="btn btn-warning btn-xs">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>

                            @if ($fuel->status != '3')
                                <a  href="{{ url('/reserve/cancel/' . $fuel->id) }}" 
                                    ng-click="cancel($event)"
                                    class="btn btn-primary btn-xs">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </a>

                                <form id="cancel-form" action="{{ url('/reserve/cancel/' . $fuel->id) }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                </form>
                            @endif

                            @if (Auth::user()->person_id == '1300200009261')
                                @if ($fuel->status == '3')
                                    <a  href="{{ url('/reserve/return/' . $fuel->id) }}" 
                                        ng-click="return($event)"
                                        class="btn btn-default btn-xs">
                                        <i class="fa fa-retweet" aria-hidden="true"></i>
                                    </a>

                                    <form id="return-form" action="{{ url('/reserve/return/' . $fuel->id) }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                    </form>
                                @endif

                                <a  href="{{ url('/reserve/delete/' . $fuel->id) }}" 
                                    ng-click="delete($event)"
                                    class="btn btn-danger btn-xs">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>

                                <form id="delete-form" action="{{ url('/reserve/delete/' . $fuel->id) }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            
            <ul class="pagination">
                @if($fuels->currentPage() !== 1)
                    <li>
                        <a href="{{ $fuels->url($fuels->url(1)) }}" aria-label="Previous">
                            <span aria-hidden="true">First</span>
                        </a>
                    </li>
                @endif
                
                @for($i=1; $i<=$fuels->lastPage(); $i++)
                    <li class="{{ ($fuels->currentPage() === $i) ? 'active' : '' }}">
                        <a href="{{ $fuels->url($i) }}">
                            {{ $i }}
                        </a>
                    </li>
                @endfor

                @if($fuels->currentPage() !== $fuels->lastPage())
                    <li>
                        <a href="{{ $fuels->url($fuels->lastPage()) }}" aria-label="Previous">
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

<script>
    $(document).ready(function($) {
        var dateNow = new Date();

        $('#_month').datetimepicker({
            useCurrent: true,
            format: 'YYYY-MM',
            defaultDate: moment(dateNow),
            viewMode: "months"
        }).on('dp.change', function(e) {
            $("#frm_search").submit();
        });
    });
</script>

@endsection
