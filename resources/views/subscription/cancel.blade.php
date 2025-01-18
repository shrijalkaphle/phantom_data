@extends('layouts.aside')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="height: 50vh;">
    <div class="text-center">
        <!-- Font Awesome Icon -->
        <i class="fas fa-times-circle" style="font-size: 100px; color: red;"></i>

        <!-- Cancellation Message -->
        <h2 class="mt-4">Subscription Canceled</h2>
        <p class="lead">Your subscription has been canceled.</p>

        <!-- Go Back Button -->
        <a href="{{ url()->previous() }}" class="btn btn-primary mt-4">Go Back</a>
    </div>
</div>
@stop
