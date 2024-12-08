@extends('layout.user')

@section('content')
    <div class="slide container-fluid">
        <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
            <!-- Carousel Inner -->
            <div class="carousel-inner">
                @foreach ($bannerDau as $index => $bn)
                    @foreach ($bn->anhBanners as $key => $banner)
                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}" data-bs-interval="2000">
                            <img src="{{ asset('storage/' . $banner->hinh_anh) }}" class="d-block w-100 img-fluid"
                                alt="...">
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

    <main class="container mx-auto px-4 py-8">
        <!-- phim đang chiếu -->
        <section class="mt-12">
            <h2 class="text-2xl font-bold text-center text-gray-900 mb-8">
                Phim đang chiếu
            </h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @foreach ($phimDangChieu as $item)
                    <div class="bg-secondary text-white rounded-lg h-auto">
                        <div class="film-card position-relative">
                            <!-- Hình ảnh của video -->
                            <img alt="Video Thumbnail" class="film-image rounded-lg mb-4 w-full h-48 object-cover"
                                src="{{ asset('storage/' . $item->anh_phim) }}"
                                onclick="playVideo('https://www.youtube.com/embed/pnSsgRJmsCc?autoplay=1&enablejsapi=1')"
                                style="cursor: pointer;" />
                            <a href="{{ route('chitietphim', $item->id) }}" class="hover-enlarge">
                                <h3 class="text-lg font-bold film-title truncate">
                                    {{ $item->ten_phim }}
                                </h3>
                            </a>
                            <p class="film-genre text-sm">
                                @foreach ($item->theLoaiPhims as $theLoaiPhim)
                                    {{ $theLoaiPhim->ten_the_loai }}@if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </p>
                            <p class="text-yellow-500 text-sm">
                                <i class="fas fa-star"></i> 6.3
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Modal để hiển thị video -->
        <div id="videoModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" onclick="closeModal()">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <iframe id="video" src="" frameborder="0" allowfullscreen
                            style="width: 100%; height: 60vh;"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- banner 2 -->
    @if ($bannerGiua)
        <div class="text-white text-center py-10">
            <div class="container mx-auto">
                <img alt="Promotional banner" class="mx-auto" height="100"
                    src="{{ asset('storage/' . $bannerGiua->anhBanners->first()->hinh_anh) }}" width="600" />
            </div>
        </div>
    @else
        <p>No banner found.</p>
    @endif

    <!-- bình luận nổi bật -->
    <main class="container mx-auto mt-10">
        <h2 class="text-3xl font-bold text-center text-pink-600 mb-8">
            Phim sắp chiếu
        </h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @foreach ($phimSapChieu as $phim)
                <div class="bg-white rounded-lg shadow-md p-4 flex flex-col justify-between h-full">
                    <img alt="Poster phim {{ $phim->ten_phim }}" class="rounded-lg mb-4 w-full object-cover h-48"
                        src="{{ asset('storage/' . $phim->anh_phim) }}" />
                    <div class="flex flex-col justify-between h-full">
                        <span class="text-lg font-bold">{{ $phim->ten_phim }}</span>
                        <p class="text-sm text-gray-700 mb-4">
                            {!! Str::limit($phim->mo_ta, 100) !!}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center m-4">
            <button class="bg-pink-600 text-white py-2 px-4 rounded hover:bg-pink-700">
                Xem tiếp nhé!
            </button>
        </div>
    </main>
@endsection
