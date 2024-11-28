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
                    <div class="divider mx-4"></div>
                    <!-- Dấu gạch ngăn cách theo chiều dọc -->
                    <div class="w-2/3 pl-8 flex">
                        <div class="flex-shrink-0">
                            <!-- <img class="rounded-lg shadow-lg"
                                src="https://cinema.momocdn.net/img/57605275586959326-Mai_600x800.png" alt="Poster Phim"
                                width="150" /> -->

                        </div>
                        <div class="ml-4">
                            <div class="dong mb-2">
                                <p class="text-lg font-bold flex-grow">Phim: {{ $ve->suatChieu->phim->ten_phim }}</p>
                                <p class="ms-5 flex-none">Ngày vé  {{ $ve->ngay_ve_mo }} -
                                    {{ $ve->suatChieu->gio_bat_dau."~".$ve->suatChieu->gio_ket_thuc }}</p>
                            </div>
                            <p class="mt-4">Mã vé: <strong>{{ $ve->ma_code_ve }}</strong></p>
                            <p class="mt-2">Rạp: <strong>{{ $ve->suatChieu->phongChieu->rap->ten_rap }}</strong></p>
                            <p class="mt-1">Phòng chiếu: <strong>{{ $ve->suatChieu->phongChieu->ten_phong_chieu }}</strong></p>
                            <div class="mt-1">
                                <p class="d-flex">Ghế:
                                    @foreach ($ghe as $key=>$value)
                                    <strong>
                                    @for ($i = 0; $i < count($value); $i++) @if ($key=='doi' )
                                        {{ $value[$i]->hang_ghe . $value[$i]->so_hieu_ghe . $value[$i + 1]->hang_ghe . $value[$i + 1]->so_hieu_ghe}}{{ isset($value[$i + 2]) ? "," : "" }}
                                        @php $i++ @endphp @else
                                        {{ $value[$i]->hang_ghe . $value[$i]->so_hieu_ghe }}{{ isset($value[$i + 1]) ? "," : "" }}
                                        @endif 
                                    @endfor
                                    </strong>
                                    -
                                    <span>Loại: <strong>
                                    @if ($key == 'thuong')
                                    Thường
                                    @elseif($key == 'vip')
                                    Vip
                                    @else
                                    Đôi
                                    @endif
                                    &nbsp;
                                    </strong></span>
                                    @endforeach
                                </p>
                                <p class="mt-1">Đồ ăn:    @if (count($food) > 0)
                                    {{ implode(
                                        ', ',
                                        array_map(function ($item) {
                                            return $item['food']['ten_do_an'] . ' x ' . $item['so_luong_do_an'];
                                        }, $food->toArray()),
                                    ) }}
                                @else
                                    Không mua
                                @endif</p>
                               <p class="mt-1">Mã giảm giá: <strong>{{ $ve->maGiamGia == null ? 'Không áp dụng' : $ve->maGiamGia->ten_ma_giam_gia.'-'.$ve->maGiamGia->gia_tri_giam.'%' }}</strong></p>
                               <p class="mt-1" style="font-size:18px;font-weight:500;">Tổng đơn hàng: {{ number_format($ve->tong_tien,0,',','.') }}đ</p>
                            </div>
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
