@extends('layout.user')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <div class="container mt-5">
        <div class="row">
            <!-- Poster -->
            <div class="col-md-4">
                <div class="me-3">
                    <!-- Hình ảnh của video -->
                    <img alt="Video Thumbnail" class="img-fluid rounded film-image"
                        src="https://img.youtube.com/vi/pnSsgRJmsCc/hqdefault.jpg"
                        onclick="playVideo('https://www.youtube.com/embed/pnSsgRJmsCc?autoplay=1&enablejsapi=1')"
                        style="cursor: pointer; width: 500px; height: auto;" />
                </div>
            </div>
            <!-- Movie Details -->
            <div class="col-md-8">
                <h2 class="text-danger">{{ $chiTietPhim->ten_phim }}</h2>
                <p>
                    <strong>Thể loại:</strong>
                    @foreach ($chiTietPhim->theLoaiPhims as $theLoaiPhim)
                        {{ $theLoaiPhim->ten_the_loai }}@if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </p>
                <p>
                    <strong>Thời lượng:</strong>
                    {{ $chiTietPhim->thoi_luong }}p
                </p>
                <p>
                    <strong>Diễn viên chính:</strong>
                    @foreach ($chiTietPhim->dienViens as $dienVien)
                        {{ $dienVien->ten_dien_vien }}@if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </p>
                <p>
                    <strong>Đạo diễn chính:</strong>
                    @foreach ($chiTietPhim->daoDiens as $daoDien)
                        {{ $daoDien->ten_dao_dien }}@if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </p>
                <p>
                    <strong>Mô tả:</strong>
                    {{ $chiTietPhim->mo_ta }}
                </p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <a href="{{ route('datve') }}">
                        <button class="btn btn-danger me-md-2" type="button">
                            Mua vé ngay
                        </button>
                    </a>
                    <button class="btn btn-outline-secondary" type="button">
                        Thêm vào yêu thích
                    </button>
                </div>
                <div class="bip m-3">
                    <div class="button-container123">
                        <a href="#" class="button123 trailer"
                            onclick="playVideo('https://www.youtube.com/embed/pnSsgRJmsCc?autoplay=1&enablejsapi=1')">
                            <i class="fas fa-play"></i>
                            <span>Xem trailer</span>
                        </a>
                        <a href="#" class="button123 review">
                            <i class="fas fa-star"></i>
                            <span>Xem review</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
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
        <div class="row">
            <!-- Phần lịch chiếu bên trái -->
            <div class="col-md-8">
                <div class="border p-3">
                    <!-- Tiêu đề và chọn thành phố -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3>Lịch chiếu: <strong>{{ $chiTietPhim->ten_phim }}</strong></h3>
                        <div>
                            <label for="city-select" class="form-label me-2">Chọn thành phố:</label>
                            <select class="form-select" id="city-select" style="width: auto">
                                <option selected>Hà Nội</option>
                                <option value="Hồ Chí Minh">Hồ Chí Minh</option>
                                <option value="Đà Nẵng">Đà Nẵng</option>
                                <option value="Hải Phòng">Hải Phòng</option>
                                <option value="Cần Thơ">Cần Thơ</option>
                            </select>
                        </div>
                    </div>

                    <!-- Nội dung lịch chiếu -->
                    <div class="border p-3 mb-3">
                        <div class="d-flex justify-content-around mb-2">
                            <div><button class="btn btn-outline-info">20/9</button></div>
                            <div><button class="btn btn-outline-info">20/9</button></div>
                            <div><button class="btn btn-outline-info">20/9</button></div>
                            <div><button class="btn btn-outline-info">20/9</button></div>
                            <div><button class="btn btn-outline-info">20/9</button></div>
                            <div><button class="btn btn-outline-info">20/9</button></div>
                        </div>
                        <div class="border p-2">
                            <p><strong>CGV:</strong> Beta Đan Phượng</p>
                            <p>Tầng 2, Tòa nhà HHA, Khu đô thị XPHomes...</p>
                        </div>
                        <div class="border p-2">
                            <p><strong>CGV:</strong> Beta Đan Phượng</p>
                            <p>Tầng 2, Tòa nhà HHA, Khu đô thị XPHomes...</p>
                        </div>
                        <div class="border p-2">
                            <p><strong>CGV:</strong> Beta Đan Phượng</p>
                            <p>Tầng 2, Tòa nhà HHA, Khu đô thị XPHomes...</p>
                        </div>
                        <div class="border p-2">
                            <p><strong>CGV:</strong> Beta Đan Phượng</p>
                            <p>Tầng 2, Tòa nhà HHA, Khu đô thị XPHomes...</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Phần phim đang chiếu bên phải -->
            <div class="col-md-4">
                <div class="border p-3 bg-light rounded">
                    <h5 class="text-dark fw-bold mb-3">Phim đang chiếu</h5>
                    <ul class="list-unstyled">
                        @foreach ($phimDangChieu as $item)
                            <li class="border-bottom pb-3 mb-3">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <!-- Hình ảnh của video -->
                                        <img alt="Video Thumbnail" class="img-fluid rounded film-image"
                                            src="https://img.youtube.com/vi/pnSsgRJmsCc/hqdefault.jpg"
                                            onclick="playVideo('https://www.youtube.com/embed/pnSsgRJmsCc?autoplay=1&enablejsapi=1')"
                                            style="cursor: pointer; width: 100px; height: auto;" />
                                    </div>
                                    <div class="flex-grow-1">
                                        <a href="{{ route('chitietphim', $item->id) }}"
                                            class="text-decoration-none text-warning">
                                            <h6 class="mb-1 fw-bold film-title">{{ $item->ten_phim }}</h6>
                                        </a>
                                        <p class="small text-muted mb-1 film-genre">
                                            @foreach ($item->theLoaiPhims as $theLoaiPhim)
                                                {{ $theLoaiPhim->ten_the_loai }}@if (!$loop->last)
                                                    ,
                                                @endif
                                            @endforeach
                                        </p>
                                        <p class="mb-0 text-warning">
                                            <i class="fas fa-star"></i> 6.3
                                        </p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>

        <!-- Bình luận người xem -->
        <div class="container my-5">
            <h3>Bình luận người xem</h3>

            <!-- Bình luận 1 -->
            <div class="d-flex mb-4">
                <img src="user.png" alt="User" class="rounded-circle me-3" style="width: 40px; height: 40px;" />
                <div style="background-color: #f0f2f5; border-radius: 18px; padding: 10px 15px; max-width: 600px;">
                    <h6 class="mb-1" style="font-weight: bold;">User Name <span class="text-muted"
                            style="font-size: 12px;">1 giờ trước</span></h6>
                    <p class="mb-1" style="font-size: 14px; color: #333;">Mình đi xem 1m do tò mò vì phần trailer khá
                        cuốn...</p>
                    <div style="font-size: 12px; color: #65676b;">
                        <a href="#" class="text-decoration-none me-3">Thích</a>
                        <a href="#" class="text-decoration-none me-3">Trả lời</a>
                    </div>
                </div>
            </div>
            <!-- Bình luận 2 -->
            <div class="d-flex mb-4">
                <img src="user.png" alt="User" class="rounded-circle me-3" style="width: 40px; height: 40px;" />
                <div style="background-color: #f0f2f5; border-radius: 18px; padding: 10px 15px; max-width: 600px;">
                    <h6 class="mb-1" style="font-weight: bold;">User Name <span class="text-muted"
                            style="font-size: 12px;">1 giờ trước</span></h6>
                    <p class="mb-1" style="font-size: 14px; color: #333;">Mình đi xem 1m do tò mò vì phần trailer khá
                        cuốn...</p>
                    <div style="font-size: 12px; color: #65676b;">
                        <a href="#" class="text-decoration-none me-3">Thích</a>
                        <a href="#" class="text-decoration-none me-3">Trả lời</a>
                    </div>
                </div>
            </div>

            <div class="container my-5">
                <!-- Nội dung bình luận -->
                @auth
                    <div class="d-flex mt-4">
                        <img src="user.png" alt="User" class="rounded-circle me-3" style="width: 40px; height: 40px;" />
                        <div class="flex-grow-1" style="max-width: 500px;">
                            <textarea class="form-control" placeholder="Viết bình luận của bạn..." rows="1"
                                style="border-radius: 20px; resize: none; overflow: hidden; width: 100%;" oninput="autoResize(this)"></textarea>
                            <div class="mt-2 d-flex justify-content-end">
                                <button class="btn btn-primary btn-sm" style="border-radius: 20px;">Đăng</button>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Thông báo khi chưa đăng nhập -->
                    <div class="mt-4">
                        <p class="text-muted">Bạn cần <a href="{{ route('login') }}"><strong>đăng nhập</strong></a> để bình luận.</p>
                    </div>
                @endauth
            </div>
        </div>
    </div>
@endsection
