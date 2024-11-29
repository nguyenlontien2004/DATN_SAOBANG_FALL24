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
                    <a href="#">Quản lý tài khoản</a>
                </li>
            </ul>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Sửa thông tin tài khoản</h4>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('admin.editpro') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="ho_ten">Họ tên</label>
                        <input type="text" name="ho_ten" value="{{ old('ho_ten', $admin->ho_ten) }}"
                            class="form-control" id="ho_ten" placeholder="Nhập họ tên" required />
                        @error('ho_ten')
                            <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" value="{{ old('email', $admin->email) }}" class="form-control"
                            id="email" placeholder="Nhập email" required />
                        @error('email')
                            <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="so_dien_thoai">Số điện thoại</label>
                        <input type="text" name="so_dien_thoai" value="{{ old('so_dien_thoai', $admin->so_dien_thoai) }}"
                            class="form-control" id="so_dien_thoai" placeholder="Nhập số điện thoại" required />
                        @error('so_dien_thoai')
                            <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group ">
                        <label for="hinh_anh">Hình ảnh</label>
                        <input type="file" name="hinh_anh" class="form-control" id="hinh_anh" />
                        @if ($admin->hinh_anh)
                            Hình ảnh hiện tại: <img src="{{ asset('storage/' . $admin->hinh_anh) }}" width="100"
                                alt="Hình ảnh">
                        @endif
                        @error('hinh_anh')
                            <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group ">
                        <label for="gioi_tinh" class="form-label">Giới Tính</label>
                        <select class="form-select" id="gioi_tinh" name="gioi_tinh" required>
                            <option value="">Chọn giới tính</option>
                            <option value="Nam" {{ old('gioi_tinh', $admin->gioi_tinh) == 'Nam' ? 'selected' : '' }}>Nam
                            </option>
                            <option value="Nữ" {{ old('gioi_tinh', $admin->gioi_tinh) == 'Nữ' ? 'selected' : '' }}>Nữ
                            </option>
                            <option value="Khác" {{ old('gioi_tinh', $admin->gioi_tinh) == 'Khác' ? 'selected' : '' }}>
                                Khác</option>
                        </select>
                        @error('gioi_tinh')
                            <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="dia_chi">Địa chỉ</label>
                        <input type="text" name="dia_chi" value="{{ old('dia_chi', $admin->dia_chi) }}"
                            class="form-control" id="dia_chi" placeholder="Nhập địa chỉ" required />
                        @error('dia_chi')
                            <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nam_sinh">Năm sinh</label>
                        <input type="date" name="nam_sinh" value="{{ old('nam_sinh', $admin->nam_sinh) }}"
                            class="form-control" id="nam_sinh" required />
                        @error('nam_sinh')
                            <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Cập nhật</button>
                        <a href="{{ route('admin.ttadmin') }}" class="btn btn-danger">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
