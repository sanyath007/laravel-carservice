@extends('layouts.main')

@section('content')
<div class="container-fluid" ng-controller="driverCtrl" ng-init="setStatus({{ $status }})">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">หน้าหลัก</a></li>
        <li class="breadcrumb-item active">รายการพนักงานขับรถ</li>
    </ol>

    <!-- page title -->
    <div class="page__title-wrapper">
        <div class="page__title">
            <span>รายการพนักงานขับรถ</span>

            <div>
                <a href="{{ url('/drivers/new') }}" class="btn btn-primary pull-right">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    เพิ่ม พขร.
                </a>
            </div>
        </div>
        
        <hr />
    </div>
    <!-- page title -->

    
    <div class="row">
        <div class="col-md-3">
            <select
                id="cboStatus"
                name="cboStatus"
                class="form-control"
                ng-model="cboStatus"
                ng-change="onCboStatusChange(cboStatus);"
            >
                <option value="">แสดงทั้งหมด</option>
                <option value="1">ปฏิบัติงาน</option>
                <option value="2">ไม่ได้ปฏิบัติงานแล้ว</option>
            </select>
        </div>
    </div><br>

    <div class="row">
        @foreach($drivers as $driver)
            <div class="col-12 col-md-4 col-lg-3">
                <div class="cnt-block equal-hight">
                    <div style="margin-bottom: 20px;">
                        <figure>
                            <img
                                src="{{ $driver->thumbnail
                                    ? asset('/uploads/drivers/' .$driver->thumbnail)
                                    : asset('/uploads/drivers/no-image-300x300.jpg')
                                }}"
                                class="img-responsive"
                                alt=""
                            />
                        </figure>
                        <h3><a href="#">{{ $driver->description }}</a></h3>
                        <p>
                            <h4>ตำแหน่ง {{ $driver->person->position ? $driver->person->position->position_name : '-' }}</h4>
                        </p>
                        <p><h4>โทร. {{ $driver->person->person_tel }}</h4></p>
                        <p>
                            <h4>
                                <b style="margin-right: 5px;">วันที่บรรจุ</b>
                                {{ convDbDateToThDate($driver->person->person_singin) }}
                            </h4>
                        </p>
                        <p>
                            <h5 class="label label-success" ng-show="{{ $driver->status }} == '1'">ปฏิบัติงาน</h5>
                            <h5 class="label label-danger" ng-show="{{ $driver->status }} == '2'">ไม่ได้ปฏิบัติงานแล้ว</h5>
                        </p>
                    </div>

                    <div style="display: flex; justify-content: center; gap: 5px;">
                        <a
                            href="{{ url('/drivers/' .$driver->driver_id. '/detail') }}"
                            class="btn btn-info btn-xs"
                        >
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </a>

                        <a
                            href="{{ url('/drivers/' .$driver->driver_id. '/edit') }}"
                            class="btn btn-warning btn-xs"
                        >
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </a>

                        <!-- <a
                            href="#"
                            class="btn btn-danger btn-xs"
                            ng-click="delete($event, '{{ $driver->driver_id }}')"
                        >
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </a> -->
                        <form
                            id="{{ $driver->driver_id. '-delete-form' }}"
                            action="{{ url('/drivers/' .$driver->driver_id. '/status') }}"
                            method="POST"
                            ng-show="{{ $driver->status }} == '1'"
                        >
                            {{ csrf_field() }}
                            <input type="hidden" id="status" name="status" value="2" />
                            <button type="submit" class="btn btn-danger btn-xs">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

    </div><!-- /.row -->
</div><!-- /.container-fluid -->

<style>
.cnt-block{ 
    float:left; 
    width:100%; 
    background:#fff; 
    padding:30px 10px; 
    text-align:center; 
    border:1px solid #d5d5d5;
    margin: 0 0 28px;
    /* box-shadow: 0 1px 2px rgb(0 0 0 / 0.2); */
}
.cnt-block figure{
    width:148px;
    height:148px;
    border-radius:100%;
    display:inline-block;
    margin-bottom: 15px;
}
.cnt-block img{ 
    width:148px; 
    height:148px; 
    border-radius:100%; 
}
.cnt-block p{ 
    margin:1px;
}
.cnt-block .follow-us{
	margin:20px 0 0;
}
.cnt-block .follow-us li{ 
    display:inline-block; 
	width:auto; 
	margin:0 5px;
}
.cnt-block .follow-us li .fa{ 
    font-size:24px; 
    color:#767676;
}
</style>

@endsection
