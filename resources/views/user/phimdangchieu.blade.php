@extends('layout.user')
@section('title')
{{ $title }}
@endsection
<style>
    .form-select:focus {
        border-color: none;
        outline: 0;
        box-shadow: none !important;
    }
</style>
@section('content')
<div class="container" style="max-width: 80rem;margin: 0 auto;">
    <div class="d-flex align-items-center mb-4" style="justify-content: space-between;">
        <p class="" style="font-size: 25px;font-weight: 400;">Phim đang chiếu</p>
        <form id="loctheloai" action="{{ route('phimdangchieu') }}" class="ms-4" method="get">
            <select class="form-select" name="the-loai" aria-label="Default select example" 
            onchange="document.getElementById('loctheloai').submit();">
                <option value="" selected>Lọc theo thể loại</option>
                <option value="all" >Tất cả thể loại</option>
                @foreach ($theloai as $item)
                   <option value="{{ $item->id }}">{{ $item->ten_the_loai }}</option>
                @endforeach
            </select>
        </form>
    </div>
    <!-- Movies Grid -->

    <div class="grid grid-cols-4 gap-4">
        @foreach ($phimDangChieu as $item)
                @php
                    $idyoutube = (str_replace("https://www.youtube.com/watch?v=", "", $item->trailer));
                    $embedUrl = "https://www.youtube.com/embed/" . $idyoutube;
                   @endphp
                <div style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px; border-radius: 10px;">
                    <div class="film-card position-relative">
                        <!-- Hình ảnh của video -->
                        <img alt="Video Thumbnail" class="film-image rounded-lg mb-4"
                            src="{{ asset('storage/' . $item->anh_phim) }}" onclick="playVideo('{{ $embedUrl }}')"
                            style="cursor: pointer; filter: contrast(105%);height:410px;" />
                        <a style="text-decoration: none;" href="{{ route('chitietphim', $item->id) }}" class="hover-enlarge">

                            <h3 class="text-lg font-bold film-title">
                                {{ $item->ten_phim }}
                            </h3>
                        </a>
                        <p class="film-genre">
                            @foreach ($item->theLoaiPhims as $theLoaiPhim)
                                {{ $theLoaiPhim->ten_the_loai }}@if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </p>
                        <!-- <p class="text-yellow-500">
                                                                                                    <i class="fas fa-star"></i> 6.3
                                                                                                </p> -->
                    </div>
                </div>
        @endforeach
    </div>

    <!-- Modal cho video -->
    <div id="videoModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body" style="padding:0px">
                    <iframe id="video" src="" frameborder="0" allowfullscreen
                        style="width: 100%; height: 60vh;"></iframe>
                </div>
            </div>
        </div>
    </div>




    {{-- <br>{{ $danhSachPhim->links('pagination::bootstrap-5') }} --}}
    <br>
</div>
@endsection