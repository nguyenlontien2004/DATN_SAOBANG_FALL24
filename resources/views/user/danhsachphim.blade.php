@extends('layout.user')
<style>
    .bg-secondary {
        padding: 15px;
        /* Thêm padding nếu cần để không gian bên trong card */
        height: 100%;
        /* Đảm bảo chiều cao của card đầy đủ */
        overflow: hidden;
        /* Ẩn phần hình ảnh vượt quá khung */
    }

    .film-image {
        max-height: 250px;
        /* Tăng chiều cao tối đa của hình ảnh */
        object-fit: cover;
        /* Giữ tỷ lệ khung hình */
        width: 100%;
        /* Đảm bảo hình ảnh chiếm toàn bộ chiều rộng */
    }

    .film-title {
        font-size: 1.1rem;
        /* Tăng kích thước chữ tiêu đề một chút */
    }
</style>
@section('content')
    <h3 class="mb-1">Danh sách phim</h3>

    <!-- Filter Button -->
    <div class="d-flex justify-content-end mb-4">
        <button class="btn btn-outline-secondary">Thể loại</button>
    </div>

    <!-- Movies Grid -->
    <div class="row">
        <!-- Phim 1 -->
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100">
                <img src="img/phim1.jfif" class="card-img-top" alt="Phim 1"
                    style="width: 100%; height: 400px; object-fit: cover" />
                <div class="card-body">
                    <h5 class="card-title">Ngày xưa có một chuyện tình</h5>
                    <p class="card-text">Lãng mạn</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100">
                <img src="img/phim1.jfif" class="card-img-top" alt="Phim 2"
                    style="width: 100%; height: 400px; object-fit: cover" />
                <div class="card-body">
                    <h5 class="card-title">Ngày xưa có một chuyện tình</h5>
                    <p class="card-text">Lãng mạn</p>
                </div>
            </div>
        </div>

        <!-- Phim 3 -->
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100">
                <img src="img/phim1.jfif" class="card-img-top" alt="Phim 3"
                    style="width: 100%; height: 400px; object-fit: cover" />
                <div class="card-body">
                    <h5 class="card-title">Ngày xưa có một chuyện tình</h5>
                    <p class="card-text">Lãng mạn</p>
                </div>
            </div>
        </div>

        <!-- Phim 4 -->
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100">
                <img src="img/phim1.jfif" class="card-img-top" alt="Phim 4"
                    style="width: 100%; height: 400px; object-fit: cover" />
                <div class="card-body">
                    <h5 class="card-title">Ngày xưa có một chuyện tình</h5>
                    <p class="card-text">Lãng mạn</p>
                </div>
            </div>
        </div>

        <!-- Lặp lại thêm các phim khác -->
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{-- <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="#">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav> --}}

        <br>{{ $danhSachPhim->links('pagination::bootstrap-5') }}
    </div>
@endsection
