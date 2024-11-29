@extends('layout.user')

@section('content')
    <div class="thanhtoan">
        <h3 class="text-center mb-4">Thông tin đặt hàng</h3>
        <div class="row mb-5">
            <div class="col-12">
                <h5>Sản phẩm</h5>
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th>Thông tin phim</th>
                            <th>Đồ ăn</th>
                            <th>Suất chiếu</th>
                            <th>Ghế ngồi</th>
                            <th>Ghế ngồi</th>
                            <th>Ghế ngồi</th>
                            <th>Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="display: flex; align-items: center">
                                <img src="https://cinema.momocdn.net/img/56753599200787359-ng%C3%A0y-x%C6%B0a-c%C3%B3-m%E1%BB%8Dt-chuy%E1%BB%87n-t%C3%ACnh-b%C3%B9ng-con-m%E1%BA%B9-n%C3%B3-binh.jpg"
                                    alt="Product" width="100" />
                                <div class="ctphim" style="margin-left: 10px">
                                    <p>Phim mai</p>
                                </div>
                            </td>
                            <td></td>
                            <td>3</td>
                            <td>989.928</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Customer and Payment Section (Side by side) -->
        <div class="row">
            <!-- Customer Information -->
            <div class="col-md-6 mb-4">
                <h5>Thông tin khách hàng</h5>
                <form>
                    <div class="mb-3">
                        <label for="name" class="form-label">Người đặt hàng:</label>
                        <input type="text" class="form-control" id="name" placeholder="Họ và Tên..." />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" placeholder="Email..." />
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Số điện thoại:</label>
                        <input type="tel" class="form-control" id="phone" placeholder="Số điện thoại..." />
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Địa chỉ:</label>
                        <input type="text" class="form-control" id="address" placeholder="Địa chỉ..." />
                    </div>
                </form>
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

                    <!-- Discount Code -->
                    <div class="mb-3">
                        <label for="discount-code" class="form-label">Mã giảm giá:</label>
                        <input type="text" class="form-control" id="discount-code" placeholder="Nhập mã giảm giá..." />
                    </div>
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
                </form>
            </div>
        </div>
    </div>
@endsection
