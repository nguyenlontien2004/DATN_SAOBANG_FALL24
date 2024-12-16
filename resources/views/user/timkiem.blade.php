@extends('layout.user')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <main class="container mx-auto px-4 py-8">
        <!-- banner -->
        <section class="bg-pink-200 p-8 rounded-lg flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-pink-600 mb-4">
                    Mua vé xem phim Online trên MoMo
                </h1>
                <p class="text-gray-700 mb-4">
                    Với nhiều ưu đãi hấp dẫn và kết nối với tất cả các rạp lớn phủ rộng
                    khắp Việt Nam. Đặt vé ngay tại MoMo!
                </p>
                <ul class="text-gray-700 mb-4">
                    <li class="flex items-center mb-2">
                        <i class="fas fa-check-circle text-pink-600 mr-2"> </i>
                        Mua vé Online, trải nghiệm phim hay
                    </li>
                    <li class="flex items-center mb-2">
                        <i class="fas fa-check-circle text-pink-600 mr-2"> </i>
                        Đặt vé an toàn trên MoMo
                    </li>
                    <li class="flex items-center mb-2">
                        <i class="fas fa-check-circle text-pink-600 mr-2"> </i>
                        Tha hồ chọn chỗ ngồi, mua bắp nước tiện lợi.
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check-circle text-pink-600 mr-2"> </i>
                        Lịch sử đặt vé được lưu lại ngay
                    </li>
                </ul>
                <button class="bg-pink-600 text-white px-6 py-2 rounded-full">
                    ĐẶT VÉ NGAY
                </button>
            </div>
            <img alt="Promotional Banner" class="rounded-lg" height="200"
                src="https://storage.googleapis.com/a1aa/image/yyDVCIcr3oqJLBUI7Jy23AirAE7VCS2vaOpJSgEyT2fW6yxJA.jpg"
                width="400" />
        </section>
        <!-- Kết quả tìm kiếm -->
        @if ($ketqua1->isNotEmpty() || $ketqua2->isNotEmpty())
            <section class="mt-12">
                <h2 class="text-2xl font-bold text-center text-gray-900 mb-8">
                    Kết quả tìm kiếm
                </h2>
                <div class="grid grid-cols-5 gap-4">
                    @foreach ($ketqua1 as $item)
                        <div class="bg-secondary text-white rounded-lg">
                            <div class="film-card position-relative">
                                <!-- Hình ảnh của video -->
                                <img alt="Video Thumbnail" class="film-image rounded-lg mb-4"
                                    src="https://img.youtube.com/vi/pnSsgRJmsCc/hqdefault.jpg"
                                    onclick="playVideo('https://www.youtube.com/embed/pnSsgRJmsCc?autoplay=1&enablejsapi=1')"
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
                                <p class="text-yellow-500">
                                    <i class="fas fa-star"></i> 6.3
                                </p>
                            </div>
                        </div>
                    @endforeach

                    {{-- Danh sách phim tìm kiếm theo thể loại --}}
                    @foreach ($ketqua2 as $item)
                        @foreach ($item->phims as $tenPhim)
                            <div class="bg-secondary text-white rounded-lg">
                                <div class="film-card position-relative">
                                    <!-- Hình ảnh của video -->
                                    <img alt="Video Thumbnail" class="film-image rounded-lg mb-4"
                                        src="https://img.youtube.com/vi/pnSsgRJmsCc/hqdefault.jpg"
                                        onclick="playVideo('https://www.youtube.com/embed/pnSsgRJmsCc?autoplay=1&enablejsapi=1')"
                                        style="cursor: pointer;" />

                                    <a href="{{ route('chitietphim', $item->id) }}" class="hover-enlarge">
                                        <h3 class="text-lg font-bold film-title">
                                            {{ $tenPhim->ten_phim }}
                                        </h3>
                                    </a>

                                    <p class="film-genre">
                                        {{ $item->ten_the_loai }}
                                    </p>

                                    <p class="text-yellow-500">
                                        <i class="fas fa-star"></i> 6.3
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </section>
        @else
            <h2 class="text-2xl font-bold text-center text-gray-400 mb-8">
                <br>Kết quả tìm kiếm không phù hợp
            </h2>
        @endif
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
        </div>
        </section>
    </main>
@endsection
