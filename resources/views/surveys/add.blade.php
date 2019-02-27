@extends('layouts.main')

@section('content')
<div class="container-fluid" ng-controller="reserveCtrl">
  
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
        <li class="breadcrumb-item active">แบบสอบถามความพึงพอใจ</li>
    </ol>

    <!-- page title -->
    <div class="page__title">
        <span>
            <i class="fa fa-calendar" aria-hidden="true"></i> แบบสอบถามความพึงพอใจ
        </span>
        <!-- <a href="{{ url('/reserve/new') }}" class="btn btn-primary pull-right">
            <i class="fa fa-plus" aria-hidden="true"></i>
            รายการสอบถามความพึงพอใจ
        </a> -->
    </div>

    <hr />
    <!-- page title -->

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ประเด็นความพึงพอใจ</th>
                        <th style="width: 10px; text-align: center;">ควรปรับปรุง</th>
                        <th style="width: 10px; text-align: center;">น้อย</th>
                        <th style="width: 10px; text-align: center;">ปานกลาง</th>
                        <th style="width: 10px; text-align: center;">ดี</th>
                        <th style="width: 10px; text-align: center;">ดีมาก</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>ด้านสภาพยานพาหนะ</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>1. สภาพของยานพาหนะ</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div><!-- right column -->
    </div><!-- /.row -->
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