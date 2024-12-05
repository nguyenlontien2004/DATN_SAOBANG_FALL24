@extends('admin.index')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Thêm mới Suất Chiếu</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('suatChieu.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <!-- Phòng Chiếu -->
                        <div class="col-md-6">
                            <label for="phong_chieu_id" class="form-label">Phòng Chiếu</label>
                            <select class="form-select" id="phong_chieu_id" name="phong_chieu_id"
                                value="{{ old('phong_chieu_id') }}">
                                @foreach ($phongChieus as $phongChieu)
                                    <option value="{{ $phongChieu->id }}">{{ $phongChieu->ten_phong_chieu }}</option>
                                @endforeach
                            </select>
                            @error('phong_chieu_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Phim -->
                        <div class="col-md-6">
                            <label for="phim_id" class="form-label">Phim</label>
                            <select class="form-select" id="phim_id" name="phim_id" value="{{ old('phim_id') }}">
                                @foreach ($phims as $phim)
                                    <option value="{{ $phim->id }}">{{ $phim->ten_phim }}</option>
                                @endforeach
                            </select>
                            {{-- @error('phim_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror --}}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-4">
                            <label for="ngay" class="form-label">Ngày</label>
                            <input type="date" class="form-control" id="date" name="date"
                                value="{{ old('date') }}">
                        </div>
                        <div class="col-md-4">
                            <label for="gio_bat_dau" class="form-label">Giờ Bắt Đầu</label>
                            <input type="time" class="form-control" id="gio_bat_dau" name="gio_bat_dau"
                                value="{{ old('gio_bat_dau') }}">
                            @error('gio_bat_dau')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="gio_ket_thuc" class="form-label">Giờ Kết Thúc</label>
                            <input type="time" class="form-control" id="gio_ket_thuc" name="gio_ket_thuc"
                                value="{{ old('gio_ket_thuc') }}">
                            @error('gio_ket_thuc')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="m-3 ">
                        @error('phim_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Thêm mới Suất Chiếu</button>
                    <a href="{{ route('suatChieu.index') }}" class="btn btn-secondary">Quay lại</a>
                </form>
            </div>
        </div>
    </div>
@endsection
