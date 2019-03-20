@extends('layouts.main')

@section('content')
<div class="container-fluid" ng-controller="reserveCtrl">
  
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
        <li class="breadcrumb-item active">รายการตรวจความพร้อมร่างกาย พขร.</li>
    </ol>

    <!-- page title -->
    <div class="page__title">
        <span>
            <i class="fa fa-calendar" aria-hidden="true"></i> รายการตรวจความพร้อมร่างกาย พขร.
        </span>
        <a href="{{ url('/prepared/add') }}" class="btn btn-primary pull-right">
            <i class="fa fa-plus" aria-hidden="true"></i>
            เพิ่มรายการ
        </a>
    </div>

    <hr />
    <!-- page title -->

    <!-- <form action="" method="POST" class="form-horizontal"> -->
        <!-- <div class="row">
            <div class="col-md-12">
            
                <div class="form-group"> -->
                    <!-- <label class="control-label col-sm-4" for="">ค้นหา</label> -->
                    <!-- <div class="col-sm-12"> -->
                        <!-- <div class="input-group" id="adv-search">
                            <input type="text" class="form-control" placeholder="Search&hellip;" />
                            <div class="input-group-btn">
                                <div class="btn-group" role="group">
                                    <div class="dropdown dropdown-lg">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
                                        <div class="dropdown-menu dropdown-menu-right" role="menu">
                                            <form class="form-horizontal" role="form">
                                                <div class="form-group">
                                                    <label for="filter">Filter by</label>
                                                    <select class="form-control">
                                                        <option value="0" selected>All Snippets</option>
                                                        <option value="1">Featured</option>
                                                        <option value="2">Most popular</option>
                                                        <option value="3">Top rated</option>
                                                        <option value="4">Most commented</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="contain">Author</label>
                                                    <input class="form-control" type="text" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="contain">Contains the words</label>
                                                    <input class="form-control" type="text" />
                                                </div>
                                                <button type="submit" class="btn btn-primary">
                                                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                </div>
                            </div>
                        </div> -->
                    <!-- </div> -->
                <!-- </div>            

            </div>        
        </div> -->
    <!-- </form> -->

    <div class="row">
        <div class="col-md-12">
            
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ url('/prepared/list') }}" method="GET" class="form-inline">
                        <div class="form-group">
                            <label for="">วันที่เดินทาง :</label>
                            <input type="text" id="searchdate" name="searchdate" value="{{ $searchdate }}" class="form-control">
                        </div>

                        <button class="btn btn-primary">
                            <i class="fa fa-search" aria-hidden="true"></i>
                            แสดงตามวันที่
                        </button>
                        <a href="{{ url('/prepared/list') }}" class="btn btn-success">
                            <i class="fa fa-search-plus" aria-hidden="true"></i>
                            แสดงทั้งหมด
                        </a>
                    </form>
                </div>                
            </div><br>

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th style="width: 4%; text-align: center;">#</th>
                        <th style="width: 15%; text-align: center;">วันที่</th>
                        <th style="width: 8%; text-align: center;">เวร</th>
                        <th style="text-align: center;">พนักงานขับรถ</th>
                        <th style="width: 12%; text-align: center;">ผลการตรวจ</th>
                        <th style="width: 12%; text-align: center;">ผู้ตรวจ</th>
                        <th style="width: 8%; text-align: center;">Actions</th>
                    </tr>
                    @foreach($prepareds as $prepared)
                        <?php 
                            $period = [
                                '1' => 'ดึก',
                                '2' => 'เช้า',
                                '3' => 'บ่าย'
                            ];

                            $driver = App\Models\Driver::where(['driver_id' => $prepared->driver_id])->with('person')->first();                         
                        ?>
                    <tr>
                        <td style="text-align: center;">
                            {{ $prepared->id }}
                        </td>                        
                        <td style="text-align: center;">
                            {{ $prepared->prepared_date. ' ' .$prepared->prepared_time }}
                        </td>
                        <td style="text-align: center;">
                            {{ $period[$prepared->period] }}
                        </td>
                        <td style="text-align: left;">
                            <?= (($driver) ? $driver->description. ' / ' .$driver->tel : ''); ?>
                        </td>
                        <td style="text-align: center;">
                            {{ $prepared->bp }} | 
                            {{ (!is_null($prepared->stable)) ? $prepared->stable : '-' }} |
                            {{ $prepared->alcohol }} | 
                            {{ $prepared->drug }}
                            <?= (!empty($prepared->comment)) ? '<a><i class="fa fa-info-circle fa-1x text-info" aria-hidden="true"></i></a>' : '' ?>
                        </td>                      
                        <td style="text-align: center;">
                            <?= (($prepared->user) ? $prepared->user->person_firstname. ' ' .$prepared->user->person_lastname : ''); ?>
                        </td>
                        <td style="text-align: center;">
                            @if (Auth::user()->person_id == $prepared->user_id || Auth::user()->person_id == '1300200009261' || Auth::user()->person_id == '3300101554160' || Auth::user()->person_id == '3340700927877' || Auth::user()->person_id == '1431100020874' || Auth::user()->person_id == '3300100375865' || Auth::user()->person_id == '3201000048759' || Auth::user()->person_id == '3302000684566' || Auth::user()->person_id == '1309900710679' || Auth::user()->person_id == '5301100037355')
                                @if (Auth::user()->person_id == $prepared->user_id || Auth::user()->person_id == '1300200009261' || Auth::user()->person_id == '3300101554160' || Auth::user()->person_id == '3340700927877' || Auth::user()->person_id == '1431100020874' || Auth::user()->person_id == '3300100375865' || Auth::user()->person_id == '3201000048759' || Auth::user()->person_id == '3302000684566' || Auth::user()->person_id == '1309900710679' || Auth::user()->person_id == '5301100037355')
                                    <!-- <a  href="{{ url('/print/print.php') }} ?id={{ $prepared->id }}" 
                                        class="btn btn-success btn-xs"
                                        target="_blank"
                                        title="พิมพ์ใบขอใช้รถ">
                                        <i class="fa fa-print" aria-hidden="true"></i>
                                    </a> -->
                                
                                    <a  href="{{ url('/prepared/edit/' . $prepared->id) }}" 
                                        class="btn btn-warning btn-xs"
                                        title="แก้ไขรายการ">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </a>
                                @endif
                            
                                @if (Auth::user()->person_id == $prepared->user_id || Auth::user()->person_id == '1300200009261' || Auth::user()->person_id == '3300101554160' || Auth::user()->person_id == '3340700927877' || Auth::user()->person_id == '1431100020874' || Auth::user()->person_id == '3300100375865' || Auth::user()->person_id == '3201000048759' || Auth::user()->person_id == '3302000684566' || Auth::user()->person_id == '1309900710679' || Auth::user()->person_id == '5301100037355')
                                    <!-- <a  href="{{ url('/reserve/cancel/' . $prepared->id) }}" 
                                        ng-click="cancel($event, {{ $prepared->id }})"
                                        class="btn btn-primary btn-xs"
                                        title="ยกเลิกรายการ">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </a>

                                    <form id="{{ $prepared->id }}-cancel-form" action="{{ url('/reserve/cancel') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                        <input type="hidden" id="_id" name="_id" value="{{ $prepared->id }}">
                                    </form> -->
                                @endif
                            @endif

                            @if (Auth::user()->person_id == '1300200009261')
                                <!-- <a  href="{{ url('/reserve/recover/' . $prepared->id) }}" 
                                    ng-click="recover($event, {{ $prepared->id }})"
                                    class="btn btn-default btn-xs"
                                    title="นำรายการกลับมาใหม่">
                                    <i class="fa fa-retweet" aria-hidden="true"></i>
                                </a>

                                <form id="{{ $prepared->id }}-recover-form" action="{{ url('/reserve/recover') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                    <input type="hidden" id="_id" name="_id" value="{{ $prepared->id }}">
                                </form> -->

                                <!-- <a  href="{{ url('/reserve/delete/' . $prepared->id) }}" 
                                    ng-click="delete($event, {{ $prepared->id }})"
                                    class="btn btn-danger btn-xs"
                                    title="ลบรายการ">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>

                                <form id="{{ $prepared->id }}-delete-form" action="{{ url('/reserve/delete') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                    <input type="hidden" id="_id" name="_id" value="{{ $prepared->id }}">
                                </form> -->

                            @endif

                            <a  class="btn btn-info btn-xs"
                                href="{{ url('/prepared/detail/' . $prepared->id) }}" 
                                title="ดูรายละเอียด">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            
            <ul class="pagination">
                @if($prepareds->currentPage() !== 1)
                    <li>
                        <a href="{{ $prepareds->url($prepareds->url(1)).'&searchdate='.$searchdate }}" aria-label="First">
                            <span aria-hidden="true">First</span>
                        </a>
                    </li>
                @endif

                <li class="{{ ($prepareds->currentPage() === 1) ? 'disabled' : '' }}">
                    <a href="{{ $prepareds->url($prepareds->currentPage() - 1).'&searchdate='.$searchdate }}" aria-label="Prev">
                        <span aria-hidden="true">Prev</span>
                    </a>
                </li>
                
                @for($i=$prepareds->currentPage(); $i < $prepareds->currentPage() + 10; $i++)
                    @if ($prepareds->currentPage() <= $prepareds->lastPage() && ($prepareds->lastPage() - $prepareds->currentPage()) > 10)
                        <li class="{{ ($prepareds->currentPage() === $i) ? 'active' : '' }}">
                            <a href="{{ $prepareds->url($i).'&searchdate='.$searchdate }}">
                                {{ $i }}
                            </a>
                        </li> 
                    @else
                        @if ($i <= $prepareds->lastPage())
                            <li class="{{ ($prepareds->currentPage() === $i) ? 'active' : '' }}">
                                <a href="{{ $prepareds->url($i).'&searchdate='.$searchdate }}">
                                    {{ $i }}
                                </a>
                            </li>
                        @endif
                    @endif
                @endfor
                
                @if ($prepareds->currentPage() < $prepareds->lastPage() && ($prepareds->lastPage() - $prepareds->currentPage()) > 10)
                    <li>
                        <a href="{{ $prepareds->url($prepareds->currentPage() + 10).'&searchdate='.$searchdate }}">
                            ...
                        </a>
                    </li>
                @endif
                
                <li class="{{ ($prepareds->currentPage() === $prepareds->lastPage()) ? 'disabled' : '' }}">
                    <a href="{{ $prepareds->url($prepareds->currentPage() + 1).'&searchdate='.$searchdate }}" aria-label="Next">
                        <span aria-hidden="true">Next</span>
                    </a>
                </li>

                @if($prepareds->currentPage() !== $prepareds->lastPage())
                    <li>
                        <a href="{{ $prepareds->url($prepareds->lastPage()).'&searchdate='.$searchdate }}" aria-label="Last">
                            <span aria-hidden="true">Last</span>
                        </a>
                    </li>
                @endif
            </ul>

        </div><!-- right column -->
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

    <!-- Modal -->
    <div class="modal fade" id="dlgprepareds" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="">รายละเอียดการขอใช้รถ</h4>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th style="width: 8%; text-align: right;">ID :</th>
                                    <td>@{{ prepared.id }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 8%; text-align: right;">ผู้ขอ :</th>
                                    <td>
                                        @{{ survey.user.person_firstname + '  ' + survey.user.person_lastname }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 30%; text-align: right;">ประเภท</th>
                                    <td>@{{ activityType[survey.activity_type] }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 30%; text-align: right;">เพื่อราชการ :</th>
                                    <td>@{{ survey.activity }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 30%; text-align: right;">สถานที่ :</th>
                                    <td>@{{ strLocation }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 30%; text-align: right;">วันที่ไป :</th>
                                    <td>@{{ survey.from_date + ' ' + survey.from_time }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 30%; text-align: right;">วันที่กลับ :</th>
                                    <td>@{{ survey.to_date + ' ' + survey.to_time }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 30%; text-align: right;">ลักษณะการรับ-ส่ง :</th>
                                    <td>@{{ transport[survey.transport] }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 30%; text-align: right;">หมายเหตุ :</th>
                                    <td>@{{ survey.remark }}</td>
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

        $('#searchdate').datetimepicker({
            useCurrent: true,
            format: 'YYYY-MM-DD',
            defaultDate: moment(dateNow)
        });
    });
</script>

@endsection
