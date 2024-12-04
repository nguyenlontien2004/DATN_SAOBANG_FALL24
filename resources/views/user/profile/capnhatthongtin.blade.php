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
        </div>

        <div class="content">
            <h1>Cập nhật thông tin</h1>

            <form action="{{ route('capnhatthongtin') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group mb-3 d-flex justify-content-center align-items-center">
                    <img alt="Ảnh đại diện người dùng" src="{{ asset('storage/' . $user->anh_dai_dien) }}"
                        style="border-radius: 50%; height: 100px; width: 100px; object-fit: cover" />
                </div>

                <div class="form-group mb-3">
                    <label for="anh_dai_dien">Chọn ảnh đại diện mới</label>
                    <input type="file" name="anh_dai_dien" id="anh_dai_dien" class="form-control" accept="image/*" />
                </div>

                <div class="form-group mb-3">
                    <label for="ho_ten">Họ và tên</label>
                    <input type="text" name="ho_ten" id="ho_ten" value="{{ $user->ho_ten }}" />
                </div>

                <div class="form-group mb-3">
                    <label for="gioi_tinh">Giới tính</label>
                    <select name="gioi_tinh" class="form-control" id="">
                        <option value="">Chọn giới tính</option>
                        <option value="Nam">Nam</option>
                        <option value="Nu">Nữ</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="dia_chi">Địa chỉ</label>
                    <input type="text" name="dia_chi" id="dia_chi" value="{{ $user->dia_chi }}" />
                </div>

                <div class="form-group mb-3">
                    <label for="so_dien_thoai">Số điện thoại</label>
                    <input type="number" name="so_dien_thoai" value="{{ $user->so_dien_thoai }}" id="so_dien_thoai"/>
                </div>

                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email"  value="{{ $user->email }}" id="email" disabled />
                </div>


                <div class="text-center">
                    <button type="submit" class="btn btn-success">Cập nhật</button>
                </div>
            </form>
        </div>

    </div>
    
@endsection
