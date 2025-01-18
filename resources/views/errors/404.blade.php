@extends('layouts.app')

@section('content')
<title>404 Not Found</title>
<style>
    h1 {
        font-size: 50px;
    }

    p {
        font-size: 20px;
    }

    a {
        text-decoration: none;
        color: #3490dc;
    }
</style>

<div class="hero-banner-one bg-pink z-1 pt-225 xl-pt-200 pb-250 xl-pb-150 lg-pb-100 position-relative"
    style="height: 100vh;">
    <div class="container position-relative">
        <div class="row">
            <div class="col-xxl-10 col-xl-9 col-lg-10 col-md-10 m-auto">
                <center>
                    <img class="img-fluid" style="width:30%" src="{{url('web/assets/images/logo_name.png')}}" alt="">
                </center>
        
                   <h1 class="fs-30 color-dark text-center pt-35 pb-35 wow fadeInUp" data-wow-delay="0.1s">404 PAGE NOT FOUND </h1>
               
                <p class="text-center">

                    @if(Auth::check())
                        <a href="{{route('dashboard')}}" class="btn-one"><i class="fa-regular fa-user"></i>
                            <span>Dashboard</span></a>
                    @else
                        <a href="{{url('/')}}" class="btn-one-sm">
                            <span><i class="fa-solid fa-angle-left"></i> BACK</span>
                        </a>
                    @endif
                </p>
            </div>
        </div>
    </div>
    <img src="{{url('web/assets/images/assets/ils_01.svg')}}" alt="" class="lazy-img shapes w-100 illustration">
</div>
<script>
    $('.inner-content').addClass('d-none')
</script>
@stop
