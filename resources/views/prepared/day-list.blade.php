@extends('layouts.main')

@section('content')
<div class="container-fluid" ng-controller="reserveCtrl">
  
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
        <li class="breadcrumb-item active">รายงานผลการตรวจความพร้อมร่างกาย พขร.</li>
    </ol>

    <!-- page title -->
    <div class="page__title">
        <span>
            <i class="fa fa-calendar" aria-hidden="true"></i> รายงานผลการตรวจความพร้อมร่างกาย พขร.
        </span>
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
                    <form action="{{ url('/prepared/day-list') }}" method="GET" class="form-inline">
                        <div class="form-group">
                            <label for="">ประจำเดือน :</label>
                            <input type="text" id="searchMonth" name="searchMonth" value="{{ $searchMonth }}" class="form-control">
                        </div>

                        <button class="btn btn-primary">
                            <i class="fa fa-search" aria-hidden="true"></i>
                            แสดงข้อมูล
                        </button>                       
                    </form>
                </div>                
            </div><br>

            @for($d=1; $d <= 31; $d++)
                <b>วันที่ :</b> {{ $pdate = $searchMonth.'-'.sprintf("%02d", $d) }}<br>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th style="width: 2%; text-align: center;">#</th>
                            <th style="width: 8%; text-align: center;">เวร</th>
                            <th style="width: 20%; text-align: center;">พขร.</th>
                            <th style="text-align: center;">ผลการตรวจ</th>
                            <th style="width: 12%; text-align: center;">ผู้ตรวจ</th>
                        </tr>

                        @foreach($prepareds as $prepared)
                            @if($prepared->prepared_date == $pdate)
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
                                        {{ $period[$prepared->period] }}
                                    </td>
                                    <td style="text-align: center;">
                                        {{ $driver->description }}
                                    </td>
                                    <td style="text-align: center;">
                                        @if($prepared->not_check != 1)
                                            <b>ความดันโลหิต :</b> {{ ($prepared->bp==0) ? 'ปกติ' : 'ผิดปกติ' }} | 
                                            <b>การทรงตัว :</b> {{ (!is_null($prepared->stable)) ? ($prepared->stable==0) ? 'ปกติ' : 'ผิดปกติ' : '-' }} |
                                            <b>แอลกอฮอล์ :</b> {{ ($prepared->alcohol==0) ? 'ปกติ' : 'ผิดปกติ' }} | 
                                            <b>การทานยา :</b> {{ ($prepared->drug==0) ? 'ปกติ' : 'ผิดปกติ' }}
                                            <?= (!empty($prepared->comment)) ? '<a><i class="fa fa-info-circle fa-1x text-info" aria-hidden="true"></i></a>' : '' ?>
                                        @else
                                            <font style="color: red;">ไม่ได้ตรวจ</font>
                                        @endif
                                    </td>                      
                                    <td style="text-align: center;">
                                        <?= (($prepared->user) ? $prepared->user->person_firstname. ' ' .$prepared->user->person_lastname : ''); ?>
                                    </td>
                                </tr>

                            @endif
                        @endforeach
                    </table>
                </div><!-- /.table-responsive --> 

            @endfor

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

</div><!-- /.container -->

<script>
    $(document).ready(function($) {
        var dateNow = new Date();

        $('#searchMonth').datetimepicker({
            useCurrent: true,
            format: 'YYYY-MM',
            defaultDate: moment(dateNow)
        });
    });
</script>

@endsection
