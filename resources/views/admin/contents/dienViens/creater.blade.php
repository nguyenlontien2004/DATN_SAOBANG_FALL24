@extends('admin.layouts.master')
@section('noidung')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Thêm mới Diễn Viên</h5>
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
            <form action="{{ route('dienVien.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="ten_dien_vien" class="form-label">Tên Diễn Viên</label>
                    <input type="text" class="form-control" id="ten_dien_vien" name="ten_dien_vien" required>
                </div>

                <div class="mb-3">
                    <label for="anh_dien_vien" class="form-label">Ảnh Diễn Viên</label>
                    <input type="file" class="form-control" id="anh_dien_vien" name="anh_dien_vien" accept="image/*" required>
                </div>

                <div class="mb-3">
                    <label for="nam_sinh" class="form-label">Năm sinh</label>
                    <input type="date" class="form-control" id="nam_sinh" name="nam_sinh" required>
                </div>

                <div class="mb-3">
                    <label for="quoc_tich" class="form-label">Quốc tịch</label>
                    <input type="text" class="form-control" id="quoc_tich" name="quoc_tich" required>
                </div>
                

                <div class="mb-3">
                    <label for="gioi_tinh" class="form-label">Giới Tính</label>
                    <select class="form-select" id="gioi_tinh" name="gioi_tinh" required>
                        <option value="">Chọn giới tính</option>
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                        <option value="Khác">Khác</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tieu_su" class="form-label">Tiểu Sử</label>
                    <textarea type="text" class="form-control" id="tieu_su" name="tieu_su" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="trang_thai" class="form-label">Trạng Thái</label>
                    <select class="form-select" id="trang_thai" name="trang_thai" required>
                        <option value="1">Hoạt động</option>
                        <option value="0">Không hoạt động</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Thêm mới Diễn Viên</button>
                <a href="{{ route('daoDien.index') }}" class="btn btn-secondary">Quay lại</a>
            </form>
        </div>
    </div>
</div>
@endsection
