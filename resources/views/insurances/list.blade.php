@extends('layouts.main')

@section('content')
<div class="container-fluid" ng-controller="insuranceCtrl">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">หน้าหลัก</a></li>
        <li class="breadcrumb-item active">รายการต่อประกันภัย</li>
    </ol>

    <!-- page title -->
    <div class="page__title-wrapper">
        <div class="page__title">
            <span>
                <i class="fa fa-calendar" aria-hidden="true"></i> รายการต่อประกันภัย
            </span>
            <a href="{{ url('/insurances/new') }}" class="btn btn-primary pull-right">
                <i class="fa fa-plus" aria-hidden="true"></i>
                เพิ่มรายการ
            </a>
        </div>
        
        <hr />
    </div>
    <!-- page title -->

    @include('utils.flash-message')

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th style="width: 8%; text-align: center;">#</th>
                        <th style="width: 15%; text-align: center;">รถ</th>
                        <th style="width: 12%; text-align: center;">เลขที่กรมธรรม์</th>
                        <th style="width: 12%; text-align: center;">ประเภทประกันภัย</th>
                        <th>รายละเอียด</th>
                        <th style="width: 12%; text-align: center;">ระยะเวลาประกัน</th>
                        <th style="width: 8%; text-align: center;">ค่าเบี้ยประกัน</th>
                        <th style="width: 8%; text-align: center;">Actions</th>
                    </tr>
                    @foreach($insurances as $insurance)
                        <?php $vehicle = App\Models\Vehicle::where(['vehicle_id' => $insurance->vehicle_id])->with('changwat')->first();
                        ?>
                    <tr>
                        <td style="text-align: center;">
                            <h4><span class="label label-<?= (($insurance->status == '1') ? 'success' : (($insurance->status == '0') ? 'default' : 'danger')) ?>">
                                INS60-{{ $insurance->id }}
                            </span></h4>
                        </td>                        
                        <td style="text-align: center;">
                            {{ $insurance->vehicle->reg_no }}
                        </td>
                        <td style="text-align: center;">
                            {{ $insurance->insurance_no }}
                        </td>
                        <td style="text-align: center;">
                            {{ $insurance->type->insurance_type_name }}
                        </td>
                        <td style="text-align: left;">
                            {{ $insurance->company->insurance_company_name }} <br>
                            {{ $insurance->insurance_detail }}
                        </td>
                        <td style="text-align: center;">
                            {{ convDbDateToThDate($insurance->insurance_start_date) }} - 
                            {{ convDbDateToThDate($insurance->insurance_renewal_date) }}
                        </td>
                        <td style="text-align: center;">
                            {{ number_format($insurance->insurance_total,2) }}
                        </td>
                        <td style="text-align: center;">
                            <a
                                href="{{ url('/insurances/' .$insurance->id. '/edit') }}" 
                                class="btn btn-warning btn-xs"
                                title="แก้ไขรายการ"
                            >
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>

                            @if (Auth::user()->person_id == '1300200009261')
                                @if ($insurance->status != '3')
                                    <!-- <a
                                        href="#" 
                                        ng-click="cancel($event, '{{ $insurance->id }}')"
                                        class="btn btn-primary btn-xs"
                                        title="ยกเลิกรายการ"
                                    >
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </a>

                                    <form
                                        id="{{ $insurance->id. '-cancel-form' }}"
                                        action="{{ url('/insurances/' .$insurance->id. '/cancel') }}"
                                        method="POST"
                                        style="display: none;"
                                    >
                                        {{ csrf_field() }}
                                    </form> -->
                                @endif

                                @if ($insurance->status == '3')
                                    <!-- <a
                                        href="#" 
                                        ng-click="return($event, '{{ $insurance->id }}')"
                                        class="btn btn-default btn-xs"
                                        title="นำรายการกลับมา"
                                    >
                                        <i class="fa fa-retweet" aria-hidden="true"></i>
                                    </a>

                                    <form
                                        id="{{ $insurance->id. '-return-form' }}"
                                        action="{{ url('/insurances' .$insurance->id. '/return') }}"
                                        method="POST"
                                        style="display: none;"
                                    >
                                        {{ csrf_field() }}
                                    </form> -->
                                @endif

                                <a
                                    href="#" 
                                    ng-click="delete($event, '{{ $insurance->id }}')"
                                    class="btn btn-danger btn-xs"
                                    title="ลบรายการ"
                                >
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>

                                <form
                                    id="{{ $insurance->id. '-delete-form' }}"
                                    action="{{ url('/insurances/' .$insurance->id. '/delete') }}"
                                    method="POST"
                                    style="display: none;"
                                >
                                    {{ csrf_field() }}
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            
            <ul class="pagination" style="margin: 0 auto;">
                @if($insurances->currentPage() !== 1)
                    <li>
                        <a href="{{ $insurances->url($insurances->url(1)) }}" aria-label="Previous">
                            <span aria-hidden="true">First</span>
                        </a>
                    </li>
                @endif
                
                @for($i=1; $i<=$insurances->lastPage(); $i++)
                    <li class="{{ ($insurances->currentPage() === $i) ? 'active' : '' }}">
                        <a href="{{ $insurances->url($i) }}">
                            {{ $i }}
                        </a>
                    </li>
                @endfor

                @if($insurances->currentPage() !== $insurances->lastPage())
                    <li>
                        <a href="{{ $insurances->url($insurances->lastPage()) }}" aria-label="Previous">
                            <span aria-hidden="true">Last</span>
                        </a>
                    </li>
                @endif
            </ul>

        </div><!-- /.col -->
    </div><!-- /.row -->

</div><!-- /.container -->
@endsection
