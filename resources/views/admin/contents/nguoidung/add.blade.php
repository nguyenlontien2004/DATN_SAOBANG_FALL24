@extends('admin.index')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="#">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Forms</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Người dùng</a>
                </li>
            </ul>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Thêm người dùng</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('nguoi-dung.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="ho_ten">Họ tên</label>
                        <input type="text" name="ho_ten" value="{{ old('ho_ten') }}" class="form-control" id="ho_ten"
                            placeholder="Nhập họ tên" required />

                        @error('ho_ten')
                            <div class="text text-danger">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="ho_ten"
                            placeholder="Nhập email" required />

                        @error('email')
                            <div class="text text-danger">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="so_dien_thoai">Số điện thoại</label>
                        <input type="text" name="so_dien_thoai" value="{{ old('so_dien_thoai') }}" class="form-control"
                            id="so_dien_thoai" placeholder="Nhập số điện thoại" required />

                        @error('so_dien_thoai')
                            <div class="text text-danger">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="hinh_anh">Hình ảnh</label>
                        <input type="file" name="hinh_anh" value="{{ old('hinh_anh') }}" class="form-control"
                            id="hinh_anh" required />

                        @error('hinh_anh')
                            <div class="text text-danger">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="mat_khau">Mật khẩu</label>
                        <input type="text" name="mat_khau" value="{{ old('mat_khau') }}" class="form-control"
                            id="mat_khau" placeholder="Nhập mật khẩu" required />

                        @error('mat_khau')
                            <div class="text text-danger">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="gioi_tinh" class="form-label">Giới Tính</label>
                        <select class="form-select" id="gioi_tinh" name="gioi_tinh" required>
                            <option value="">Chọn giới tính</option>
                            <option value="Nam">Nam</option>
                            <option value="Nữ">Nữ</option>
                            <option value="Khác">Khác</option>
                        </select>

                        @error('gioi_tinh')
                            <div class="text text-danger">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="dia_chi">Địa chỉ</label>
                        <input type="text" name="dia_chi" value="{{ old('dia_chi') }}" class="form-control"
                            id="dia_chi" placeholder="Nhập tên danh mục" required />

                        @error('dia_chi')
                            <div class="text text-danger">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="nam_sinh">Năm sinh</label>
                        <input type="date" name="nam_sinh" value="{{ old('nam_sinh') }}" class="form-control"
                            id="nam_sinh" placeholder="Nhập tên danh mục" required />

                        @error('nam_sinh')
                            <div class="text text-danger">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="vai_tro_id">Vai trò</label>
                        <select name="vai_tro_id[]" class="form-control" id="vai_tro_id" multiple required>
                            <option value="">-- Chọn vai trò --</option>
                            @foreach ($vaitro as $vt)
                                <option value="{{ $vt->id }}">{{ $vt->ten_vai_tro }}</option>
                            @endforeach
                        </select>

                        @error('vai_tro_id')
                            <div class="text text-danger">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="{{ route('nguoi-dung.index') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
