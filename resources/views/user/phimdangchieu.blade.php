@extends('layout.user')
<style>
    .film-card {
        margin-bottom: 15px;
        /* Điều chỉnh khoảng cách giữa các card */
    }

    .bg-secondary {
        padding: 15px;
        /* Thêm padding nếu cần để không gian bên trong card */
        height: 100%;
        /* Đảm bảo chiều cao của card đầy đủ */
        overflow: hidden; /* Ẩn phần hình ảnh vượt quá khung */
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
        font-size: 1.1rem; /* Tăng kích thước chữ tiêu đề một chút */
    }
    
</style>
@section('title')
    {{ $title }}
@endsection
@section('content')
    <div class="container">
        <br>
        <h1 class="mb-4 fs-2"><strong>Phim đang chiếu</strong></h1>

        <!-- Filter Button -->
        <div class="d-flex justify-content-end mt-5">
            <select class="form-control" name="the_loai" id="the_loai">
                <option class="text-center" value="">-- Chọn thể loại --</option>
                @foreach ($theLoai as $theLoai)
                    <option class="text-center" value="{{ $theLoai->id }}">{{ $theLoai->ten_the_loai }}</option>
                @endforeach
            </select>
        </div>
        
        <br>
        <!-- Movies Grid -->

        <div class="d-flex flex-wrap justify-content-between">
            @foreach ($phimDangChieu as $item)
                <div class="col-md-3 mb-3"> <!-- Sử dụng col-md-3 để chia thành 4 cột -->
                    <div class="bg-secondary text-white rounded-lg h-100 d-flex flex-column" style="max-width: 300px;">
                        <div class="film-card position-relative flex-grow-1">
                            <!-- Hình ảnh của video -->
                            <img alt="Video Thumbnail" class="film-image rounded-lg mb-4"
                                src="https://img.youtube.com/vi/pnSsgRJmsCc/hqdefault.jpg"
                                onclick="playVideo('https://www.youtube.com/embed/pnSsgRJmsCc?autoplay=1&enablejsapi=1')"
                                style="cursor: pointer; width: 100%;" />
                            <a href="{{ route('chitietphim', $item->id) }}" class="hover-enlarge">
                                <h3 class="text-lg font-bold film-title">
                                    {{ $item->ten_phim }}
                                </h3>
                            </a>
                            <p class="film-genre">
                                @foreach ($item->theLoaiPhims as $theLoaiPhim)
                                    {{ $theLoaiPhim->ten_the_loai }}@if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </p>
                            <p class="text-yellow-500">
                                <i class="fas fa-star"></i> 6.3
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Modal cho video -->
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
        </div>




        <br>{{ $phimDangChieu->links('pagination::bootstrap-5') }}
        <br>
    </div>
@endsection
