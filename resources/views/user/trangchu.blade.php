@extends('layout.user')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick-theme.css" />
<script src="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.min.js"></script>
<style>
    .rap-active {
        background-color: #2c7be5;
        border-color: #2c7be5;
        color: #fff;
    }

    .rap-active h1 {
        color: #fff;
    }

    .color-custom {
        color: #6e84a3;
    }

    .slick-prev,
    .slick-next {
        display: none !important;
    }

    .variable-width .slick-slide {
        display: flex;
        justify-content: center;
    }

    .variable-width .slick-slide {
        padding: 0 15px;
        /* Tạo khoảng cách ngang giữa các slide */
    }

    .variable-width img {
        width: 100%;
        /* Đặt width cố định */
        height: auto;
        /* Tự động điều chỉnh chiều cao */
        max-height: 430px;
        /* Chiều cao tối đa */
        object-fit: cover;
        /* Cắt ảnh nếu cần */
    }
</style>
<div style="margin-top: -24px;">
    <div class="variable-width">
        @foreach ($bannerDau as $index => $bn)
            @foreach ($bn->anhBanners as $key => $banner)
                <div>
                    <img src="{{ asset('storage/' . $banner->hinh_anh) }}" class="" alt="..." style="max-height:360px;">
                </div>
            @endforeach
        @endforeach
    </div>
</div>

<main class="container mx-auto px-4 py-8" style="max-width: 80rem;margin: 0 auto;">
    <!-- phim đang chiếu -->
    <section class="mt-12">
        <div class="flex items-center mb-4">
            <div class="w-1 h-6 bg-blue-600 mr-2"></div>
            <p class="text-2xl  text-start text-gray-800">
                Phim đang chiếu
            </p>
        </div>
        <div class="grid grid-cols-4 gap-4">
            @foreach ($phimDangChieu as $item)
                        @php
                            $idyoutube = (str_replace("https://www.youtube.com/watch?v=", "", $item->trailer));
                            $embedUrl = "https://www.youtube.com/embed/" . $idyoutube;
                           @endphp
                        <div class="" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px; border-radius: 10px;">
                            <div class="film-card position-relative">
                                <!-- Hình ảnh của video -->
                                <img alt="Video Thumbnail" class="film-image rounded-lg mb-4"
                                    src="{{ asset('storage/' . $item->anh_phim) }}" onclick="playVideo('{{ $embedUrl }}')"
                                    style="cursor: pointer; filter: contrast(105%);height:400px;" />
                                <a style="text-decoration: none;" href="{{ route('chitietphim', $item->id) }}"
                                    class="hover-enlarge">

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
    </section>
    <!-- Modal để hiển thị video -->
    <div id="videoModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body" style="padding:0px">
                    <iframe id="video" src="" frameborder="0" allowfullscreen
                        style="width: 100%; height: 60vh;"></iframe>
                </div>
            </div>
        </div>
        </section>
</main>
<!-- banner 2 -->
@if ($bannerGiua)
    <div class="text-white text-center py-10">
        <div class="mx-auto">
            <img alt="Promotional banner" class="mx-auto" height="60%"
                src="{{ asset('storage/' . $bannerGiua->anhBanners->first()->hinh_anh) }}" width="80%" />
        </div>
    </div>
@endif
<main class="container mx-auto mt-10" style="max-width: 80rem;margin-left:auto;margin-right:auto;">
    <div class="flex items-center mb-4">
        <div class="w-1 h-6 bg-blue-600 mr-2"></div>
        <p class="text-2xl  text-start text-gray-800">
            Phim sắp chiếu
        </p>
    </div>
    <div class="grid grid-cols-4 gap-4">
        @if(count($phimSapChieu) > 0)
        @foreach ($phimSapChieu as $item)
                @php
                    $idyoutube = (str_replace("https://www.youtube.com/watch?v=", "", $item->trailer));
                    $embedUrl = "https://www.youtube.com/embed/" . $idyoutube;
                   @endphp
                <div class="" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;    border-radius: 10px;">
                    <div class="film-card position-relative">
                        <!-- Hình ảnh của video -->
                        <img alt="Video Thumbnail" class="film-image rounded-lg mb-4"
                            src="{{ asset('storage/' . $item->anh_phim) }}" onclick="playVideo('{{ $embedUrl }}')"
                            style="cursor: pointer; filter: contrast(105%);height:400px;" />
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
        @else
        <h2 class="text-center" style="font-size: 20px;" >Chưa có phim chiếu</h2>
        @endif
    </div>
</main>
<!-- bình luận nổi bật -->
<main class="container mx-auto mt-10" style="max-width: 80rem;margin-left:auto;margin-right:auto;">
    <div class="flex items-center mb-1">
        <div class="w-1 h-6 bg-blue-600 mr-2"></div>
        <p class="text-2xl  text-start text-gray-800">
            Góc điện ảnh
        </p>
    </div>
    <div class="container mx-auto">
        <div class="border-b-2 border-black-500 mb-4">
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
            @foreach ($BaiVietTinTuc as $item)

                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img alt="Image of Lee Seung Gi" class="w-full h-48 object-cover" height="400"
                        src="{{ asset('storage/' . $item->hinh_anh) }}" width="600" />
                    <div class="p-4">
                        <a href="{{ route('tintuc.show',$item->id) }}" style="text-decoration: none;" class="font-semibold">
                            {{ $item->tieu_de }}
                        </a>
                        <p class="text-gray-500 text-sm">
                            {{ number_format($item->luot_xem, 0, ',', '.') }} lượt xem
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


</main>
<script>
    let currDate = "{{ Carbon\Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d') }}"

    const urlLink = "{{ asset('storage/') }}"
    const linkWeb = "{{ asset('') }}"

    const urlApi = "{{ asset('thanh-vien/trang-chu/lich-chieu/rap/') }}"
</script>
<script>
    $('.variable-width').slick({
        dots: true,
        infinite: true,
        speed: 700,
        slidesToShow: 1,
        centerMode: true,
        variableWidth: true,
        autoplay: true,
        autoplaySpeed: 5000
    });
</script>
<script src="{{ asset('js/trangchu.js') }}"></script>
@endsection