@extends('layouts.main')

@section('content')
<div class="container-fluid" ng-controller="taxCtrl">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">หน้าหลัก</a></li>
        <li class="breadcrumb-item active">รายการต่อภาษี</li>
    </ol>

    <!-- page title -->
    <div class="page__title-wrapper">
        <div class="page__title">
            <span>
                <i class="fa fa-calendar" aria-hidden="true"></i> รายการต่อภาษี
            </span>

            <div>
                <a href="{{ url('/taxes/new') }}" class="btn btn-primary pull-right">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    เพิ่มรายการ
                </a>
            </div>
        </div>
        
        <hr />
    </div>
    <!-- page title -->

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th style="width: 8%; text-align: center;">#</th>
                        <th style="text-align: center;">รถ</th>
                        <th style="width: 10%; text-align: center;">วันที่เสียภาษี</th>
                        <th style="width: 10%; text-align: center;">วันที่ครบกำหนดเสียภาษี</th>
                        <th style="width: 20%; text-align: center;">เลขที่ใบเสร็จ</th>
                        <th style="width: 10%; text-align: center;">ค่าภาษี</th>
                        <th style="width: 10%; text-align: center;">Actions</th>
                    </tr>
                    @foreach($taxes as $tax)
                        <?php $vehicle = App\Models\Vehicle::where(['vehicle_id' => $tax->vehicle_id])->with('changwat')->first();
                        ?>
                    <tr>
                        <td style="text-align: center;">
                            <h4><span class="label label-<?= (($tax->status == '1') ? 'success' : (($tax->status == '0') ? 'default' : 'danger')) ?>">
                                TAX60-{{ $tax->id }}
                            </span></h4>
                        </td>                        
                        <td style="text-align: center;">
                            {{ $tax->vehicle->reg_no }}
                        </td>
                        <td style="text-align: center;">
                            {{ $tax->tax_start_date }}
                        </td>
                        <td style="text-align: center;">
                            {{ $tax->tax_renewal_date }}
                        </td>
                        <td style="text-align: center;">{{ $tax->tax_receipt_no }}</td>
                        <td style="text-align: center;">{{ $tax->tax_charge }}</td>
                        <td style="text-align: center;">
                            <a
                                href="{{ url('/taxes/' .$tax->id. '/edit') }}" 
                                class="btn btn-warning btn-xs"
                                title="แก้ไขรายการ"
                            >
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>

                            @if ($tax->status != '3')
                                <a
                                    href="#" 
                                    ng-click="cancel($event, '{{ $tax->id }}')"
                                    class="btn btn-primary btn-xs"
                                    title="ยกเลิกรายการ"
                                >
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </a>

                                <form id="cancel-form" action="{{ url('/taxes/cancel/' . $tax->id) }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                </form>
                            @endif

                            @if (Auth::user()->person_id == '1300200009261')
                                @if ($tax->status == '3')
                                    <a
                                        href="#" 
                                        ng-click="return($event, '{{ $tax->id }}')"
                                        class="btn btn-default btn-xs"
                                        title="นำรายการกลับมา"
                                    >
                                        <i class="fa fa-retweet" aria-hidden="true"></i>
                                    </a>

                                    <form id="return-form" action="{{ url('/taxes/return/' . $tax->id) }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                    </form>
                                @endif

                                <a
                                    href="#" 
                                    ng-click="delete($event, '{{ $tax->id }}')"
                                    class="btn btn-danger btn-xs"
                                    title="ลบรายการ"
                                >
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>

                                <form id="delete-form" action="{{ url('/taxes/' .$tax->id. '/delete') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            
            <ul class="pagination" style="margin: 0 auto;">
                @if($taxes->currentPage() !== 1)
                    <li>
                        <a href="{{ $taxes->url($taxes->url(1)) }}" aria-label="Previous">
                            <span aria-hidden="true">First</span>
                        </a>
                    </li>
                @endif
                
                @for($i=1; $i<=$taxes->lastPage(); $i++)
                    <li class="{{ ($taxes->currentPage() === $i) ? 'active' : '' }}">
                        <a href="{{ $taxes->url($i) }}">
                            {{ $i }}
                        </a>
                    </li>
                @endfor

                @if($taxes->currentPage() !== $taxes->lastPage())
                    <li>
                        <a href="{{ $taxes->url($taxes->lastPage()) }}" aria-label="Previous">
                            <span aria-hidden="true">Last</span>
                        </a>
                    </li>
                @endif
            </ul>

        </div><!-- /.col -->
    </div><!-- /.row -->

</div><!-- /.container -->
@endsection
