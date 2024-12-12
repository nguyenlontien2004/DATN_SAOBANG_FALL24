@extends('layout.user')
@section('content')
    <div class="container" style="max-width: 80rem;margin: 0 auto">
        <div>
   <p class="mb-3" style="font-size: 25px;font-weight: 400;">Danh sách phim</p>
   </div>

        <!-- Movies Grid -->

        <div class="grid grid-cols-4 gap-4">
            @foreach ($danhSachPhim as $item)
            @php
                            $idyoutube = (str_replace("https://www.youtube.com/watch?v=", "", $item->trailer));
                            $embedUrl = "https://www.youtube.com/embed/" . $idyoutube;
                           @endphp
                <div class="">
                    <div  style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px; border-radius: 10px;">
                        <div class="film-card position-relative flex-grow-1">
                            <!-- Hình ảnh của video -->
                            <img alt="Video Thumbnail" class="film-image rounded-lg mb-4"
                                src="{{ asset('storage/'.$item->anh_phim )}}"
                                onclick="playVideo('{{ $embedUrl }}')"
                                style="cursor: pointer; width: 100%; filter: contrast(105%);height:410px;" />
                            <a href="{{ route('chitietphim', $item->id) }}" class="hover-enlarge">
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
                </div>
            @endforeach

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
        </div>




        <br>{{ $danhSachPhim->links('pagination::bootstrap-5') }}
        <br>
    </div>
@endsection
