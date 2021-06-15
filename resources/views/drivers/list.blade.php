@extends('layouts.main')

@section('content')
<div class="container-fluid">
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

        @foreach($drivers as $driver)
            <div class="col-12 col-md-6 col-lg-4">
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
                            <h4>{{ $driver->person->position ? $driver->person->position->position_name : '' }}</h4>
                        </p>
                        <p><h4>โทร. {{ $driver->person->person_tel }}</h4></p>
                        <p>
                            <h4>
                                <b style="margin-right: 5px;">วันที่บรรจุ</b>
                                {{ convDbDateToThDate($driver->person->person_singin) }}
                            </h4>
                        </p>
                        <!-- <ul class="follow-us clearfix">
                            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                        </ul> -->
                    </div>

                    <div>
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

                        <a
                            href="#"
                            class="btn btn-danger btn-xs"
                            ng-click="delete($event, '{{ $driver->driver_id }}')"
                        >
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </a>
                        <form
                            id="{{ $driver->driver_id. '-delete-form' }}"
                            action="{{ url('/drivers/' .$driver->driver_id. '/delete') }}"
                            method="POST"
                            style="display: none;"
                        >
                            {{ csrf_field() }}
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
    padding:30px 20px; 
    text-align:center; 
    border:2px solid #d5d5d5;
    margin: 0 0 28px;
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
