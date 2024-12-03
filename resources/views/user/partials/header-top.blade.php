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

    .container-link-page a {
        text-decoration: none;
    }
</style>
<div class="container mb-2">
    <div class="header-navigation">
        <div class="wrapper" style="max-width: 80rem;">
            <div class="nav-link">
                <a href="{{ route('trangchu.member') }}" class="logo">
                    <img src="	https://homepage.momocdn.net/fileuploads/svg/momo-file-240411162904.svg" />
                </a>
                <a class="img-book-tocket" style="text-decoration: none;">
                    <img src="https://homepage.momocdn.net/img/momo-amazone-s3-api-240808153440-638587280804204391.svg"
                        alt="">
                    <div>
                        Đặt vé <br>
                        xem phim
                    </div>
                </a>
                <div class="container-link-page">
                    <nav>
                        <div class="d-flex">
                            <li><a href="{{ route('lichchieuphimclient') }}">Lịch chiếu</a></li>
                            <li><a class="d-flex align-items-center" href="{{ route('rap') }}">Rạp <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 25 25" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-chevron-down">
                                        <path d="m6 9 6 6 6-6" />
                                    </svg></a></li>
                            <li><a href="{{ route('phimdangchieu') }}">Phim chiếu</a></li>
                            <li><a href="{{ route('danhsachphim') }}">Danh sách phim</a></li>
                            <li><a href="{{ route('tintuc.hienthi') }}">Tin tức</a></li>
                            <li><a href="">Block phim</a></li>
                        </div>
                    </nav>
                </div>
                <div class="flex-grow-1 action-header">
                    <form class="form-search d-flex w-auto align-items-center" method="GET"
                        action="{{ route('timkiem') }}">
                        <div>
                            <input class="" type="text" name="timkiem" placeholder="Từ khoá tìm kiếm..."
                                value="{{ request('timkiem') }}">
                        </div>
                        <button type="submit" class="icon-search">
                            <svg xmlns="http://www.w3.org/2000/svg" style="color: #767676;" width="20" height="20"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search">
                                <circle cx="11" cy="11" r="8" />
                                <path d="m21 21-4.3-4.3" />
                            </svg>
                        </button>
                    </form>
                    <div class="user-action" style="overflow: none !important;">
                        @if (Auth::check())
                            <div>
                                <a href="{{ route('thong-tin-nguoi-dung') }}">
                                    <img src="{{ Auth::user()->anh_dai_dien != "" ? asset('storage/' . Auth::user()->anh_dai_dien) : 'https://cdn.moveek.com/bundles/ornweb/img/no-avatar.png' }}"
                                        alt="đại diện" style="border-radius: 50%; object-fit: cover;">
                                </a>
                            </div>
                        @else
                            <div class="dropdown">
                                <img class="dropdown-toggle" style="border-radius: 50%;" type="button"
                                    id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"
                                    src="https://cdn.moveek.com/bundles/ornweb/img/no-avatar.png" alt="">

                                <ul class="menu dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li class="dropdown-item">
                                        <a style="text-decoration: none;" href="{{ route('dangky') }}">Đăng Ký</a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a style="text-decoration: none;" href="{{ route('dangnhap') }}">Đăng Nhập</a>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="d-flex align-items-center">
        <a href="{{ route('trangchu.member') }}" class="mt-3">
            <img src="https://homepage.momocdn.net/fileuploads/svg/momo-file-240411162904.svg" alt="Logo" width="50"
                height="50" class="ms-0">
        </a>
        <div class="ms-3">
            <nav class="navbar navbar-expand-lg mt-3">
                <div class="container">
                    <ul class="navbar-nav">
                        Lịch chiếu Dropdown 
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
                         Rạp chiếu Dropdown
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
                         Phim đang chiếu
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('phimdangchieu') }}">Phim chiếu</a>
                        </li>
                         Danh sách phim
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('danhsachphim') }}">Danh sách phim</a>
                        </li>

                         Top phim Link
                        <li class="nav-item">

                            <a class="nav-link" href="{{ route('tintuc.hienthi') }}">Tin tức</a>
                        </li>
                         Blog phim Dropdown
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
                    <div class="d-flex align-items-center mt-3 ms-auto">
                        <form class="d-flex" method="GET" action="{{ route('timkiem') }}">
                            <input class="form-control me-2" type="search" name="timkiem" placeholder="Tìm kiếm..."
                                aria-label="Search" value="{{ request('timkiem') }}">
                            <button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i></button>
                        </form>
                        @if (Auth::check())
                            <div class="tt ms-4">
                                <a href="">
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
            </nav>

        </div>

    </div> -->