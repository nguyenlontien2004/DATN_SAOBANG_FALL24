@extends('admin.index')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Sửa Rạp</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('rap.update', $rap->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Thêm phương thức PUT cho việc cập nhật -->

                    <div class="mb-3">
                        <label for="ten_rap" class="form-label">Tên Rạp</label>
                        <input type="text" class="form-control" id="ten_rap" name="ten_rap"
                            value="{{ old('ten_rap', $rap->ten_rap) }}">
                        @error('ten_rap')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="dia_diem" class="form-label">Địa Điểm</label>
                        <input type="text" class="form-control" id="dia_diem" name="dia_diem"
                            value="{{ old('dia_diem', $rap->dia_diem) }}">
                        @error('dia_diem')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="trang_thai" class="form-label">Trạng Thái</label>
                        <select class="form-select" id="trang_thai" name="trang_thai">
                            <option value="1" {{ $rap->trang_thai == 1 ? 'selected' : '' }}>Hoạt động</option>
                            <option value="0" {{ $rap->trang_thai == 0 ? 'selected' : '' }}>Không hoạt động</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Cập nhật Rạp</button>
                    <a href="{{ route('rap.index') }}" class="btn btn-secondary">Quay lại</a>
                </form>
            </div>
        </div>
    </div>
@endsection
