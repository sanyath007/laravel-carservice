@extends('layouts.main')

@section('content')
<div class="container-fluid">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
        <li class="breadcrumb-item active">รายการประวัติการบำรุงรักษารถล่าสุด</li>
    </ol>

    <!-- page title -->
    <div class="page__title">
        <span>รายการประวัติการบำรุงรักษารถล่าสุด</span>
    </div>

    <hr />
    <!-- page title -->
  
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th style="width: 3%; text-align: center;">#</th>
                        <th>รถ</th>
                        <th style="width: 10%; text-align: center;">วันที่ซ่อมล่าสุด</th>
                        <th style="width: 10%; text-align: center;">เลขระยะทางเมื่อเข้าซ่อม</th>
                        <th style="width: 10%; text-align: center;">เลขระยะทางล่าสุด</th>
                        <th style="width: 20%; text-align: center;">รายละเอียด</th>               
                        <th style="width: 8%; text-align: center;">เลขที่ใบส่งของ</th>               
                        <th style="width: 6%; text-align: center;">ค่าซ่อม</th>
                        <th style="width: 10%; text-align: center;">สถานที่ซ่อม</th>
                        <!-- <th style="width: 10%; text-align: center;">หมายเหตุ</th> -->
                        <!-- <th style="width: 10%; text-align: center;">Actions</th> -->
                    </tr>
                    @foreach($vehicles as $vehicle)
                        
                        <?php $maintained = App\Models\Maintenance::where(
                            ['vehicle_id' => $vehicle->vehicle_id]
                        )->with('garage')->orderBy('maintained_date', 'DESC')->first() ?>
                    <tr>
                        <td style="text-align: center;">
                            {{ $vehicle->vehicle_id }}
                        </td>
                        <td>
                            <a href="{{ url('/maintained/vehicle') }}/{{ $vehicle->vehicle_id }}">
                                {{ $vehicle->cate->vehicle_cate_name }} 
                                {{ $vehicle->type->vehicle_type_name }}
                                {{ $vehicle->manufacturer->manufacturer_name }}
                                ทะเบียน {{ $vehicle->reg_no }} {{ $vehicle->changwat->short }}
                            </a>
                        </td>         
                        <td style="text-align: center;">
                            {{ ($maintained['maintained_id']) ? $maintained['maintained_date'] : '' }}
                        </td>
                        <td style="text-align: center;">
                            {{ number_format($maintained['maintained_mileage']) }}
                        </td>
                        <td style="text-align: center;">
                            {{ (count($vehicle->mileage) > 0) 
                                ? number_format($vehicle->mileage[0]->mileage) 
                                : '-' }}
                        </td>
                        <td>
                            {{ $maintained['detail'] }}
                        </td>
                        <td style="text-align: center;">
                            {{ $maintained['delivery_bill'] }}
                        </td>
                        <td style="text-align: center;">
                            {{ number_format($maintained['total'],2) }}
                        </td>
                        <td style="text-align: center;">
                            {{ $maintained['garage']['garage_name'] }}
                        </td>
                        <!-- <td>
                            {{ $maintained['remark'] }}
                        </td> -->
                        <!-- <td style="text-align: center;">
                            <a href="{{ $maintained['maintain_id'] }}" class="btn btn-warning">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>
                            <a href="{{ $maintained['maintain_id'] }}" class="btn btn-danger">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </a>
                        </td> -->
                    </tr>
                    @endforeach
                </table>
            </div>
            
            <ul class="pagination" style="margin: 0 auto;">
                @if($vehicles->currentPage() !== 1)
                    <li>
                        <a href="{{ $vehicles->url($vehicles->url(1)) }}" aria-label="Previous">
                            <span aria-hidden="true">First</span>
                        </a>
                    </li>
                @endif
                
                @for($i=1; $i<=$vehicles->lastPage(); $i++)
                    <li class="{{ ($vehicles->currentPage() === $i) ? 'active' : '' }}">
                        <a href="{{ $vehicles->url($i) }}">
                            {{ $i }}
                        </a>
                    </li>
                @endfor

                @if($vehicles->currentPage() !== $vehicles->lastPage())
                    <li>
                        <a href="{{ $vehicles->url($vehicles->lastPage()) }}" aria-label="Previous">
                            <span aria-hidden="true">Last</span>
                        </a>
                    </li>
                @endif
            </ul>

        </div>
    </div>
</div>
@endsection
