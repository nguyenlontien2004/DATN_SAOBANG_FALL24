@extends('admin.index')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Chỉnh sửa Suất Chiếu</h5>
            </div>
            <div class="card-body">
                <!-- Sửa route từ store sang update và thêm method PUT -->
                <form action="{{ route('suatChieu.update', $suatChieu->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <!-- Phòng Chiếu -->
                        <div class="col-md-6">
                            <label for="phong_chieu_id" class="form-label">Phòng Chiếu</label>
                            <select class="form-select" id="phong_chieu_id" name="phong_chieu_id">
                                @foreach ($phongChieus as $phongChieu)
                                    <option value="{{ $phongChieu->id }}"
                                        {{ $suatChieu->phong_chieu_id == $phongChieu->id ? 'selected' : '' }}>
                                        {{ $phongChieu->ten_phong_chieu }}
                                    </option>
                                @endforeach
                            </select>
                            @error('phong_chieu_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Phim -->
                        <div class="col-md-6">
                            <label for="phim_id" class="form-label">Phim</label>
                            <select class="form-select" id="phim_id" name="phim_id">
                                @foreach ($phims as $phim)
                                    <option value="{{ $phim->id }}"
                                        {{ $suatChieu->phim_id == $phim->id ? 'selected' : '' }}>
                                        {{ $phim->ten_phim }}
                                    </option>
                                @endforeach
                            </select>
                            @error('phim_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-4">
                            <label for="ngay" class="form-label">Ngày</label>
                            <input type="date" class="form-control" id="ngay" name="ngay"
                                value="{{ $suatChieu->ngay }}">
                        </div>
                        <div class="col-md-4">
                            <label for="gio_bat_dau" class="form-label">Giờ Bắt Đầu</label>
                            <input type="time" class="form-control" id="gio_bat_dau" name="gio_bat_dau"
                                value="{{ \Carbon\Carbon::parse($suatChieu->gio_bat_dau)->format('H:i') }}">
                            @error('gio_bat_dau')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="gio_ket_thuc" class="form-label">Giờ Kết Thúc</label>
                            <input type="time" class="form-control" id="gio_ket_thuc" name="gio_ket_thuc"
                                value="{{ \Carbon\Carbon::parse($suatChieu->gio_ket_thuc)->format('H:i') }}">
                            @error('gio_ket_thuc')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="trang_thai" class="form-label">Trạng Thái</label>
                        <select class="form-select" id="trang_thai" name="trang_thai">
                            <option value="1" {{ old('trang_thai', $suatChieu->trang_thai) == 1 ? 'selected' : '' }}>
                                Hoạt động</option>
                            <option value="0" {{ old('trang_thai', $suatChieu->trang_thai) == 0 ? 'selected' : '' }}>
                                Không hoạt động</option>
                        </select>
                    </div>


                    <button type="submit" class="btn btn-primary">Cập nhật Suất Chiếu</button>
                    <a href="{{ route('suatChieu.index') }}" class="btn btn-secondary">Quay lại</a>
                </form>
            </div>
        </div>
    </div>
@endsection
