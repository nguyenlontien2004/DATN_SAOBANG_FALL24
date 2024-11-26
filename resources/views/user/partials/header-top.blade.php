<div class="container-fluid ">
    <div class="d-flex justify-content-between align-items-center">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" height="60px" class="ms-5">
        <div class="d-flex align-items-center">
            <form class="d-flex" method="GET" action="{{ route('timkiem') }}">
                <input class="form-control me-2" type="search" name="timkiem" placeholder="Tìm kiếm..."
                    aria-label="Search" value="{{ request('timkiem') }}">
                <button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i></button>
            </form>
            @if (Auth::check())
                <div class="tt ms-4">
                    <a href="{{ route('user.nguoidung') }}"> <img src="" alt="đại diện"></a>
                </div>
            @else
                <ul class="menu d-flex align-items-center mb-0 ms-3">
                    <li class="xam ms-2">
                        <a class="btn-dk" href="{{ route('dangky') }}">Đăng Ký</a>
                    </li>
                    <li class="xam ms-2">
                        <a class="btn-dk" href="{{ route('login') }}">Đăng Nhập</a>
                    </li>
                </ul>
            @endif
        </div>
    </div>
</div>
