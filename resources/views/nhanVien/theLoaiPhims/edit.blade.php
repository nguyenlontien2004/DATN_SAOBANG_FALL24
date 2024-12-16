@extends('nhanVien.index')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Chỉnh sửa Thể loại</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('nhanvientheLoaiPhim.update', $theLoaiPhim->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="ten_the_loai" class="form-label">Tên Thể loại</label>
                        <input type="text" class="form-control" id="ten_the_loai" name="ten_the_loai"
                            value="{{ old('ten_the_loai', $theLoaiPhim->ten_the_loai) }}" >
                        @error('ten_the_loai')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="trang_thai" class="form-label">Trạng Thái</label>
                        <select class="form-select" id="trang_thai" name="trang_thai" >
                            <option value="1" {{ $theLoaiPhim->trang_thai ? 'selected' : '' }}>Hoạt động</option>
                            <option value="0" {{ !$theLoaiPhim->trang_thai ? 'selected' : '' }}>Không hoạt động
                            </option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Cập nhật Thể loại</button>
                    <a href="{{ route('theLoaiPhim.index') }}" class="btn btn-secondary">Quay lại</a>
                </form>
            </div>
        </div>
    </div>
@endsection
