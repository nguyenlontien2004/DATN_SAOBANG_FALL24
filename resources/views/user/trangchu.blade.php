@extends('layout.user')

@section('content')
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
</style>
    <div class="slide container-fluid" style="padding:0 0;margin-top: -24px;">
        <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
            <!-- Carousel Inner -->
            <div class="carousel-inner">
                @foreach ($bannerDau as $index => $bn)
                @foreach ($bn->anhBanners as $key => $banner)
                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}" data-bs-interval="2000">
                            <img src="{{ asset('storage/' . $banner->hinh_anh) }}" class="d-block w-100 img-fluid"
                                alt="..." style="max-height:500px;object-fit:fill;">
                        </div>
                    @endforeach       
                @endforeach
            </div>

            <!-- Carousel Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <main class="container mx-auto px-4 py-8" style="max-width: 80rem;margin: 0 auto;">
        <!-- phim đang chiếu -->
        <section class="mt-12">
            <h2 class="text-2xl font-bold text-center text-gray-900 mb-8">
                Phim đang chiếu
            </h2>
            <div class="grid grid-cols-5 gap-4">
                @foreach ($phimDangChieu as $item)
                @php
               $idyoutube = (str_replace("https://www.youtube.com/watch?v=", "", $item->trailer));
               $embedUrl = "https://www.youtube.com/embed/" . $idyoutube;
               @endphp
                    <div class="bg-secondary text-white rounded-lg">
                        <div class="film-card position-relative">
                            <!-- Hình ảnh của video -->
                            <img alt="Video Thumbnail" class="film-image rounded-lg mb-4"
                                src="{{ asset('storage/'.$item->anh_phim) }}"
                                onclick="playVideo('{{ $embedUrl }}')"
                                style="cursor: pointer;" />
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
    <!-- lịch chiếu phim -->
    <div class="container mx-auto p-4" style="max-width: 80rem;margin: 0 auto;">
        <h1 class="text-center text-pink-600 text-3xl font-bold mb-4">
            Lịch chiếu phim
        </h1>
        <div class="container mb-4" style="max-width: 80rem;margin: 0 auto;">
    <div class="row">
        <div class="col-md-3">
            <div class="table-responsive table-food">
                <table class="mb-0">
                    <thead>
                        <tr>
                            <th style="color:black;font-size:12.5px;font-weight:600;background-color: #edf2f9;">Rạp
                                chiếu
                            </th>
                            <th style="background-color: #edf2f9;"></th>
                            <th style="background-color: #edf2f9;"></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div>
                    @foreach ($danhsachrap as $key => $item)
                        <div data-idrap="{{ $item->id }}" class="danhsachrap {{ $key == 0 ? 'rap-active' : '' }}"
                            style="border-bottom: 0.3px solid #e8e8e8;">
                            <div class="text-start" style="padding: 0.85em 15px;cursor: pointer;">
                                <h1 class="mb-0 color-custom" style="font-size: 0.95rem;font-weight: 500;">
                                    {{ $item->ten_rap }}
                                </h1>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="box-data d-inline-flex justify-content-around mb-2" style="width:100%">
                @for ($i = 0; $i <= count($listday) - 1; $i++) @if (
                        Carbon\Carbon::now('Asia/Ho_Chi_Minh')->
                            format('d-m') == $listday[$i]['date']
                    )
                                <div class="chooseDate btn-custom1 text-muteds btn-light border-right-custom active-date"
                                    data-date="{{$listday[$i]['ngaychuan']}}">{{ $listday[$i]['date'] }} <br> <span
                                        style="font-size: .8265rem;font-weight:400;">{{ $listday[$i]['day'] }}</span>
                                </div>
                @elseif($i == count($listday) - 1)
                    <div class="chooseDate btn-custom1 text-muteds btn-light border-left-custom"
                        data-date="{{$listday[$i]['ngaychuan']}}">{{ $listday[$i]['date'] }} <br> <span
                            style="font-size: .8265rem;font-weight:400;">{{ $listday[$i]['day'] }}</span>
                    </div>
                @else
                    <div class="chooseDate btn-custom1 text-muteds btn-light border-right-custom border-left-custom"
                        data-date="{{$listday[$i]['ngaychuan']}}">{{ $listday[$i]['date'] }}<br> <span
                            style="font-size: .8265rem;font-weight:400;">{{ $listday[$i]['day'] }}</span>
                    </div>
                @endif
                @endfor
            </div>
            <!-- <div class="alert d-flex align-items-center mt-2" style="background-color: #f6c343; padding:13px 20px;"
                role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-info">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M12 16v-4" />
                    <path d="M12 8h.01" />
                </svg>
                <span class="ms-2">Nhấn vào suất chiếu để tiến hành mua vé</span>
            </div> -->
            <!-- suất chiếu phim ở có ở trong rạp -->
            <div style="position: relative;">
                <span class="loader loading-suat" style="position: absolute;top:3px;left:50%;display:none;"></span>
                <div class="suatchieuphim">

                    <!-- <div class="cart-movie mb-2">
                        <div class="row mt-3 mb-3 ms-1 mr-1">
                            <div class="col-2 col-sm-2">
                                <a class="">
                                    <img class="radius7px" width="95px"
                                        src="https://cdn.moveek.com/storage/media/cache/mini/672109204e009437900999.jpg"
                                        alt="">
                                </a>
                            </div>
                            <div class="col" style="margin-left: -14px;">
                                <h2 class="mb-1" style="color:#12263f;font-weight: 500;">Linh Miêu: Quỷ Nhập Tràng</h2>
                                <div>
                                    <label style="color:#12263f;font-weight: 500;font-size: 13.5px;">Suất chiếu</label>
                                    <div class="d-flex flex-wrap">
                                        <a href="" class="">
                                            <div class="btn-somtime mr-1">08:00~09:30</div>
                                        </a>
                                        <a href="" class="">
                                            <div class="btn-somtime mr-1">08:00~09:30</div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>

        </div>
    </div>
