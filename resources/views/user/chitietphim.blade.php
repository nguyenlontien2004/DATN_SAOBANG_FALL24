@extends('layout.user')

@section('content')
    <div class="row">
        <!-- Poster -->
        <div class="col-md-4">
            <img src="img/phim1.jfif" class="img-fluid" alt="Poster phim" />
        </div>
        <!-- Movie Details -->
        <div class="col-md-8">
            <h2 class="text-danger">Ngày xưa có một chuyện tình</h2>
            <p>
                <strong>Thể loại:</strong>
                Lãng mạn
            </p>
            <p>
                <strong>Thời lượng:</strong>
                120 phút
            </p>
            <p>
                <strong>Diễn viên:</strong>
                Diễn viên 1, Diễn viên 2, Diễn viên 3
            </p>
            <p>
                <strong>Đạo diễn:</strong>
                Đạo diễn nổi tiếng
            </p>
            <p>
                <strong>Mô tả:</strong>
                Một câu chuyện tình đầy cảm xúc, đưa khán giả vào hành trình tình
                yêu giữa những rắc rối và cảm xúc sâu sắc. Bộ phim kể về một mối
                tình lãng mạn đầy kịch tính và cảm xúc.
            </p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <button class="btn btn-danger me-md-2" type="button">
                    Mua vé ngay
                </button>
                <button class="btn btn-outline-secondary" type="button">
                    Thêm vào yêu thích
                </button>
            </div>
            <div class="bip m-3">
                <div class="button-container123">
                    <a href="#" class="button123 trailer">
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
    <div class="row">
        <!-- Phần lịch chiếu bên trái -->
        <div class="col-md-8">
            <div class="border p-3">
                <!-- Tiêu đề và chọn thành phố -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3>Lịch chiếu cầm</h3>
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
            <div class="border p-3">
                <h5>Phim đang chiếu</h5>
                <ul class="list-unstyled">
                    <li class="border-bottom py-2">
                        <img src="img/phim1.jfif" alt="Phim 1" class="img-fluid me-2" style="width: 50px" />
                        Phim 1 - Phim tình cảm
                    </li>
                    <li class="border-bottom py-2">
                        <img src="img/phim1.jfif" alt="Phim 2" class="img-fluid me-2" style="width: 50px" />
                        Phim 2 - Phim tình cảm
                    </li>
                    <li class="border-bottom py-2">
                        <img src="img/phim1.jfif" alt="Phim 3" class="img-fluid me-2" style="width: 50px" />
                        Phim 3 - Phim tình cảm
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Bình luận người xem -->
    <div class="container my-5">
        <h3>Bình luận người xem</h3>
        <div class="d-flex mb-3">
            <img src="user.png" alt="User" class="rounded-circle me-3" style="width: 50px" />
            <div>
                <h5>Title</h5>
                <p class="text-muted">Description</p>
                <p>Mình đi xem 1m do tò mò vì phần trailer khá cuốn...</p>
            </div>
        </div>
        <div class="d-flex">
            <img src="user.png" alt="User" class="rounded-circle me-3" style="width: 50px" />
            <div>
                <h5>Title</h5>
                <p class="text-muted">Description</p>
                <p>Mình đi xem 1m do tò mò vì phần trailer khá cuốn...</p>
            </div>
        </div>
    </div>
@endsection
