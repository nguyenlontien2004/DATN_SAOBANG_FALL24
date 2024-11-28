<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .container {
        display: flex;
    }

    .text-center {
        text-align: center;
    }

    .w-1-3 {
        width: 33.333333%;
    }

    .justify-center {
        justify-content: center;
    }

    .items-center {
        align-items: center;
    }

    .flex-col {
        flex-direction: column;
    }

    .flex {
        display: flex;
    }

    .font-bold {
        font-weight: 700;
    }

    .text-lg {
        font-size: 1.125rem;
        line-height: 1.75rem;
    }

    .rounded-md {
        border-radius: 0.375rem;
    }

    .mt-4 {
        margin-top: 1rem;
    }

    .mt-4 {
        margin-top: 1.5rem;
    }

    .mt-4,
    .my-4 {
        margin-top: 1.5rem;
    }

    img,
    video {
        max-width: 100%;
        height: auto;
    }

    .text-sm {
        font-size: 0.875rem;
        line-height: 1.25rem;
    }

    .divider {
        width: 1px;
        background-color: #e5e7eb;
        height: 100%;
    }

    .mx-4 {
        margin-right: 1.5rem !important;
        margin-left: 1.5rem !important;
    }

    .pl-8 {
        padding-left: 2rem;
    }

    .w-2\/3 {
        width: 66.666667%;
    }

    .flex-shrink-0 {
        flex-shrink: 0 !important;
    }

    .ml-4,
    .mx-4 {
        margin-left: 1.5rem
    }

    .shadow-lg {
        --tw-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        --tw-shadow-colored: 0 10px 15px -3px var(--tw-shadow-color), 0 4px 6px -4px var(--tw-shadow-color);
        box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
    }

    .rounded-lg {
        border-radius: .3rem !important;
    }

    .ttv {
        flex-wrap: wrap;
    }

    .center {
        display: flex;
        justify-content: center;
    }

    @media only screen and (max-width: 600px) {
        .media {
            flex-wrap: wrap;
        }

        .media img {
            display: flex;
            justify-content: center;
        }

        .image-anh-phim {
            display: flex;
            justify-content: center;
            text-align: center;
        }
        .content{
            margin-left: 0px;
        }
    }
</style>

<body>
    <div class="qr-info-container mt-5 mb-5">
        <div style="display: flex;align-items:center;justify-content:start;margin-left:5px;width:100%;">
           @if ($ve['phuong_thuc_thanh_toan'] == 'MoMo')
           <img width="40px" src="https://cdn.moveek.com/bundles/ornweb/img/momo-icon.png"
           alt="">
           @elseif($ve['phuong_thuc_thanh_toan'] == 'VNPAY')
           <img width="40px" src="https://vinadesign.vn/uploads/images/2023/05/vnpay-logo-vinadesign-25-12-57-55.jpg"
           alt="">
           @else
           <img width="40px" src="https://cdn.haitrieu.com/wp-content/uploads/2022/10/Logo-ZaloPay-Square.png"
           alt="">
           @endif
            <div
                style="width:auto;display:flex;align-items:center;justify-content:start;flex-direction: column;">
                <p style="margin-bottom: 5px;margin-top: 0px;margin-left: 10px;">{{ $ve['ngay_ve_mo'] }} <span style="padding-left: 2px;padding-right: 2px;" >/</span> {{ $ve['suat_chieu']['gio_bat_dau'] . "~" . $ve['suat_chieu']['gio_ket_thuc'] }}
                </p>
                <strong style="margin-top:-5.5px;">Thanh toán qua {{ $ve['phuong_thuc_thanh_toan'] }}</strong>
            </div>
        </div>
        <div class="ttv flex mt-6 center mt-4 ">
            <div class="text-center" style="width: 100%;">
                <!-- qr-code p-8  -->
                <div class="flex flex-col items-center justify-center">
                    <p class="text-lg font-bold">QR CODE</p>
                    {!! $ve['qr_code'] !!}
                </div>
                <p class="mt-4 text-sm" style="margin-top: 5px;margin-bottom: 5px;">
                    Vui lòng đưa mã Qr này đến quầy vé để nhận vé của bạn
                </p>
            </div>
            <div class="divider mx-4"></div>
            <!-- Dấu gạch ngăn cách theo chiều dọc -->
            <div class="flex media" style="padding-left:25px;">
                <div class="flex-shrink-0 image-anh-phim" style="margin-top:15px;">
                    <!-- <img class="rounded-lg shadow-lg"
                        src="https://cinema.momocdn.net/img/57605275586959326-Mai_600x800.png" alt="Poster Phim"
                        width="150" /> -->
                </div>
                <div class="ml-4 content">
                    <div class="dong mb-2">
                        <p class="text-lg font-bold flex-grow">Quý khác đã mua vé xem phim:
                            {{ $ve['suat_chieu']['phim']['ten_phim'] }}</p>

                    </div>
                    <p class="ms-5 flex-none">Ngày vé {{ $ve['ngay_ve_mo'] }} -
                        {{ $ve['suat_chieu']['gio_bat_dau'] . "~" . $ve['suat_chieu']['gio_ket_thuc'] }}
                    </p>
                    <p class="mt-4">Mã vé: <strong>{{ $ve['ma_code_ve'] }}</strong></p>
                    <p style="margin-top: 5px;">Rạp: <strong>{{ $ve['suat_chieu']['phong_chieu']['rap']['ten_rap'] }}</strong></p>
                    <p class="mt-1">Phòng chiếu:
                        <strong>{{ $ve['suat_chieu']['phong_chieu']['ten_phong_chieu'] }}</strong></p>
                    <div class="mt-1">
                        <p class="d-flex">Số ghế:
                            @foreach ($ghe as $key => $value)
                                <strong>
                                    @for ($i = 0; $i < count($value); $i++) @if ($key == 'doi')
                                        {{ $value[$i]['hang_ghe'] . $value[$i]['so_hieu_ghe'] . $value[$i + 1]['hang_ghe'] . $value[$i + 1]['so_hieu_ghe']}}{{ isset($value[$i + 2]) ? "," : "" }}
                                    @php            $i++ @endphp @else
                                        {{ $value[$i]['hang_ghe'] . $value[$i]['so_hieu_ghe'] }}{{ isset($value[$i + 1]) ? "," : "" }}
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
                                    </strong></span>
                            @endforeach
                        </p>
                        <p class="mt-1">Đồ ăn: @if (count($food) > 0)
                                                    {{ implode(
                                ', ',
                                array_map(function ($item) {
                                    return $item['food']['ten_do_an'] . ' x ' . $item['so_luong_do_an'];
                                }, $food),
                            ) }}
                        @else
                            Không mua
                        @endif
                        </p>
                        <p class="mt-1">Mã giảm giá:
                            <strong>{{ $ve['ma_giam_gia'] == null ? 'Không áp dụng' : $ve['ma_giam_gia']['ten_ma_giam_gia'] . '-' . $ve['ma_giam_gia']['gia_tri_giam'] . '%' }}</strong>
                        </p>
                        <p class="mt-1" style="font-size:18px;font-weight:500;">Tổng đơn hàng:
                            {{ number_format($ve['tong_tien'], 0, ',', '.') }}đ
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>