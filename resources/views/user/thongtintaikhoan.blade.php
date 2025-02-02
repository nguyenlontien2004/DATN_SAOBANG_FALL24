@extends('layout.user')

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
            <a href="{{ route('admin.ttadmin') }}">Thông tin cá nhân</a>
            <a href="{{ route('doimatkhau') }}">Đổi mật khẩu</a>
            <a href="#">Lịch sử đặt vé</a>
            <a href="{{ route('formcapnhat') }}">Cập nhật thông tin cá nhân</a>
            <a href="" class="text-danger">
                <form action="{{ route('dangxuat') }}" method="POST">
                    @csrf
                    <button type="submit">Đăng xuất</button>
                </form>
        </div>

        <div class="content">
            <h1>Thông tin cá nhân</h1>

            <div class="form-group mb-3 d-flex justify-content-center align-items-center">
                <img alt="Ảnh đại diện người dùng" src="{{ asset('storage/' . $user->anh_dai_dien) }}"
                    style="border-radius: 50%; height: 100px; width: 100px; object-fit: cover" />
            </div>

            <div class="form-group mb-3">
                <label for="ho_ten">Họ và tên</label>
                <input type="text" id="ho_ten" value="{{ $user->ho_ten }}" placeholder="Nhập họ tên" />
            </div>

            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" value="{{ $user->email }}" id="email" placeholder="Nhập email" />
            </div>

            <div class="form-group mb-3">
                <label for="password">Mật khẩu</label>
                <input type="password" value="{{ $user->password }}" id="password" placeholder="Nhập mật khẩu mới" />
            </div>

            <div class="text-center">
                <a class="btn btn-warning" href="{{ route('formcapnhat') }}"> Cập nhật thông tin tài khoản</a>
            </div>
        </div>

    </div>
@endsection
