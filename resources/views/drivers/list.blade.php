@extends('layouts.main')

@section('content')
<div class="container-fluid">
  <!-- page title -->
  <div class="page__title">
    <span>รายการพนักงานขับรถ</span>
    <a href="{{ url('/drivers/new') }}" class="btn btn-primary pull-right">
        <i class="fa fa-plus" aria-hidden="true"></i>
        New
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
            <th style="width: 13%; text-align: center;">เลขประจำตัวประชาชน</th>
            <th>ชื่อ-สกุล</th>
            <th style="width: 10%; text-align: center;">เบอร์ติดต่อ</th>
            <th style="width: 12%; text-align: center;">ผ่านการอบรม พขร. เมื่อ</th>
            <th style="width: 12%; text-align: center;">ผ่านการอบรม EMR เมื่อ</th>
            <th style="width: 6%; text-align: center;">Actions</th>
          </tr>

          <?php $row = 0; ?>
          @foreach($drivers as $driver)
          <tr>
            <td style=" text-align: center;">{{ ++$row }}</td>
            <td style=" text-align: center;">{{ $driver->person_id }}</td>
            <td>{{ $driver->description }}</td>
            <td style=" text-align: center;">{{ $driver->person->person_tel }}</td>
            <td style=" text-align: center;">{{ $driver->certificated_date }}</td>
            <td style=" text-align: center;">{{ $driver->emr_sdate }}</td>
            <td style=" text-align: center;">
              <a href="{{$driver->driver_id}}" class="btn btn-warning btn-xs">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
              </a>
              <a href="{{$driver->driver_id}}" class="btn btn-danger btn-xs">
                <i class="fa fa-times" aria-hidden="true"></i>
              </a>
            </td>
          </tr>
          @endforeach
          
        </table>
      </div>
    </div>

    <!-- #=============== New List ===============# -->
    <div class="col-12 col-md-6 col-lg-4">
        <div class="cnt-block equal-hight" style="height: 349px;">
            <figure>
                <img src="{{ asset('/uploads/drivers/no-image-300x300.jpg') }}" class="img-responsive" alt="">
            </figure>
            <h3><a href="http://www.webcoderskull.com/">นายอาราม ราชภักดี</a></h3>
            <p>พนักงานขับรถยนต์</p>
            <p>โทร. 0866509103</p>
            <!-- <ul class="follow-us clearfix">
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
            </ul> -->
      </div>
    </div>

    <div class="col-12 col-md-6 col-lg-4">
        <div class="cnt-block equal-hight" style="height: 349px;">
            <figure>
                <img src="{{ asset('/uploads/drivers/no-image-300x300.jpg') }}" class="img-responsive" alt="">
            </figure>
            <h3><a href="http://www.webcoderskull.com/">นายคฑาวุธ สิงห์แจ่ม</a></h3>
            <p>พนักงานขับรถยนต์</p>
            <p>โทร. 0828702283</p>
            <!-- <ul class="follow-us clearfix">
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
            </ul> -->
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-4">
        <div class="cnt-block equal-hight" style="height: 349px;">
            <figure>
                <img src="{{ asset('/uploads/drivers/no-image-300x300.jpg') }}" class="img-responsive" alt="">
            </figure>
            <h3><a href="http://www.webcoderskull.com/">นายคงฤทธิ์ แสนพิมพ์</a></h3>
            <p>พนักงานขับรถยนต์</p>
            <p>โทร. 0854116068</p>
            <!-- <ul class="follow-us clearfix">
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
            </ul> -->
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-4">
        <div class="cnt-block equal-hight" style="height: 349px;">
            <figure>
                <img src="{{ asset('/uploads/drivers/3201000048759.jpg') }}" class="img-responsive" alt="">
            </figure>
            <h3><a href="http://www.webcoderskull.com/">นายสายันต์ คงสม</a></h3>
            <p>พนักงานขับรถยนต์</p>
            <p>โทร. 0930190899</p>
            <!-- <ul class="follow-us clearfix">
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
            </ul> -->
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-4">
        <div class="cnt-block equal-hight" style="height: 349px;">
            <figure>
                <img src="{{ asset('/uploads/drivers/no-image-300x300.jpg') }}" class="img-responsive" alt="">
            </figure>
            <h3><a href="http://www.webcoderskull.com/">นายณัฐพล ไชยสระน้อย</a></h3>
            <p>พนักงานขับรถยนต์</p>
            <p>โทร. 0981215165</p>
            <!-- <ul class="follow-us clearfix">
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
            </ul> -->
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-4">
        <div class="cnt-block equal-hight" style="height: 349px;">
            <figure>
                <img src="{{ asset('/uploads/drivers/no-image-300x300.jpg') }}" class="img-responsive" alt="">
            </figure>
            <h3><a href="http://www.webcoderskull.com/">นายสมโภชน์ พิมพิค่อ</a></h3>
            <p>พนักงานขับรถยนต์</p>
            <p>โทร. 0986230526</p>
            <!-- <ul class="follow-us clearfix">
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
            </ul> -->
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-4">
        <div class="cnt-block equal-hight" style="height: 349px;">
            <figure>
                <img src="{{ asset('/uploads/drivers/no-image-300x300.jpg') }}" class="img-responsive" alt="">
            </figure>
            <h3><a href="http://www.webcoderskull.com/">นายพนมพร เนตรสูงเนิน</a></h3>
            <p>พนักงานขับรถยนต์</p>
            <p>โทร. 0973352538</p>
            <!-- <ul class="follow-us clearfix">
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
            </ul> -->
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-4">
        <div class="cnt-block equal-hight" style="height: 349px;">
            <figure>
                <img src="{{ asset('/uploads/drivers/no-image-300x300.jpg') }}" class="img-responsive" alt="">
            </figure>
            <h3><a href="http://www.webcoderskull.com/">นายภุชงค์ เนยสูงเนิน</a></h3>
            <p>พนักงานขับรถยนต์</p>
            <p>โทร. 0916132711</p>
            <!-- <ul class="follow-us clearfix">
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
            </ul> -->
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-4">
        <div class="cnt-block equal-hight" style="height: 349px;">
            <figure>
                <img src="{{ asset('/uploads/drivers/no-image-300x300.jpg') }}" class="img-responsive" alt="">
            </figure>
            <h3><a href="http://www.webcoderskull.com/">นายชัยพงษ์ เพียรทำดี</a></h3>
            <p>พนักงานขับรถยนต์</p>
            <p>โทร. 0934864117</p>
            <!-- <ul class="follow-us clearfix">
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
            </ul> -->
        </div>
    </div>

  </div><!-- /. Col-12 -->
</div><!-- Row -->

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
