@extends('layout.user')

@section('content')
    <div class="max-w-4xl mx-auto p-4">
        <div class="flex justify-between items-center border-b pb-2 mb-4">
            <div class="text-center">
                <i class="fas fa-th-large text-gray-400"></i>
                <p class="text-sm text-gray-400">Chọn ghế</p>
            </div>
            <div class="text-center">
                <i class="fas fa-arrow-right text-gray-400"></i>
                <p class="text-sm text-gray-400">Đồ ăn</p>
            </div>
            <div class="text-center">
                <i class="fas fa-credit-card text-gray-400"></i>
                <p class="text-sm text-gray-400">Thanh toán</p>
            </div>
            <div class="text-center">
                <i class="fas fa-calendar-alt text-red-500"></i>
                <p class="text-sm text-red-500">Thông tin vé</p>
            </div>
        </div>

        <!-- Khối chứa QR code và thông tin vé -->
        <div class="qr-info-container">
            <div class="ttv flex mt-6">
                <div class="w-1/3 text-center">
                    <div class="qr-code p-8 flex flex-col items-center justify-center">
                        <p class="text-lg font-bold">QR CODE</p>
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=Your%20QRCode%20Data"
                            alt="QR Code" class="mt-4 rounded-md" />
                    </div>
                    <p class="mt-4 text-sm">
                        Vui lòng đưa mã Qr này đến quầy vé để nhận vé của bạn
                    </p>
                </div>
                <div class="divider mx-4"></div>
                <!-- Dấu gạch ngăn cách theo chiều dọc -->
                <div class="w-2/3 pl-8 flex">
                    <div class="flex-shrink-0">
                        <img class="rounded-lg shadow-lg"
                            src="https://cinema.momocdn.net/img/57605275586959326-Mai_600x800.png" alt="Poster Phim"
                            width="150" />
                    </div>
                    <div class="ml-4">
                        <div class="dong mb-2">
                            <p class="text-lg font-bold flex-grow">Phim: Cám</p>
                            <p class="ms-5 flex-none">Ngày 21/9/2024 - 20:30</p>
                        </div>
                        <p class="mt-4">Rạp CGV: CGV Vincom Gò Vấp</p>
                        <div class="font-bold mt-2">
                            <p>Ghế: C3, C4</p>
                            <p>Phòng chiếu: Cinema 3</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Nút quay lại trang chủ -->
            <div class="text-end m-3">
                <a href="/" class="btn-custom"> Quay lại trang chủ </a>
            </div>
        </div>
    </div>
@endsection
