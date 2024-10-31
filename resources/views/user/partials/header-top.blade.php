<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <a href="#">
            <img src="https://homepage.momocdn.net/fileuploads/svg/momo-file-240411162904.svg" alt="Logo" width="50" height="50" class="ms-5">
        </a>
        <div class="d-flex align-items-center">
            <form class="d-flex" method="GET" action="">
                <input class="form-control me-2" type="search" name="timkiem" placeholder="Tìm kiếm..." aria-label="Search" value="{{ request('timkiem') }}">
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
                        <a class="btn btn-secondary btn-custom" href="">Đăng Nhập</a>
                    </li>
                </ul>
            @endif
        </div>
    </div>
</div>

<style>
    .btn-custom {
        padding: 10px 20px; /* Thay đổi kích thước nút */
        border-radius: 25px; /* Bo góc nút */
        transition: background-color 0.3s, color 0.3s; /* Hiệu ứng chuyển màu */
    }

    .btn-custom:hover {
        background-color: #0056b3; /* Màu nền khi hover */
        color: white; /* Màu chữ khi hover */
    }

    .xam a {
        text-decoration: none; /* Bỏ gạch chân cho chữ */
    }
</style>
