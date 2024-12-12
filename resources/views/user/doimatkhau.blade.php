@extends('layout.user')

@section('content')
    <div class="container5999" style="max-width:85%; margin:0 auto;">

        @php
            $user = Auth::user();
        @endphp

        <div class="sidebar6669">
            <div class="form-group mb-3 d-flex justify-content-center align-items-center">
                <img alt="Ảnh đại diện người dùng" src="{{ Auth::user()->anh_dai_dien != "" ? asset('storage/' . Auth::user()->anh_dai_dien) : 'https://cdn.moveek.com/bundles/ornweb/img/no-avatar.png' }}"
                    style="border-radius: 50%; height: 100px; width: 100px; object-fit: cover" />
            </div>
            <div class="username">{{ $user->ho_ten }} <span>{{Auth::user()->gold }} xu</span></div>
            <hr />
            <a href="{{ route('thong-tin-nguoi-dung') }}">Thông tin cá nhân</a>
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
            <h1>Đổi mật khẩu</h1>
            <div class="thongbao text-center">
                @if (session('success'))
                    <span class="alert alert-success font-weight-bold"
                        style="font-size: 1.2rem;">{{ session('success') }}</span>
                @endif
            </div>
            <form action="{{ route('capnhatmk') }}" method="post">
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
                    <input type="password" id="confirm-password" name="mat_khau_moi_confirmation"
                        value="{{ old('mat_khau_moi_confirmation') }}" placeholder="Xác minh mật khẩu mới" />
                    @error('mat_khau_moi_confirmation')
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
