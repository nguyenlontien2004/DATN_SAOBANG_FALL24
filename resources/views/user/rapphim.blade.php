@extends('layout.user')
@section('content')
<style>
    .tix-bg {
        background-image: url('https://cdn.moveek.com/build/images/tix-banner.ed8b6071.png');
        background-position: 50% 50%;
        background-size: cover;
        height: 110px;
        margin-top: -25px;
    }

    .bg-dark {
        background-color: #12263f !important;

    }
</style>
<div class="tix-bg bg-dark">
    <div class="d-flex align-items-center justify-content-center" style="max-width: 80rem;margin: 0 auto; height:100%;">
        <div class="text-center">
            <h1 class="mb-0 text-white" style="font-size: 1.525rem;font-weight: 500;">Danh sách rạp</h1>
            <p class="mb-0" style="color:#95aac9;">
                Danh sách tất cả các rạp chiếu phim tại Việt Nam
            </p>

        </div>
    </div>
</div>
<div class="container mt-4 mb-4" style="max-width: 80rem;margin: 0 auto;margin-top:9px">
    <div class="row">
        @foreach ($rap as $item)
            <div class="col-md-3 mt-2 mb-3">
                <div class="d-flex" style="padding: 1.3rem;border-radius: .5rem;border: 1px solid #edf2f9;box-shadow: 0 .75rem 1.5rem rgba(18, 38, 63, .03);">
                    <div class="ms-2 mr-2"><img width="67px"
                            src="https://img.freepik.com/premium-vector/fast-movie-logo-cinema-logo-design-template_227744-195.jpg"
                            alt=""></div>
                    <div>
                        <h4 style="color:#12263f;margin-bottom: .1875rem;font-size: .9375rem;font-weight: 500;">
                            <a href="{{ route('chitietrap',$item->id) }}" style="text-decoration: none;">{{ $item->ten_rap }}</a>
                        </h4>
                        <p style="color: #95aac9 !important;font-size: .8125rem;font-weight: 500;">
                            {{ $item->phong_chieus_count }} phòng</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection