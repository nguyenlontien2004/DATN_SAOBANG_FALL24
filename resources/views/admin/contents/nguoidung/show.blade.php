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
                <h4 class="card-title">Chi tiết người dùng</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="ho_ten">Họ tên:</label>
                    <p>{{ $nguoiDung->ho_ten }}</p>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <p>{{ $nguoiDung->email }}</p>
                </div>

                <div class="form-group">
                    <label for="so_dien_thoai">Số điện thoại:</label>
                    <p>{{ $nguoiDung->so_dien_thoai }}</p>
                </div>

                <div class="form-group">
                    <label for="gioi_tinh">Giới tính:</label>
                    <p>{{ $nguoiDung->gioi_tinh }}</p>
                </div>

                <div class="form-group">
                    <label for="dia_chi">Địa chỉ:</label>
                    <p>{{ $nguoiDung->dia_chi }}</p>
                </div>

                <div class="form-group">
                    <label for="nam_sinh">Năm sinh:</label>
                    <p>{{ $nguoiDung->nam_sinh }}</p>
                </div>

                <div class="form-group">
                    <label for="hinh_anh">Hình ảnh:</label>
                    <img src="{{ asset('storage/' . $nguoiDung->hinh_anh) }}" width="300" alt="Hình ảnh người dùng">
                </div>

                <div class="form-group">
                    <label for="vai_tro">Vai trò:</label>
                    @if ($nguoiDung->vaiTros->isNotEmpty())
                        @foreach ($nguoiDung->vaiTros as $vt)
                            <span class="badge badge-info"> {{ $vt->ten_vai_tro }}</span>
                        @endforeach
                    @else
                        Không có vai trò
                    @endif
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('nguoi-dung.index') }}" class="btn btn-danger">Quay lại</a>
            </div>
        </div>
    </div>
@endsection
