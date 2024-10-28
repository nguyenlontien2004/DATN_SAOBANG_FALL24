@extends('admin.layouts.master')
@section('noidung')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Chỉnh sửa Đạo diễn</h5>
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
            <form action="{{ route('daoDien.update', $daoDien->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="ten_dao_dien" class="form-label">Tên Đạo diễn</label>
                    <input type="text" class="form-control" id="ten_dao_dien" name="ten_dao_dien" value="{{ old('ten_dao_dien', $daoDien->ten_dao_dien) }}" required>
                </div>

                <div class="mb-3">
                    <label for="anh_dao_dien" class="form-label">Ảnh Đạo diễn</label>
                    <input type="file" class="form-control" id="anh_dao_dien" name="anh_dao_dien" accept="image/*">
                    <img src="{{ Storage::url($daoDien->anh_dao_dien) }}" alt="Product Image" width="100px"
                                    height="auto">
                    <small class="form-text text-muted">Để trống nếu không muốn thay đổi ảnh.</small>
                </div>

                <div class="mb-3">
                    <label for="nam_sinh" class="form-label">Năm sinh</label>
                    <input type="date" class="form-control" id="nam_sinh" name="nam_sinh" value="{{ old('nam_sinh', $daoDien->nam_sinh) }}" required>
                </div>

                {{-- <div class="mb-3">
                    <label for="quoc_tich" class="form-label">Quốc tịch</label>
                    <input type="text" class="form-control" id="quoc_tich" name="quoc_tich" value="{{ old('quoc_tich', $daoDien->quoc_tich) }}" required>
                </div>

                <div class="mb-3">
                    <label for="gioi_tinh" class="form-label">Giới Tính</label>
                    <select class="form-select" id="gioi_tinh" name="gioi_tinh" required>
                        <option value="Nam" {{ $daoDien->gioi_tinh == 'Nam' ? 'selected' : '' }}>Nam</option>
                        <option value="Nữ" {{ $daoDien->gioi_tinh == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                        <option value="Khác" {{ $daoDien->gioi_tinh == 'Khác' ? 'selected' : '' }}>Khác</option>
                    </select>
                </div> --}}
                <div class="row mb-3">
                    <div class="col">
                        <label for="quoc_tich" class="form-label">Quốc tịch</label>
                        <input type="text" class="form-control" id="quoc_tich" name="quoc_tich" value="{{ old('quoc_tich', $daoDien->quoc_tich) }}" required>
                    </div>
                    <div class="col">
                        <label for="gioi_tinh" class="form-label">Giới Tính</label>
                        <select class="form-select" id="gioi_tinh" name="gioi_tinh" required>
                            <option value="Nam" {{ $daoDien->gioi_tinh == 'Nam' ? 'selected' : '' }}>Nam</option>
                            <option value="Nữ" {{ $daoDien->gioi_tinh == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                            <option value="Khác" {{ $daoDien->gioi_tinh == 'Khác' ? 'selected' : '' }}>Khác</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="tieu_su" class="form-label">Tiểu Sử</label>
                    <textarea class="form-control" id="tieu_su" name="tieu_su" required>{{ old('tieu_su', $daoDien->tieu_su) }}</textarea>
                </div>
                

                <div class="mb-3">
                    <label for="trang_thai" class="form-label">Trạng Thái</label>
                    <select class="form-select" id="trang_thai" name="trang_thai" required>
                        <option value="1" {{ $daoDien->trang_thai ? 'selected' : '' }}>Hoạt động</option>
                        <option value="0" {{ !$daoDien->trang_thai ? 'selected' : '' }}>Không hoạt động</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Cập nhật Đạo diễn</button>
                <a href="{{ route('daoDien.index') }}" class="btn btn-secondary">Quay lại</a>
            </form>
        </div>
    </div>
</div>
@endsection
