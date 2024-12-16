@extends('layout.user')
@section('title')
{{ 'Đặt vé' }}
@endsection

@section('content')
<style>
    .choose-seat {
        display: block;
    }

    .choose-food {
        display: none;
    }

    .unavailabledrop {
        /* display: block; */
        background-color: #cdcdcd;
        white-space: nowrap;
        /* height: 20px;
    width: 20px; */
        border-radius: 2px;
        position: relative;
        background-position: 50%;
        background-repeat: no-repeat;
        background-image: url('https://cdn.moveek.com/build/images/seat-unavailable.6c1ab33c.png');
        z-index: 99999;
        cursor: no-drop;
        color: #ababab;
    }
</style>
<div class="main-content" style="margin-top: -25px;">
    <div>
        <div class="ticketing-steps" style="border-top: 1px solid #d4d4d4">
            <div class="container-ticket-steps">
                <div class="row">
                    <div class="ticketing-step col">
                        <div class="wrapper-content chonghe text-danger">
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
                        <div class="wrapper-content">
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
        <div class="container-seat" style="position: relative;">
            <div class="mb-3"></div>
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="col-12 choose-seat">
                        <div class="seat-selection">
                            <div class="legend">
                                <div>
                                    <span class="selected"></span>
                                    <p>Ghế bạn chọn</p>
                                </div>
                                <div>
                                    <span class="unavailable"></span>
                                    <p>Không thể chọn</p>
                                </div>
                                <div>
                                    <span class="taken"></span>
                                    <p>Đã bán</p>
                                </div>
                            </div>
                            <span class="front">Màn hình</span>
                            <div class="seats-wrapper-parent">
                                <div class="seats-wrapper-row">
                                    <div class="seats-row">
                                        <div class="row-wrapper">
                                            <div class="seat-row">A</div>
                                            <div class="seat-row">B</div>
                                            <div class="seat-row">C</div>
                                            <div class="seat-row">D</div>
                                            <div class="seat-row">E</div>
                                            <div class="seat-row">F</div>
                                            <div class="seat-row">G</div>
                                            <div class="seat-row">H</div>
                                            <div class="seat-row">I</div>
                                        </div>
                                    </div>
                                    <div class="seats-map">
                                        <div class="row-wrapper list-row-seats">
                                            @foreach ($hangghe as $key => $value)
                                                @if (count($value) <= 0)
                                                    <ul class="seat-row">
                                                        <li class="empty"></li>
                                                    </ul>
                                                @endif
                                                <ul class="seat-row">
                                                    @for ($i = 0; $i < count($value); $i++)
                                                        @if ($value[$i]['isDoubleChair'] !== null && $i + 1 < count($value))
                                                            {{-- Ghế đôi --}}
                                                            <div id="{{ $value[$i]['id'] . '-' . $value[$i + 1]['id'] }}"
                                                                data-type="{{ $value[$i]['the_loai'] }}"
                                                                class="seat-group-parent doubSeat seats {{ $value[$i]['chitietve_count'] >= 1 ? 'takenSeat' : '' }}">
                                                                <li id="{{ $value[$i]['id'] }}"
                                                                    data-hang="{{ $key . $value[$i]['so_hieu_ghe'] }}"
                                                                    class="seat-group">
                                                                    {{ $key . $value[$i]['so_hieu_ghe'] }}
                                                                </li>
                                                                <li id="{{ $value[$i + 1]['id'] }}"
                                                                    data-hang="{{ $key . $value[$i + 1]['so_hieu_ghe'] }}"
                                                                    class="seat-group">
                                                                    {{ $key . $value[$i + 1]['so_hieu_ghe'] }}
                                                                </li>
                                                            </div>
                                                            {{-- --}}
                                                            @php            $i++ @endphp
                                                        @else
                                                            {{-- Ghế thường --}}
                                                            <li id="{{ $value[$i]['id'] }}" data-type="{{ $value[$i]['the_loai'] }}"
                                                                data-hang="{{ $key . $value[$i]['so_hieu_ghe'] }}"
                                                                class="seats {{ $value[$i]['chitietve_count'] >= 1 ? 'takenSeat' : '' }} {{ $value[$i]['the_loai'] == 'thuong' ? 'regularchair' : 'seatVip' }}">
                                                                {{ $key . $value[$i]['so_hieu_ghe'] }}
                                                            </li>
                                                        @endif
                                                    @endfor
                                                </ul>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 choose-food">
                        <div class="table-responsive table-food">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Combo</th>
                                        <th>Giá tiền</th>
                                        <th>Số lượng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($doAn as $item)
                                        <tr>
                                            <td class="concession-name d-flex align-items-center">
                                                <img width="70px" src="{{ asset('storage/' . $item->hinh_anh) }}" alt="">
                                                <div>
                                                    {{$item->ten_do_an}} <br>
                                                    <span>
                                                        TIẾT KIỆM 46K!!! Gồm: 1 Bắp (69oz) + 2 Nước
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="concession-price text-right">
                                                {{ number_format($item->gia, 0, ',', '.') }}&nbsp;₫
                                            </td>
                                            <td>
                                                <div class="quantity-toggle-food">
                                                    <a class="minus" id="{{ $item->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="0.75" stroke-linecap="round"
                                                            stroke-linejoin="round" class="lucide lucide-minus">
                                                            <path d="M5 12h14" />
                                                        </svg>
                                                    </a>
                                                    <input type="number" class="quanlity-{{ $item->id }}"
                                                        data-gia="{{$item->gia}}" min="0" max="10" value="0"
                                                        style="width: 30px;">
                                                    <a class="plus" id="{{ $item->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="0.75" stroke-linecap="round"
                                                            stroke-linejoin="round" class="lucide lucide-plus">
                                                            <path d="M5 12h14" />
                                                            <path d="M12 5v14" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12 order-sm-last">
                    <div class="container-ticket-information">
                        <div class="content-ticket-information">
                            <p>{{ $suatchieu->phim->ten_phim }}</p>
                            <strong>{{ $suatchieu->phongChieu->rap->ten_rap }}</strong>
                            <p>Suất <strong>{{ $suatchieu->gio_bat_dau . '~' . $suatchieu->gio_ket_thuc }}</strong> Ngày
                                <strong>{{ $date }}</strong>
                            </p>
                            <p>{{ $suatchieu->phongChieu->ten_phong_chieu }} - Ghế <strong
                                    class="so-hieu-hang-ghe">...</strong></p>
                        </div>
                    </div>
                    <div class="container-total-oldel-ticket d-flex">
                        <div class="content-total-oldel-ticket">
                            <p class="text-total">Tổng đơn hàng</p>
                            <span class="total">0</span>&nbsp;₫
                        </div>
                        <div class="content-total-oldel-ticket">
                            <div id="countdown-timer">
                                <!-- <p class="text-total">Thời gian mua vé</p> -->
                                <span style="display: none;" id="timer"></span>
                            </div>
                        </div>
                    </div>
                    <div class="flow-actions sticky-footer-bars">
                        <div class="flow-actions sticky-footer-bars">
                            <div class="row">
                                <div class="col-3"><a
                                        class="action-pre btn btn-lg btn-outline-dark btn-block  disabled">
                                        ←
                                    </a></div>
                                <!-- disabled -->
                                <div class="col-9 button-next"><a
                                        class="action-next btn btn-lg btn-dark btn-block btn-next-foof disabled"><span
                                            data-v-0c8aac4d="" class="d-md-none">0&nbsp;₫ |</span>
                                        Tiếp tục
                                    </a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="loading-chuyen-trang" style="width: 100%;height:100%;position: absolute;top:0;display:none;">
                <span class="loader" style="position: absolute;top:3px;left:50%;"></span>
            </div>
        </div>
    </div>
</div>
<script>
    const id = "{{ $id }}"
    const ngay = "{{ $date }}"
    const gia = "{{ $suatchieu->gia }}"
    const urlaApiThanhToan = "{{ asset('/api/post/thanh-toan/') }}"
    const urlaApiGhe = "{{ asset('/api/ghe/suat-chieu/') }}"
    const kiemtrahansuatchieu = Boolean("{{ $isHan }}")
    console.log(kiemtrahansuatchieu);

    //$('asa').
</script>
@vite('resources/js/reatimeGhe.js')
<script src="{{ asset('js/reatimeGhe.js') }}"></script>
@endsection