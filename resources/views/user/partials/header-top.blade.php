<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <a href="/" class="mt-3">
            <img src="https://homepage.momocdn.net/fileuploads/svg/momo-file-240411162904.svg" alt="Logo"
                width="50" height="50" class="ms-5">
        </a>
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
        <div class="d-flex align-items-center mt-3">
            <form class="d-flex" method="GET" action="{{ route('timkiem') }}">
                <input class="form-control me-2" type="search" name="timkiem" placeholder="Tìm kiếm..."
                    aria-label="Search" value="{{ request('timkiem') }}">
                <button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i></button>
            </form>
            @if (Auth::check())
                <div class="tt ms-4">
                    <a href=""> <img src="" alt="đại diện"></a>
                </div>
            @else
                <ul class="menu d-flex align-items-center mb-0 ms-3">
                    <li class="xam ms-2">
                        <a class="btn btn-primary btn-custom" href="">Đăng Ký</a>
                    </li>
                    <li class="xam ms-2">
                        <a class="btn btn-secondary btn-custom" href="{{ route('formLogin') }}">Đăng Nhập</a>
                    </li>
                </ul>
            @endif
        </div>
    </div>
</div>

