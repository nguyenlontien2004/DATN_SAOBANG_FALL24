@extends('layout.user')

@section('content')
    <div class="container5999">
        <div class="sidebar6669">
            <img alt="Ảnh đại diện người dùng"
                src="https://storage.googleapis.com/a1aa/image/u9y6E0sefgilO0ViSNJkVoITvkptQM6YskJidpWdJi4iLFlTA.jpg" />
            <div class="username">Tên người dùng</div>
            <hr />
            <a href="#">Thông tin cá nhân</a>
            <a href="#">Đổi mật khẩu</a>
            <a href="#">Lịch sử đặt vé</a>
            <a href="#">Cập nhật thông tin cá nhân</a>
        </div>
        <div class="content">
            <h1>Đổi mật khẩu</h1>
            <form action="{{ route('doimatkhau') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="old-password">Mật khẩu cũ</label>
                    <input type="password" id="old-password" name="mat_khau_cu" value="{{ old('mat_khau_cu') }}"
                        placeholder="Nhập mật khẩu cũ" />
                    @error('mat_khau_cu')
                        <div class="text text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="new-password">Mật khẩu mới</label>
                    <input type="password" id="new-password" name="mat_khau_moi" value="{{ old('mat_khau_moi') }}"
                        placeholder="Nhập mật khẩu mới" />
                    @error('mat_khau_moi')
                        <div class="text text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="confirm-password">Xác minh mật khẩu mới</label>
                    <input type="password" id="confirm-password" name="mat_khau_moi_confimation"
                        value="{{ old('mat_khau_cu') }}" placeholder="Xác minh mật khẩu mới" />
                    @error('mat_khau_moi_confimation')
                        <div class="text text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button class="btn123">Đổi mật khẩu</button>
            </form>
        </div>
    </div>
@endsection
