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
                    <a href="#">Thông tin admin</a>
                </li>
            </ul>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Thông tin admin</h4>
            </div>
            @php
                $nguoiDung = Auth::user();
            @endphp
            <div class="card-body">
                <div class=" form-group row">
                    <div class="col-md-6">
                        <label for="ho_ten">Họ tên:</label>
                        <p>{{ $nguoiDung->ho_ten }}</p>
                    </div>
                    <div class="col-md-6">
                        <label for="email">Email:</label>
                        <p>{{ $nguoiDung->email }}</p>
                    </div>
                </div>

                <div class=" form-group row">
                    <div class="col-md-6">
                        <label for="so_dien_thoai">Số điện thoại:</label>
                        <p>{{ $nguoiDung->so_dien_thoai }}</p>
                    </div>
                    <div class="col-md-6">
                        <label for="gioi_tinh">Giới tính:</label>
                        <p>{{ $nguoiDung->gioi_tinh }}</p>
                    </div>
                </div>

                {{-- <div class="form-group">
                    <label for="so_dien_thoai">Số điện thoại:</label>
                    <p>{{ $nguoiDung->so_dien_thoai }}</p>
                    <input type="text" name="ten_ma_giam_gia" class="form-control" readonly id="ten_ma_giam_gia"
                        placeholder="Nhập tên mã giảm giá" value="{{ $nguoiDung->so_dien_thoai }}" />
                </div>
 --}}

                <div class=" form-group row">
                    <div class="col-md-6">
                        <label for="dia_chi">Địa chỉ:</label>
                        <p>{{ $nguoiDung->dia_chi }}</p>
                    </div>
                    <div class="col-md-6">
                        <label for="nam_sinh">Năm sinh:</label>
                        <p>{{ $nguoiDung->nam_sinh }}</p>
                    </div>
                </div>

                <div class=" form-group row">
                    <div class="col-md-6">
                        <label for="hinh_anh">Ảnh đại diện:</label>
                        <img src="{{ asset('storage/' . $nguoiDung->hinh_anh) }}" width="300" class="ms-3"
                            alt="Hình ảnh người dùng">
                    </div>
                    <div class="col-md-6">
                        <label for="vai_tro">Vai trò:</label>
                        @if ($nguoiDung->vaiTros->isNotEmpty())
                            @foreach ($nguoiDung->vaiTros as $vt)
                                {{ $vt->ten_vai_tro }}
                            @endforeach
                        @endif
                    </div>
                </div>

            </div>

            <div class="card-footer">
                <a href="{{ route('admin.edit') }}" class="btn btn-warning">Sửa</a>
                <a href="{{ route('admin.index') }}" class="btn btn-danger">Quay lại</a>
            </div>

        </div>
    </div>
@endsection
