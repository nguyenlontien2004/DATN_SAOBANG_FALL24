<style>
    /* Container: giảm khoảng cách giữa logo và navbar */
    .container {
        padding: 0;
        /* Giảm padding của container */
    }

    /* Thẻ d-flex căn chỉnh theo hàng ngang */
    .d-flex {
        display: flex;
        align-items: center;
        /* Căn giữa theo chiều dọc */
    }

    /* Điều chỉnh khoảng cách giữa logo và navbar */
    .ms-0 {
        margin-left: 0;
    }

    .ms-3 {
        margin-left: 15px;
        /* Khoảng cách giữa logo và navbar */
    }

    /* Navbar: Điều chỉnh các item của navbar */
    .navbar-nav {
        margin-left: 0;
        /* Loại bỏ margin thừa */
    }

    .nav-item {
        margin-left: 15px;
        /* Khoảng cách giữa các item trong navbar */
    }

    /* Điều chỉnh style cho nút đăng ký và đăng nhập */
    .btn-custom {
        padding: 10px 20px;
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

    /* Tổng quát cho dropdown */
    .nav-item .dropdown-menu {
        background-color: #ffffff;
        /* Màu nền menu */
        border: 1px solid #ddd;
        /* Viền menu */
        border-radius: 8px;
        /* Bo góc */
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        /* Hiệu ứng đổ bóng */
        padding: 0.5rem 0;
        /* Khoảng cách bên trong */
        min-width: 200px;
        /* Chiều rộng tối thiểu */
    }

    /* Kiểu cho từng item */
    .nav-item .dropdown-item {
        padding: 10px 20px;
        /* Khoảng cách bên trong */
        font-size: 16px;
        /* Cỡ chữ */
        color: #000;
        /* Màu chữ đen */
        text-decoration: none;
        /* Xóa gạch chân */
        transition: background-color 0.3s, color 0.3s;
        /* Hiệu ứng hover */
    }

    /* Hover cho item */
    .nav-item .dropdown-item:hover {
        background-color: #f8f9fa;
        /* Màu nền khi hover */
        color: #000;
        /* Màu chữ vẫn đen khi hover */
    }

    /* Kiểu cho nút dropdown */
    .nav-item .nav-link {
        font-size: 18px;
        /* Cỡ chữ */
        color: #000;
        /* Màu chữ đen */
        font-weight: bold;
        /* Chữ đậm */
        text-decoration: none;
        /* Xóa gạch chân */
        transition: color 0.3s;
        /* Hiệu ứng hover */
    }

    /* Hover cho nút dropdown */
    .nav-item .nav-link:hover {
        color: #555;
        /* Màu xám khi hover */
    }

    /* Hiển thị dropdown mượt */
    .nav-item .dropdown-menu {
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: opacity 0.3s, transform 0.3s;
    }

    /* Hiển thị dropdown khi hover */
    .nav-item:hover .dropdown-menu {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    /* Bo góc cho toàn bộ container */
    .nav-item {
        position: relative;
    }
</style>
<div class="container mb-2">
    <div class="d-flex align-items-center">
        <a href="{{ route('trangchu.member') }}" class="mt-3">
            <img src="https://homepage.momocdn.net/fileuploads/svg/momo-file-240411162904.svg" alt="Logo"
                width="50" height="50" class="ms-0">
        </a>
        <div class="ms-3">
            <nav class="navbar navbar-expand-lg mt-3">
                <div class="container">
                    <ul class="navbar-nav">
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
                                @foreach ($rap as $item)
                                    <li><a class="dropdown-item" href="#">{{ $item->ten_rap }}</a></li>
                                @endforeach
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
                            <a class="nav-link" href="#">Top phim</a>
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
                </div>
            </nav>
        </div>

        <div class="d-flex align-items-center mt-3 ms-auto">
            <form class="d-flex" method="GET" action="{{ route('timkiem') }}">
                <input class="form-control me-2" type="search" name="timkiem" placeholder="Tìm kiếm..."
                    aria-label="Search" value="{{ request('timkiem') }}">
                <button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i></button>
            </form>
            @if (Auth::check())
                <div class="tt ms-4">
                    <a href="{{ route('thongtin3') }}">
                        <img src="{{ asset('storage/' . Auth::user()->anh_dai_dien) }}" alt="đại diện"
                            style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                    </a>
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
