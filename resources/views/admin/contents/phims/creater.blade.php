@extends('admin.index')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Thêm mới Phim</h5>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="card-body">
                <form action="{{ route('phim.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="ten_phim" class="form-label">Tên Phim</label>
                        <input type="text" class="form-control" id="ten_phim" name="ten_phim" required>
                    </div>

                    <div class="mb-3">
                        <label for="mo_ta" class="form-label">Mô Tả</label>
                        <textarea class="form-control" id="mo_ta" name="mo_ta"></textarea>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label for="thoi_luong" class="form-label">Thời Lượng (phút)</label>
                            <input type="number" class="form-control" id="thoi_luong" name="thoi_luong" required>
                        </div>
                        <div class="col-md-6">
                            <label for="luot_xem_phim" class="form-label">Lượt Xem</label>
                            <input type="number" class="form-control" id="luot_xem_phim" name="luot_xem_phim">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label for="ngay_khoi_chieu" class="form-label">Ngày Khởi Chiếu</label>
                            <input type="date" class="form-control" id="ngay_khoi_chieu" name="ngay_khoi_chieu" required>
                        </div>
                        <div class="col-md-6">
                            <label for="ngay_ket_thuc" class="form-label">Ngày Kết Thúc</label>
                            <input type="date" class="form-control" id="ngay_ket_thuc" name="ngay_ket_thuc">
                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="trailer" class="form-label">Trailer (link)</label>
                        <input type="url" class="form-control" id="trailer" name="trailer">
                    </div>
                    <div class="mb-3">
                        <label for="the_loai_phim_ids">Chọn Thể Loại</label>
                        <select name="the_loai_phim_ids[]" class="form-control" multiple required>
                            @foreach ($theLoais as $theLoai)
                                <option value="{{ $theLoai->id }}">{{ $theLoai->ten_the_loai }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dao_dien_ids">Chọn Đạo Diễn</label>
                                <select name="dao_dien_ids[]" class="form-control" multiple required>
                                    @foreach ($daoDiens as $daoDien)
                                        <option value="{{ $daoDien->id }}">{{ $daoDien->ten_dao_dien }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dien_vien_ids">Chọn Diễn Viên</label>
                                <select id="dien_vien_ids" name="dien_vien_ids[]" class="form-control" multiple required>
                                    @foreach ($dienViens as $dienVien)
                                        <option value="{{ $dienVien->id }}">{{ $dienVien->ten_dien_vien }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>


                    <div id="vai_tro_container">
                        <label for="vai_tro_dien_vien">Vai Trò Diễn Viên</label>
                        <div class="form-group">
                            <select name="vai_tro_dien_vien[]" class="form-control" required>
                                <option value="Diễn viên chính">Diễn viên chính</option>
                                <option value="Diễn viên phụ">Diễn viên phụ</option>
                            </select>
                        </div>
                    </div>



                    <div class="mb-3">
                        <label for="trang_thai" class="form-label">Trạng Thái</label>
                        <select class="form-select" id="trang_thai" name="trang_thai" required>
                            <option value="1">Hoạt động</option>
                            <option value="0">Không hoạt động</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Thêm mới Phim</button>
                    <a href="{{ route('phim.index') }}" class="btn btn-secondary">Quay lại</a>
                </form>
            </div>
        </div>
    </div>
@endsection
