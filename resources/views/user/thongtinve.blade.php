@extends('layout.user')

@section('content')
    <div class="main-content">
        <div>
            <div class="ticketing-steps" style="border-top: 1px solid #d4d4d4">
                <div class="container-ticket-steps">
                    <div class="row">
                        <div class="ticketing-step col">
                            <div class="wrapper-content chonghe">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-layout-grid">
                                    <rect width="7" height="7" x="3" y="3" rx="1" />
                                    <rect width="7" height="7" x="14" y="3" rx="1" />
                                    <rect width="7" height="7" x="14" y="14" rx="1" />
                                    <rect width="7" height="7" x="3" y="14" rx="1" />
                                </svg>
                                <span>Chọn ghế</span>
                            </div>
                            <span class="next-icon-ticket">
                                <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="0.75" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-chevron-right">
                                    <path d="m9 18 6-6-6-6" />
                                </svg>
                            </span>
                        </div>
                        <div class="ticketing-step col">
                            <div class="wrapper-content chonDoAn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-shopping-bag">
                                    <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z" />
                                    <path d="M3 6h18" />
                                    <path d="M16 10a4 4 0 0 1-8 0" />
                                </svg>
                                <span>Đồ ăn</span>
                            </div>
                            <span class="next-icon-ticket">
                                <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="0.75" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-chevron-right">
                                    <path d="m9 18 6-6-6-6" />
                                </svg>
                            </span>
                        </div>
                        <div class="ticketing-step col">
                            <div class="wrapper-content">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-credit-card">
                                    <rect width="20" height="14" x="2" y="5" rx="2" />
                                    <line x1="2" x2="22" y1="10" y2="10" />
                                </svg>
                                <span>Thanh toán</span>
                            </div>
                            <span class="next-icon-ticket">
                                <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="0.75" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-chevron-right">
                                    <path d="m9 18 6-6-6-6" />
                                </svg>
                            </span>
                        </div>
                        <div class="ticketing-step col">
                            <div class="wrapper-content text-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-inbox">
                                    <polyline points="22 12 16 12 14 15 10 15 8 12 2 12" />
                                    <path
                                        d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z" />
                                </svg>
                                <span>Thông tin vé</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-seat">
                <!-- Khối chứa QR code và thông tin vé -->
                <div class="qr-info-container mt-5 mb-5">
                    <div class="ttv flex mt-6">
                        <div class="w-1/3 text-center">
                            <!-- qr-code p-8  -->
                            <div class="flex flex-col items-center justify-center">
                                <p class="text-lg font-bold">QR CODE</p>
                                <div>
                                    {!! $ve->qr_code !!}
                                </div>
                            </div>
                            <p class="mt-4 text-sm">
                                Vui lòng đưa mã Qr này đến quầy vé để nhận vé của bạn
                            </p>
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
                                    <p class="ms-5 flex-none">Ngày vé {{ $ve->ngay_ve_mo }} -
                                        {{ $ve->suatChieu->gio_bat_dau . '~' . $ve->suatChieu->gio_ket_thuc }}</p>
                                </div>
                                <p class="mt-4">Mã vé: <strong>{{ $ve->ma_code_ve }}</strong></p>
                                <p class="mt-2">Rạp: <strong>{{ $ve->suatChieu->phongChieu->rap->ten_rap }}</strong></p>
                                <p class="mt-1">Phòng chiếu:
                                    <strong>{{ $ve->suatChieu->phongChieu->ten_phong_chieu }}</strong></p>
                                <div class="mt-1">
                                    <p class="d-flex">Ghế:
                                        @foreach ($ghe as $key => $value)
                                            <strong>
                                                @for ($i = 0; $i < count($value); $i++)
                                                    @if ($key == 'doi')
                                                        {{ $value[$i]->hang_ghe . $value[$i]->so_hieu_ghe . $value[$i + 1]->hang_ghe . $value[$i + 1]->so_hieu_ghe }}{{ isset($value[$i + 2]) ? ',' : '' }}
                                                        @php $i++ @endphp
                                                    @else
                                                        {{ $value[$i]->hang_ghe . $value[$i]->so_hieu_ghe }}{{ isset($value[$i + 1]) ? ',' : '' }}
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
                                    <p class="mt-1">Đồ ăn: @if (count($food) > 0)
                                            {{ implode(
                                                ', ',
                                                array_map(function ($item) {
                                                    return $item['food']['ten_do_an'] . ' x ' . $item['so_luong_do_an'];
                                                }, $food->toArray()),
                                            ) }}
                                        @else
                                            Không mua
                                        @endif
                                    </p>
                                    <p class="mt-1">Mã giảm giá:
                                        <strong>{{ $ve->maGiamGia == null ? 'Không áp dụng' : $ve->maGiamGia->ten_ma_giam_gia . '-' . $ve->maGiamGia->gia_tri_giam . '%' }}</strong>
                                    </p>
                                    <p class="mt-1" style="font-size:18px;font-weight:500;">Tổng đơn hàng:
                                        {{ number_format($ve->tong_tien, 0, ',', '.') }}đ</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Nút quay lại trang chủ -->
                    <div class="text-end m-3">
                        <a href="{{ asset('/') }}" class="btn-custom"> Quay lại trang chủ </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
