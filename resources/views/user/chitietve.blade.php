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
            <h3>Chi tiết mã vé đặt:#566</h3>
            <div class="flex3 items-start p-4 bg-white rounded-lg shadow-md">
                <img class="rounded-lg shadow-lg" src="https://cinema.momocdn.net/img/57605275586959326-Mai_600x800.png"
                    alt="Poster Phim" width="150" />
                <div class="ml-4">
                    <div class="flex3 justify-between items-center mb-2">
                        <p class="text-lg font-bold">Phim: Cám</p>
                        <p class="text-gray-600 ms-5">Ngày 21/9/2024 - 20:30</p>
                    </div>
                    <p class="mt-2 text-gray-800">Rạp CGV: CGV Vincom Gò Vấp</p>
                    <div class="font-bold mt-2 text-gray-800">
                        <p>Ghế: C3, C4</p>
                        <p>Phòng chiếu: Cinema 3</p>
                    </div>
                </div>
            </div>
            <div class="text-end m-3">
                <a href="/" class="btn-custom"> Quay lại</a>
            </div>
        </div>
    </div>
@endsection
