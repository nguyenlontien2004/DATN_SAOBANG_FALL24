@extends('layout.user')

@section('content')
    <div class="container5999">
        <div class="sidebar6669">
            <img alt="Ảnh đại diện người dùng"
                src="https://storage.googleapis.com/a1aa/image/u9y6E0sefgilO0ViSNJkVoITvkptQM6YskJidpWdJi4iLFlTA.jpg" />
            <div class="username">Tên người dùng</div>
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
            <div class="form-group text-center">
                <img alt="Ảnh đại diện người dùng"
                    src="https://storage.googleapis.com/a1aa/image/u9y6E0sefgilO0ViSNJkVoITvkptQM6YskJidpWdJi4iLFlTA.jpg"
                    style="border-radius: 50%; height: 100px; width: 100px" />
            </div>
            <div class="form-group">
                <label for="full-name">Họ và tên</label>
                <input type="text" id="full-name" placeholder="Nhập họ tên" />
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Nhập email" />
            </div>
            
            <div class="text-center">
                <button class="btn">Cập nhật thông tin tài khoản</button>
            </div>
        </div>
    </div>
@endsection
