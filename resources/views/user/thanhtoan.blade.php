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

                                    <tr>
                                        <td class="concession-name d-flex align-items-center">

                                            <div>
                                                sdfsfds <br>
                                                <span>
                                                    TIẾT KIỆM 46K!!! Gồm: 1 Bắp (69oz) + 2 Nước
                                                </span>
                                            </div>
                                        </td>
                                        <td class="concession-price text-right">
                                            2
                                        </td>
                                        <td>
                                            200.000&nbsp;₫
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <div class="table-responsive table-food">
                            <table class="mb-3">
                                <thead>
                                    <tr>
                                        <th style="color:#95aac9;font-size:12.5px;font-weight:600;">Hình thức thanh toán
                                        </th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>


                                </tbody>
                            </table>
                            <div class="ms-4 mr-4 mb-3 thanhtoanquavi" style="cursor: pointer;">
                                <div class="d-flex mt-2 ms-3 mb-2 mr-2 align-items-center"
                                    style="font-family: 'Cerebri Sans', sans-serif;">
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" class="mr-2 icon-check"
                                        height="20" style="color: #f05050;" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.75" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-circle-check-big">
                                        <path d="M21.801 10A10 10 0 1 1 17 3.335" />
                                        <path d="m9 11 3 3L22 4" />
                                    </svg>
                                    <img width="30px" src="https://cdn.moveek.com/bundles/ornweb/img/shopeepay-icon.png"
                                        alt="">
                                    <p class="ms-3" style="font-size: 14px;font-weight:500;">Ví ShopeePay</p>
                                </div>
                            </div>
                            <div class="ms-4 mr-4 mb-3 thanhtoanquavi" style="cursor: pointer;">
                                <div class="d-flex mt-2 ms-3 mb-2 mr-2 align-items-center"
                                    style="font-family: 'Cerebri Sans', sans-serif;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" class="mr-2 icon-check"
                                        height="20" style="color: #f05050;" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.75" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-circle-check-big">
                                        <path d="M21.801 10A10 10 0 1 1 17 3.335" />
                                        <path d="m9 11 3 3L22 4" />
                                    </svg>
                                    <img width="30px" src="https://cdn.moveek.com/bundles/ornweb/img/fptpay-icon.png"
                                        alt="">
                                    <p class="ms-3" style="font-size: 14px;font-weight:500;">Ví FPT Pay</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <div class="table-responsive table-food">
                            <table>
                                <thead>
                                    <tr>
                                        <th style="color:#95aac9;font-size:12.5px;font-weight:600;">Thông tin cá nhân
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
                                    <input type="text" class="form-control" value="Ngô Hoàng Phúc"
                                        id="exampleInputEmail1" aria-describedby="emailHelp">

                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email</label>
                                    <input type="email" class="form-control" value="ngophuc284@gmail.com"
                                        id="exampleInputEmail1" aria-describedby="emailHelp">

                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Số điện thoại</label>
                                    <input type="email" class="form-control" value="03777819123" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12 order-sm-last">
                    <div class="container-ticket-information">
                        <div class="content-ticket-information d-flex justify-content-between" style="width:100%;">
                            <div>
                                <p style="color:#95aac9;">Tổng đơn hàng</p>
                                <strong style="font-size:19px;font-weight:500;">200.000&nbsp;₫</strong
                                    style="font-size:19px;font-weight:500;">
                            </div>
                            <div style="width: 0.7px;height: 50px;background-color: #e3ebf6;"></div>
                            <div class="justify-content-end d-flex flex-column" style="text-align: end;">
                                <p style="color:#95aac9;">Thời gian dữ ghế</p>
                                <strong class="text-danger" style="font-size:19px;font-weight:500;">03:30</strong>
                            </div>
                        </div>
                    </div>
                    <div class="container-total-oldel-ticket">
                        <div class="content-total-oldel-ticket">
                            <p>
                                Vé đã mua không thể đổi hoặc hoàn tiền. <br>
                                Mã vé sẽ được gửi 
                                <strong>01</strong>
                                lần qua email đã nhập. Vui lòng kiểm tra lại thông tin trước khi tiếp tục.
                            </p>
                        </div>
                    </div>
                    <div class="flow-actions sticky-footer-bars">
                        <div class="flow-actions sticky-footer-bars">
                            <div class="row">
                                <div class="col-12"><a class="action-next btn btn-lg btn-dark btn-block"><span
                                            data-v-0c8aac4d="" class="d-md-none">0&nbsp;₫ |</span>
                                        Thanh toán
                                    </a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

</script>
<!-- @vite('resources/js/reatimeGhe.js') -->
<script src="{{ asset('js/reatimeGhe.js') }}"></script>
@endsection