@extends('layout.user')
@section('content')
<style>
    .featured-movie {
        background-position: 50% 50%;
        background-size: cover;
        background-color: #12263f !important;
        color: white;
    }

    .container-nghesi {
        padding-bottom: .75rem !important;
        padding-top: .75rem !important;
        max-width: 1140px;
        margin: auto;
    }

    .imgae-nghe-si {
        border-radius: .375rem !important;
        border: 1px solid #e3ebf6 !important;
        height: auto;
        max-width: 100%;
    }

    .tenphim {
        font-weight: 500;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .tenphim a {
        text-decoration: none;
    }
</style>
<div class="featured-movie" style=" margin-top: -25px">
    <div class="container-nghesi">
        <div class="row">
            <div class="col-sm-2">
                <div>
                    <img class="imgae-nghe-si"
                        src="{{ isset($daodien->anh_dao_dien) ? asset('storage/' . $daodien->anh_dao_dien) : 'https://cdn.moveek.com/bundles/ornweb/img/no-poster.png' }}"
                        alt="">
                </div>
            </div>
            <div class="col-sm-10">
                <div class="mb-3">
                    <h2 style="font-size: 1.625rem;font-weight: 500;">{{ $daodien->ten_dao_dien }}</h2>
                </div>
                <div class="mb-2">
                    <p>{!! $daodien->tieu_su !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mb-4" style="max-width: 80rem;margin: 0 auto;margin-top:2.239rem;">
    <div class="d-flex align-items-center" style="justify-content: center;">
        @foreach ($daodien->phims as $item) 
            <div class="item ms-2 mr-2">
                <div class="mb-4" style="width:130px;height:auto;">
                    <a href="{{ route('chitietphim',$item->id) }}">
                        <img style="border-radius: 8px; width:100%;height:190px;"
                            src="{{ asset('storage/'.$item->anh_phim) }}" alt="" style="image-rendering: pixelated;object-fit: cover;">
                    </a>
                    <h3 class="tenphim mt-1">
                        <a href="{{ route('chitietphim',$item->id) }}"> {{ $item->ten_phim }}</a>
                    </h3>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection