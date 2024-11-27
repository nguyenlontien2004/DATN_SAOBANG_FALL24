@extends('layout.user')
@section('title')
{{ 'Thanh toán' }}
@endsection

@section('content')
<style>
    .thanhtoanquavi:hover {
        border: 1px solid #adadad;
        border-radius: 4px;
        background-color: #edf1f2;
    }
    .activeThanhToan{
        border: 1px solid #adadad;
        border-radius: 4px;
        background-color: #edf1f2;
    }
    .activeThanhToan .icon-check{
       display: block;
    }
    .thanhtoanquavi {
        border: 1px solid #fff;
        border-radius: 4px;
    }

    .icon-check {
        display: none;
    }

    .form-control:focus {
        box-shadow: 0 0 0 .2rem rgba(255 255 255 / 25%);
        border-color: black;
    }

    .form-control {
        height: 35px;
    }
</style>
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
                        <div class="wrapper-content text-danger">
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
        <div class="container-seat">
            <form action="{{ route('checkViOnline') }}" method="post">
                @csrf
                <input type="number" class="tongtien" style="display: none;" name="tongGia" value="{{ $tong }}">
                <input type="text" class="magiamgia" style="display: none;" name="magiamgia" value="">
                <div class="mb-3"></div>
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <div class="col-12">
                            <div class="table-responsive table-food">
                                <table>
                                    <thead>
                                        <tr>
                                            <th
                                                style="background-color: #edf2f9; color:#95aac9;font-size:12.5px;font-weight:600;">
                                                Tóm tắt đơn hàng</th>
                                            <th style="background-color: #edf2f9;"></th>
                                            <th style="background-color: #edf2f9;"></th>
                                        </tr>
                                        <tr>
                                            <th>Mô tả</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ghe as $key => $value)
                                            <tr>
                                                <td class="concession-name d-flex align-items-center">
                                                    <div class="d-flex">
                                                        <p>
                                                            @if ($key == 'thuong')
                                                                Thường
                                                            @elseif($key == 'vip')
                                                                Vip
                                                            @else
                                                                Đôi
                                                            @endif
                                                        </p> <span class="ps-1 pr-1">-</span>
                                                        <p class="d-flex">
                                                            @for ($i = 0; $i < count($value); $i++)
                                                                @if ($key == 'doi')
                                                                    <span class="dataghechon" id="{{ $value[$i]['id'] . '-' . $value[$i + 1]['id'] }}" data-type="{{ $value[$i]['the_loai'] }}">{{ $value[$i]->hang_ghe . $value[$i]->so_hieu_ghe . $value[$i + 1]->hang_ghe . $value[$i + 1]->so_hieu_ghe}}{{ isset($value[$i + 2]) ? "," : "" }}</span>
                                                                    @php $i++ @endphp
                                                                @else
                                                                   <span class="dataghechon" id="{{ $value[$i]['id'] }}" data-type="{{ $value[$i]['the_loai'] }}"> {{ $value[$i]->hang_ghe . $value[$i]->so_hieu_ghe }}{{ isset($value[$i + 1]) ? "," : "" }}</span>
                                                                @endif
                                                            @endfor
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class="concession-price text-center">
                                                    {{ count($value) }}
                                                </td>
                                                <td>
                                                    @if ($key == 'thuong')
                                                        {{ number_format($suatChieu->phim->gia * count($value), 0, ',', '.')}}
                                                    @elseif($key == 'vip')
                                                        {{ number_format($suatChieu->phim->gia * count($value) + 10000 * count($value), 0, ',', '.') }}
                                                    @else
                                                        {{ number_format(($suatChieu->phim->gia) * (count($value)) + ((count($value) / 2) * 15000), 0, ',', '.') }}
                                                    @endif
                                                    &nbsp;₫
                                                </td>
                                            </tr>
                                        @endforeach
                                        @foreach ($doAn as $item)
                                                                                <tr>
                                                                                    <td class="concession-name d-flex align-items-center">
                                                                                        <div class="d-flex">
                                                                                            <p>
                                                                                                {{ $item->ten_do_an }}
                                                                                            </p>
                                                                                        </div>
                                                                                    </td>
                                                                                    @php
                                                                                        $id = $item->id;
                                                                                        $locId = array_filter($dataSoluongDoAn, function ($value) use ($id) {
                                                                                            return $value['idFood'] == $id;
                                                                                        });
                                                                                        $soluong = reset($locId)['soluong']
                                                                                    @endphp
                                                                                    <td class="concession-price text-center">
                                                                                        {{
                                                $soluong
                                                                                        }}
                                                                                    </td>
                                                                                    <td>
                                                                                        {{ number_format($item->gia * $soluong, 0, ',', '.') }}
                                                                                        &nbsp;₫
                                                                                    </td>
                                                                                </tr>
                                        @endforeach
                                        <tr>
                                            <td class="concession-name d-flex align-items-center">Tổng</td>
                                            <td class="concession-price text-center"></td>
                                            <td class="d-flex"> <div class="tonggiave" >{{ number_format($tong, 0, ',', '.') }}</div> &nbsp;₫</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-12 mt-4">
                            <div class="table-responsive table-food">
                                <table>
                                    <thead>
                                        <tr>
                                            <th style="color:#95aac9;font-size:12.5px;font-weight:600;">Mã giảm giá
                                            </th>
                                            <th>Số lượng</th>
                                            <th>Giá trị giảm</th>
                                            <th>Hạn sử dụng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($magiamgia as $item)
                                        <tr>
                                            <td>{{ $item->ma_giam_gia }}</td>
                                            <td>{{ $item->so_luong }}</td>
                                            <td>{{ $item->gia_tri_giam }}%</td>
                                            <td>{{ date("d/m/Y",strtotime($item->ngay_bat_dau)).' - '. date("d/m/Y",strtotime($item->ngay_ket_thuc)) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="table-responsive table-food">
                                <table>
                                    <thead>
                                        <tr>
                                            <th style="color:#95aac9;font-size:12.5px;font-weight:600;">Thông tin cá
                                                nhân
                                            </th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <div class="ms-4 mr-4 mb-5">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Họ và tên</label>
                                        <input type="text" class="form-control" value="{{ Auth::user()->ho_ten }}"
                                            id="exampleInputEmail1" aria-describedby="emailHelp" disabled>

                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email</label>
                                        <input type="email" class="form-control" value="{{ Auth::user()->email }}"
                                            id="exampleInputEmail1" aria-describedby="emailHelp" disabled>

                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Số điện thoại</label>
                                        <input type="text" class="form-control" value="{{ Auth::user()->so_dien_thoai }}"
                                            id="exampleInputEmail1" disabled>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12 order-sm-last">
                        <div class="container-ticket-information">
                            <div class="table-responsive table-food">
                                <table class="mb-3">
                                    <thead>
                                        <tr>
                                            <th style="color:#95aac9;font-size:12.5px;font-weight:600;">Hình thức thanh
                                                toán
                                            </th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                    </tbody>
                                </table>
                                <div class="ms-4 mr-4 mb-3 thanhtoanquavi activeThanhToan" style="cursor: pointer;">
                                    <div class="d-flex mt-2 ms-3 mb-2 mr-2 align-items-center"
                                        style="font-family: 'Cerebri Sans', sans-serif;">
                                        <input type="radio" class="viOline" style="display: none;" name="viOline" value="momo" checked>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" class="mr-2 icon-check"
                                            height="20" style="color: #f05050;" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.75" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-circle-check-big">
                                            <path d="M21.801 10A10 10 0 1 1 17 3.335" />
                                            <path d="m9 11 3 3L22 4" />
                                        </svg>
                                        <img width="30px" src="https://cdn.moveek.com/bundles/ornweb/img/momo-icon.png"
                                            alt="">
                                        <p class="ms-3" style="font-size: 14px;font-weight:500;">Ví MoMo</p>
                                    </div>
                                </div>
                                <div class="ms-4 mr-4 mb-3 thanhtoanquavi" style="cursor: pointer;">
                                    <div class="d-flex mt-2 ms-3 mb-2 mr-2 align-items-center"
                                        style="font-family: 'Cerebri Sans', sans-serif;">
                                        <input type="radio" class="viOline" style="display: none;" name="viOline"  value="vnpay">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" class="mr-2 icon-check"
                                            height="20" style="color: #f05050;" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.75" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-circle-check-big">
                                            <path d="M21.801 10A10 10 0 1 1 17 3.335" />
                                            <path d="m9 11 3 3L22 4" />
                                        </svg>
                                        <img width="30px"
                                            src="https://vinadesign.vn/uploads/images/2023/05/vnpay-logo-vinadesign-25-12-57-55.jpg" alt="">
                                        <p class="ms-3" style="font-size: 14px;font-weight:500;">Ví VNPAY</p>
                                    </div>
                                </div>
                                <div class="ms-4 mr-4 mb-3 thanhtoanquavi" style="cursor: pointer;">
                                    <div class="d-flex mt-2 ms-3 mb-2 mr-2 align-items-center"
                                        style="font-family: 'Cerebri Sans', sans-serif;">
                                        <input type="radio" class="viOline" style="display: none;" name="viOline"  value="zalopay">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" class="mr-2 icon-check"
                                            height="20" style="color: #f05050;" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.75" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-circle-check-big">
                                            <path d="M21.801 10A10 10 0 1 1 17 3.335" />
                                            <path d="m9 11 3 3L22 4" />
                                        </svg>
                                        <img width="30px"
                                            src="https://cdn.haitrieu.com/wp-content/uploads/2022/10/Logo-ZaloPay-Square.png" alt="">
                                        <p class="ms-3" style="font-size: 14px;font-weight:500;">ZaloPay(Thẻ tín dụng)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container-ticket-information">
                            <div class="content-ticket-information d-flex justify-content-between" style="width:100%;">
                                <div>
                                    <p style="color:#95aac9;">Tổng đơn hàng</p>
                                    <strong style="font-size:19px;font-weight:500;"><span class="tonggiave" >{{ number_format($tong,0,',','.') }}</span>&nbsp;₫</strong
                                        style="font-size:19px;font-weight:500;">
                                </div>
                                <div style="width: 0.7px;height: 50px;background-color: #e3ebf6;"></div>
                                <div class="justify-content-end d-flex flex-column" style="text-align: end;">
                                    <p style="color:#95aac9;">Thời gian dữ ghế</p>
                                    <strong class="text-danger demthoigian" style="font-size:19px;font-weight:500;">05:00</strong>
                                </div>
                            </div>
                            <div class="mb-3 mt-2 ps-2 pr-2 d-flex">
                                <input type="text" class="form-control inputtextmagiamgia" value=""
                                    placeholder="Mã giảm giá">
                                <button  type="button" class="ms-2 btn-magiamgia action-next btn btn-dark d-flex justify-content-center"
                                    style="width:120px; height:35px; font-size:14px;align-items: center">Áp
                                    dụng</button>
                            </div>
                        </div>
                        <div class="container-total-oldel-ticket">
                            <div class="content-total-oldel-ticket">
                                <p>
                                    Vé đã mua không thể đổi hoặc hoàn tiền. <br>
                                    Mã vé sẽ được gửi
                                    <strong>01</strong>
                                    lần qua email đã đăng ký tài khoản. Vui lòng kiểm tra lại thông tin trước khi tiếp tục.
                                </p>
                            </div>
                        </div>
                        <div class="flow-actions sticky-footer-bars">
                            <div class="flow-actions sticky-footer-bars">
                                <div class="row">
                                    <div class="col-12"><button type="submit" class="action-next btn btn-lg btn-dark btn-block"><span
                                                data-v-0c8aac4d="" class="d-md-none">0&nbsp;₫ |</span>
                                            Thanh toán
                                        </button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
 const id = "{{ $idsuauChieu }}"
 const ngay = "{{ $date }}"
 const urlApiMaGiamGia = "{{ asset('/api/ma-giam-gia') }}"
 const tongGia = "{{ $tong }}"
 const urlaApiGhe = "{{ asset('/api/ghe/suat-chieu/') }}" 
</script>
<!-- @vite('resources/js/reatimeGhe.js') -->
<script src="{{ asset('js/thanhtoan.js') }}"></script>
@endsection