@extends('nhanVien.index')

@section('title')
{{ 'Quản lý đáng giá phim' }}
@endsection
<style>
    .block-ellipsis {
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        /* number of lines to show */
        line-clamp: 2;
        -webkit-box-orient: vertical;
        font-weight: 500;
    }
</style>
@section('content')
<div class="row page-inner">
    <div class="col-md-12">
        <div class="content">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Quản lí đánh giá phim</h4>
                </div>
            </div>
            <div class="row mr-4">
                <div class="col-xl-12">
                    <div class="row">
                        @foreach ($phim as $item)
                            <div class="col-md-2">
                                <a href="{{ route('nhanvien.danhgia.chitietdanhgiaphim',$item->id) }}">
                                    <img width="100%" height="250px" src="{{ asset('storage/' . $item->anh_phim) }}" alt="">
                                    <div>
                                        <p class="block-ellipsis mb-0">{{ $item->ten_phim }}</p>
                                        <p>{{ $item->danh_gias_count }} lượt đánh giá</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- start row -->
        </div> <!-- content -->
    </div>
</div>
@endsection