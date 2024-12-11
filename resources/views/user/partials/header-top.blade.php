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
                            <li><a class="d-flex align-items-center" href="{{ route('rap') }}">Rạp <svg
                                        xmlns="http://www.w3.org/2000/svg" width="20" height="20"
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
                            <svg xmlns="http://www.w3.org/2000/svg" style="color: #767676;" width="20"
                                height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search">
                                <circle cx="11" cy="11" r="8" />
                                <path d="m21 21-4.3-4.3" />
                            </svg>
                        </button>
                    </form>
                    <div class="user-action" style="overflow: none !important;">
                        @if (Auth::check())
                            <div>
                                {{-- <a href="{{ route('thong-tin-nguoi-dung') }}">
                                    <img src="{{ Auth::user()->anh_dai_dien != '' ? asset('storage/' . Auth::user()->anh_dai_dien) : 'https://cdn.moveek.com/bundles/ornweb/img/no-avatar.png' }}"
                                        alt="đại diện" style="border-radius: 50%; object-fit: cover;">
                                </a> --}}
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
