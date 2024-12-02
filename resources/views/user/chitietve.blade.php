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
            <img alt="Ảnh đại diện người dùng" src="{{ asset('storage/' . $user->anh_dai_dien) }}" />
            <div class="username">{{ $user->ho_ten }}</div>
            <hr />
            <a href="#">Thông tin cá nhân</a>
            <a href="#">Đổi mật khẩu</a>
            <a href="#">Lịch sử đặt vé</a>
            <a href="#">Cập nhật thông tin cá nhân</a>
        </div>
        <div class="content">
            <h3>Chi tiết mã vé đặt: #39688{{ $chiTietVe->id }}</h3>
            <div class="flex3 items-start p-4 bg-white rounded-lg shadow-md">
                <img class="rounded-lg shadow-lg" src="https://img.youtube.com/vi/pnSsgRJmsCc/hqdefault.jpg"
                    onclick="playVideo('https://www.youtube.com/embed/pnSsgRJmsCc?autoplay=1&enablejsapi=1')"
                    style="cursor: pointer; width: 300px; height: auto;" alt="Poster Phim" width="150" />
                <div class="ml-4">
                    <div class="flex3 justify-between items-center mb-2">
                        <p class="text-lg font-bold">Phim:
                            {{ $chiTietVe->suatChieu->phim->ten_phim ?? 'Thông tin không khả dụng' }}</p>
                        <p class="text-gray-600 ms-5">
                            <strong>{{ $chiTietVe->created_at ?? 'Thông tin không khả dụng' }}</strong></p>
                    </div>
                    <p class="font-bold mt-2 text-gray-800">
                        Rạp CGV: {{ $chiTietVe->suatChieu->phongChieu->rap->ten_rap ?? 'Thông tin không khả dụng' }}
                    </p>
                    <p class="font-bold mt-2 text-gray-800">
                        Địa điểm: {{ $chiTietVe->suatChieu->phongChieu->rap->dia_diem ?? 'Thông tin không khả dụng' }}
                    </p>
                    <div class="font-bold mt-2 text-gray-800">

                        @foreach ($chiTietVe->suatChieu->phongChieu->gheNgois->unique('hang_ghe') as $ghe)
                            <p>Hàng ghế: {{ $ghe->hang_ghe }}{{ $ghe->so_hieu_ghe }}</p>
                        @endforeach
                        <p class="mt-2 text-gray-800">
                            Rạp CGV: {{ $chiTietVe->suatChieu->phongChieu->ten_phong_chieu ?? 'Thông tin không khả dụng' }}
                        </p>
                        <p class="mt-2 text-gray-800">
                            Phương thức thanh toán:
                            {{ $chiTietVe->phuong_thuc_thanh_toan ?? 'Thông tin không khả dụng' }}
                        </p>
                        <p class="mt-2 text-danger">
                            Tổng tiền:
                            {{ number_format($chiTietVe->tong_tien, 0, ',', '.') ?? 'Thông tin không khả dụng' }}
                            VNĐ
                        </p>
                    </div>
                </div>
            </div>
            <div class="text-end m-3">
                <a href="{{ route('lichsudatve') }}" class="btn-custom"> Quay lại</a>
            </div>
        </div>
    </div>
@endsection