</div>
    </div>  
    <!-- banner 2 -->
    @if ($bannerGiua)
        <div class="text-white text-center py-10">
            <div class="container mx-auto">
                <img alt="Promotional banner" class="mx-auto" height="100"
                    src="{{ asset('storage/' . $bannerGiua->anhBanners->first()->hinh_anh) }}" width="600" />
            </div>
        </div>
    @endif
    <!-- bình luận nổi bật -->
    <main class="container mx-auto mt-10" style="max-width: 80rem;margin: 0 auto;">
        <h2 class="text-3xl font-bold text-center text-pink-600 mb-8">
            Tin tức mới
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg shadow-md p-4">
                <img alt="Movie poster for CẤM" class="rounded-lg mb-4" height="400"
                    src="https://storage.googleapis.com/a1aa/image/J86HwvsSZm43A9gBNr7YqfEeFFvYjCOU6OaY3twSbQ1JAmjTA.jpg"
                    width="600" />
                <div class="flex items-center justify-between mb-2">
                    <span class="text-lg font-bold"> CẤM </span>
                    <div class="flex items-center">
                        <span class="text-sm text-gray-500 mr-2">
                            <i class="fas fa-star text-yellow-500"> </i>
                            6.3
                        </span>
                        <span class="text-sm text-gray-500">
                            <i class="fas fa-comment"> </i>
                            6K
                        </span>
                    </div>
                </div>
                <div class="text-sm text-gray-500 mb-4">
                    Nguyen Van Khuong - 29/09/2024
                </div>
                <p class="text-sm text-gray-700 mb-4">
                    Thấy phim OK mà bị mọi người chê dữ, có bạn chê truyện nhưng tình
                    tiết bị đơ. Công tâm mà nói thì so với mặt bằng ở Việt Nam...
                </p>
                <a class="text-pink-600 text-sm" href="#"> Xem thêm </a>
            </div>
            <div class="bg-white rounded-lg shadow-md p-4">
                <img alt="Movie poster for Làm Giàu Với Ma" class="rounded-lg mb-4" height="400"
                    src="https://storage.googleapis.com/a1aa/image/JXzImuS4nU7qLN5QrAK2KfQ3ag8IN2R2OxJEU6sYl5BDAzxJA.jpg"
                    width="600" />
                <div class="flex items-center justify-between mb-2">
                    <span class="text-lg font-bold"> Làm Giàu Với Ma </span>
                    <div class="flex items-center">
                        <span class="text-sm text-gray-500 mr-2">
                            <i class="fas fa-star text-yellow-500"> </i>
                            5.5
                        </span>
                        <span class="text-sm text-gray-500">
                            <i class="fas fa-comment"> </i>
                            5.5K
                        </span>
                    </div>
                </div>
                <div class="text-sm text-gray-500 mb-4">
                    Nguyen Thi My Hien - 08/09/2024
                </div>
                <p class="text-sm text-gray-700 mb-4">
                    Phim làm khá hay về gia đình dân tộc và đề tài về ma. Thể hiện được
                    tình cảm cha mẹ đến với giới trẻ...
                </p>
                <a class="text-pink-600 text-sm" href="#"> Xem thêm </a>
            </div>
            <div class="bg-white rounded-lg shadow-md p-4">
                <img alt="Movie poster for Minh Hôn" class="rounded-lg mb-4" height="400"
                    src="https://storage.googleapis.com/a1aa/image/LfZK9uvw2bxMUi7p9eNm7hBJRGj1FVEWH78TcbWebWfgAYOOB.jpg"
                    width="600" />
                <div class="flex items-center justify-between mb-2">
                    <span class="text-lg font-bold"> Minh Hôn </span>
                    <div class="flex items-center">
                        <span class="text-sm text-gray-500 mr-2">
                            <i class="fas fa-star text-yellow-500"> </i>
                            4.2
                        </span>
                        <span class="text-sm text-gray-500">
                            <i class="fas fa-comment"> </i>
                            1.2K
                        </span>
                    </div>
                </div>
                <div class="text-sm text-gray-500 mb-4">
                    Tran Phuong Thao - 2 giờ trước
                </div>
                <p class="text-sm text-gray-700 mb-4">
                    Chưa bao giờ xem 1 bộ điển như này tốn tiền quá bây ơi!
                </p>
                <a class="text-pink-600 text-sm" href="#"> Xem thêm </a>
            </div>
        </div>
    </main>
    <script>
    let currDate = "{{ Carbon\Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d') }}"
   
    const urlLink = "{{ asset('storage/') }}"
    const linkWeb = "{{ asset('') }}"
 let idrap = "{{ $danhsachrap[0]->id }}"
    const urlApi = "{{ asset('thanh-vien/lich-chieu/phim-rap/') }}"
</script>
<script src="{{ asset('js/lichchieu.js') }}"></script>
@endsection