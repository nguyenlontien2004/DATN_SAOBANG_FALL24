@extends('layout.user')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <div class="container5999">

        @php
            $user = Auth::user();
        @endphp

        <div class="sidebar6669">
            <div class="form-group mb-3 d-flex justify-content-center align-items-center">
                <img alt="Ảnh đại diện người dùng" src="{{ asset('storage/' . $user->anh_dai_dien) }}"
                    style="border-radius: 50%; height: 100px; width: 100px; object-fit: cover" />
            </div>
            <div class="username">{{ $user->ho_ten }}</div>
            <hr />
            <a href="{{ route('thongtin3') }}">Thông tin cá nhân</a>
            <a href="{{ route('doimatkhau') }}">Đổi mật khẩu</a>
            <a href="{{ route('lichsudatve') }}">Lịch sử đặt vé</a>
            <a href="{{ route('formcapnhat') }}">Cập nhật thông tin cá nhân</a>
            <a href="" class="text-danger">
                <form action="{{ route('dangxuat') }}" method="POST">
                    @csrf
                    <button type="submit">Đăng xuất</button>
                </form>
            </a>

        </div>

        <div class="content">
            <h1>Thông tin cá nhân</h1>

            <div class="form-group mb-3 d-flex justify-content-center align-items-center">
                <img alt="Ảnh đại diện người dùng" src="{{ asset('storage/' . $user->anh_dai_dien) }}"
                    style="border-radius: 50%; height: 100px; width: 100px; object-fit: cover" />
            </div>

            <div class="form-group mb-3">
                <label for="ho_ten">Họ và tên</label>
                <input type="text" id="ho_ten" value="{{ $user->ho_ten }}" disabled />
            </div>

            <div class="form-group mb-3">
                <label for="gioi_tinh">Giới tính</label>
                <input type="text"
                    value="{{ $user->gioi_tinh === 'Nam' ? 'Nam' : ($user->gioi_tinh === 'Nu' ? 'Nữ' : 'Thông tin chưa được cập nhật') }}"
                    id="gioi_tinh" disabled />

            </div>

            <div class="form-group mb-3">
                <label for="dia_chi">Địa chỉ</label>
                <input type="text" name="dia_chi" id="dia_chi"
                    value="{{ $user->dia_chi ? $user->dia_chi : 'Thông tin chưa được cập nhật' }}" disabled />

            </div>

            <div class="form-group mb-3">
                <label for="nam_sinh">Năm sinh</label>
                <input type="text" name="nam_sinh" id="nam_sinh"
                    value="{{ date('d/m/Y', strtotime($user->nam_sinh)) }}" disabled />
            </div>

            <div class="form-group mb-3">
                <label for="so_dien_thoai">Số điện thoại</label>
                <input type="number" name="so_dien_thoai" value="{{ $user->so_dien_thoai }}" id="so_dien_thoai"
                    disabled />
            </div>

            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" value="{{ $user->email }}" id="email" disabled />
            </div>

            <div class="text-center">
                <a class="btn btn-warning" href="{{ route('formcapnhat') }}"> Cập nhật thông tin tài khoản</a>
            </div>
        </div>

    </div>
@endsection
