@extends('admin.layouts.aside')

@section('content')

<div class="bg-white border-20">
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="dash-card-one bg-white border-30 position-relative mb-15 skew-none">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <div class="icon rounded-circle d-flex align-items-center justify-content-center order-sm-1">
                    <i class="fa-solid fa-building" style="font-size:30px;color:white"></i>
                    </div>
                    <div class="order-sm-0">
                        <span>All Properties</span>
                        <div class="value fw-500">
                            @if($properties >= 1000)
                                {{ number_format($properties / 1000, 1) }}K
                            @else
                                {{ $properties }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.dash-card-one -->
        </div>
        <div class="col-lg-3 col-6">
            <div class="dash-card-one bg-white border-30 position-relative mb-15">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <div class="icon rounded-circle d-flex align-items-center justify-content-center order-sm-1">
                    <i class="fa-solid fa-users" style="color:white;font-size:30px;"></i>
                    </div>
                    <div class="order-sm-0">
                        <span>Total Users</span>
                        <div class="value fw-500">
                        @if($users >= 1000)
                                {{ number_format($users / 1000, 1) }}K
                            @else
                                {{ $users }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.dash-card-one -->
        </div>
        <div class="col-lg-3 col-6">
            <div class="dash-card-one bg-white border-30 position-relative mb-15">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <div class="icon rounded-circle d-flex align-items-center justify-content-center order-sm-1">
                    <i class="fa-solid fa-hand-holding-dollar"  style="color:white;font-size:30px;"></i>
                    </div>
                    <div class="order-sm-0">
                        <span>Sold Credits</span>
                        <div class="value fw-500">
                            @if($sold_credits >= 1000)
                                {{ number_format($sold_credits / 1000, 1) }}K
                            @else
                                {{ $sold_credits }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.dash-card-one -->
        </div>
        <div class="col-lg-3 col-6">
            <div class="dash-card-one bg-white border-30 position-relative mb-15">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <div class="icon rounded-circle d-flex align-items-center justify-content-center order-sm-1">
                    <i class="fa-solid fa-sack-dollar" style="color:white;font-size:30px;"></i>
                    </div>
                    <div class="order-sm-0">
                        <span>Total Earning</span>
                        <div class="value fw-500">
                        <span style="font-size:30px">$</span>
                        @if($total_earning >= 1000)
                                {{ number_format($total_earning / 1000, 1) }}K
                            @else
                                {{ $total_earning }}
                            @endif
                         
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.dash-card-one -->
        </div>
    </div>
</div>
@stop