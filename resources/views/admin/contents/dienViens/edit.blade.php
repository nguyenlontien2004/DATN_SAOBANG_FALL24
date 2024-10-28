@extends('admin.layouts.master')
@section('noidung')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Chỉnh sửa Diễn Viên</h5>
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
            <form action="{{ route('dienVien.update', $dienVien->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="ten_dien_vien" class="form-label">Tên Diễn Viên</label>
                    <input type="text" class="form-control" id="ten_dien_vien" name="ten_dien_vien" value="{{ old('ten_dien_vien', $dienVien->ten_dien_vien) }}" required>
                </div>

                <div class="mb-3">
                    <label for="anh_dien_vien" class="form-label">Ảnh Diễn Viên</label>
                    <input type="file" class="form-control" id="anh_dien_vien" name="anh_dien_vien" accept="image/*">
                    <img src="{{ Storage::url($dienVien->anh_dien_vien) }}" alt="Product Image" width="100px"
                        height="auto">
    
                    <small class="form-text text-muted">Để trống nếu không muốn thay đổi ảnh.</small>
                </div>

                <div class="mb-3">
                    <label for="nam_sinh" class="form-label">Năm sinh</label>
                    <input type="date" class="form-control" id="nam_sinh" name="nam_sinh" value="{{ old('nam_sinh', $dienVien->nam_sinh) }}" required>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label for="quoc_tich" class="form-label">Quốc tịch</label>
                        <input type="text" class="form-control" id="quoc_tich" name="quoc_tich" value="{{ old('quoc_tich', $dienVien->quoc_tich) }}" required>
                    </div>
                    <div class="col">
                        <label for="gioi_tinh" class="form-label">Giới Tính</label>
                        <select class="form-select" id="gioi_tinh" name="gioi_tinh" required>
                            <option value="Nam" {{ $dienVien->gioi_tinh == 'Nam' ? 'selected' : '' }}>Nam</option>
                            <option value="Nữ" {{ $dienVien->gioi_tinh == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                            <option value="Khác" {{ $dienVien->gioi_tinh == 'Khác' ? 'selected' : '' }}>Khác</option>
                        </select>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="tieu_su" class="form-label">Tiểu Sử</label>
                    <textarea class="form-control" id="tieu_su" name="tieu_su" required>{{ old('tieu_su', $dienVien->tieu_su) }}</textarea>
                </div>
                
                <div class="mb-3">
                    <label for="trang_thai" class="form-label">Trạng Thái</label>
                    <select class="form-select" id="trang_thai" name="trang_thai" required>
                        <option value="1" {{ $dienVien->trang_thai ? 'selected' : '' }}>Hoạt động</option>
                        <option value="0" {{ !$dienVien->trang_thai ? 'selected' : '' }}>Không hoạt động</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Cập nhật Diễn Viên</button>
                <a href="{{ route('dienVien.index') }}" class="btn btn-secondary">Quay lại</a>
            </form>
        </div>
    </div>
</div>
@endsection
