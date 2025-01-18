@extends('layouts.aside')
@section('content')

<style>

</style>

<div class="bg-white border-20">
    <div class="row">
        <div class="col-md-12">
            <div class="dash-card-one border-30 position-relative mb-15 skew-none">
                <div class="ratio ratio-16x9">
                    <iframe src="https://www.youtube.com/embed/-IMGm5plH4Y?si=VRc_UbhliabLzzGJ"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                    </iframe>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    var user_data = localStorage.getItem('user_details')
    if (!user_data) {
        window.location.href = '{{ route('welcome') }}';
    }
</script>
@stop