<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <a href="/" class="mt-3">
            <img src="https://homepage.momocdn.net/fileuploads/svg/momo-file-240411162904.svg" alt="Logo"
                width="50" height="50" class="ms-5">
        </a>
        <div class="d-flex align-items-center">
            <nav class="navbar navbar-expand-lg mt-3">
                <div class="container">
                    <ul class="navbar-nav mx-auto">
                        <!-- Lịch chiếu Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="lichChieuDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Lịch chiếu
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="lichChieuDropdown">
                                <li><a class="dropdown-item" href="#">Option 1</a></li>
                                <li><a class="dropdown-item" href="#">Option 2</a></li>
                            </ul>
                        </li>
                        <!-- Rạp chiếu Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="rapChieuDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Rạp chiếu
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="rapChieuDropdown">
                                <li><a class="dropdown-item" href="#">Option 1</a></li>
                                <li><a class="dropdown-item" href="#">Option 2</a></li>
                            </ul>
                        </li>
                        <!-- Phim đang chiếu -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('phimdangchieu') }}">Phim chiếu</a>
                        </li>
                        <!-- Danh sách phim -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('danhsachphim') }}">Danh sách phim</a>
                        </li>

                        <!-- Top phim Link -->
                        <li class="nav-item">

                            <a class="nav-link" href="{{ route('tintuc.hienthi') }}">Tin tức</a>
                        </li>
                        <!-- Blog phim Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="blogPhimDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Blog phim
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="blogPhimDropdown">
                                <li><a class="dropdown-item" href="#">Option 1</a></li>
                                <li><a class="dropdown-item" href="#">Option 2</a></li>
                            </ul>
                        </li>
                    </ul>

                    <form class="d-flex" method="GET" action="#">
                        <input class="form-control me-2" type="search" name="timkiem" placeholder="Tìm kiếm..."
                            aria-label="Search" value="{{ request('timkiem') }}">
                        <button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                    @if (Auth::check())
                        <div class="tt ms-4">
                            <form action="{{ route('dangxuat') }}" method="POST">
                                @csrf
                                <button type="submit">Đăng xuất</button>
                            </form>
                            <a href="{{ route('thongtin3') }}"> Thông tin cá nhân</a>
                            <a href="{{ route('trangchu.member') }}"> Trangc hủ</a>

                        </div>
            </nav>
            <div class="d-flex align-items-center mt-3">
                <form class="d-flex" method="GET" action="{{ route('timkiem') }}">
                    <input class="form-control me-2" type="search" name="timkiem" placeholder="Tìm kiếm..."
                        aria-label="Search" value="{{ request('timkiem') }}">
                    <button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i></button>
                </form>
                @if (Auth::check())
                    <div class="tt ms-4">
                        <a href="#"> <img src="" alt="đại diện"></a>
                        <form action="{{ route('dangxuat') }}" method="POST">
                            @csrf
                            <button class="btn btn-secondary btn-custom" type="submit">Đăng xuất</button>
                        </form>

                        <a href="{{ route('thongtin3') }}"> Thông tin cá nhân</a>
                        <a href="{{ route('trangchu.member') }}"> Trangchủ</a>
                    </div>
                @else
                    <ul class="menu d-flex align-items-center mb-0 ms-3">
                        <li class="xam ms-2">
                            <a class="btn btn-secondary btn-custom" href="{{ route('dangky') }}">Đăng Ký</a>
                        </li>
                        <li class="xam ms-2">
                            <a class="btn btn-secondary btn-custom" href="{{ route('dangnhap') }}">Đăng Nhập</a>

                        </li>
                    </ul>
                @endif
            </div>
        </div>
    </div>

    <style>
        .btn-custom {
            padding: 10px 20px;
            /* Thay đổi kích thước nút */
            border-radius: 25px;
            /* Bo góc nút */
            transition: background-color 0.3s, color 0.3s;
            /* Hiệu ứng chuyển màu */
        }

        .btn-custom:hover {
            background-color: #0056b3;
            /* Màu nền khi hover */
            color: white;
            /* Màu chữ khi hover */
        }

        .xam a {
            text-decoration: none;
            /* Bỏ gạch chân cho chữ */
        }
    </style>
