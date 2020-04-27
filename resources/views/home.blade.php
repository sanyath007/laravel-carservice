@extends('layouts.main')

@section('content')

<div class="container-fluid">
      
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>

    <!-- # Card -->
    <div class="row">
        <div class="col-md-12">

            <div class="col-lg-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="row">
                        <div class="col-xs-6">
                            <i class="fa fa-bus fa-5x"></i>
                        </div>
                        <div class="col-xs-6 text-right">
                            <p class="announcement-heading">6</p>
                            <p class="announcement-text">รถทั่วไปทั้งหมด</p>
                        </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer announcement-bottom">
                            <div class="row">
                                <div class="col-xs-6">
                                Expand
                                </div>
                                <div class="col-xs-6 text-right">
                                <i class="fa fa-arrow-circle-right"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <div class="row">
                        <div class="col-xs-6">
                            <i class="fa fa-ambulance fa-5x"></i>
                        </div>
                        <div class="col-xs-6 text-right">
                            <p class="announcement-heading">5</p>
                            <p class="announcement-text">รถพยาบาลทั้งหมด</p>
                        </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer announcement-bottom">
                            <div class="row">
                                <div class="col-xs-6">
                                Expand
                                </div>
                                <div class="col-xs-6 text-right">
                                <i class="fa fa-arrow-circle-right"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <div class="row">
                        <div class="col-xs-6">
                            <i class="fa fa-address-card-o fa-5x"></i>
                        </div>
                        <div class="col-xs-6 text-right">
                            <p class="announcement-heading">7</p>
                            <p class="announcement-text">พขร.ทั้งหมด</p>
                        </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer announcement-bottom">
                            <div class="row">
                                <div class="col-xs-6">
                                Expand
                                </div>
                                <div class="col-xs-6 text-right">
                                <i class="fa fa-arrow-circle-right"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="row">
                        <div class="col-xs-6">
                            <i class="fa fa-user-o fa-5x"></i>
                        </div>
                        <div class="col-xs-6 text-right">
                            <p class="announcement-heading">4</p>
                            <p class="announcement-text">พขร.ที่อยู่</p>
                        </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer announcement-bottom">
                            <div class="row">
                                <div class="col-xs-6">
                                Expand
                                </div>
                                <div class="col-xs-6 text-right">
                                <i class="fa fa-arrow-circle-right"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

        </div><!-- ./ Col-12 -->
    </div><!-- /.Row -->
    
    <!-- # Driver -->
    <div class="row">
        <div class="col-md-12">

        </div><!-- /. Col-12 -->
    </div><!-- /.Row -->
</div>

<style>

</style>

@endsection
