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

            <!-- Payment and Total Section -->
            <div class="col-md-6 mb-4">
                <h5>Phương thức thanh toán</h5>
                <form>
                    <div class="d-flex justify-content-start align-items-center gap-3 mb-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="cod" checked />
                            <label class="form-check-label" for="cod">Thanh toán khi nhận hàng</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="credit-card" />
                            <label class="form-check-label" for="credit-card">Thẻ tín dụng</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="online-payment" />
                            <label class="form-check-label" for="online-payment">Thanh toán online</label>
                        </div>
                    </div>

                    <!-- Discount Code -->
                    <div class="mb-3">
                        <label for="discount-code" class="form-label">Mã giảm giá:</label>
                        <input type="text" class="form-control" id="discount-code" placeholder="Nhập mã giảm giá..." />
                    </div>

                    <h5 class="total-price">Tổng tiền</h5>
                    <p>Tổng sản phẩm: 2</p>
                    <p>Tổng tiền hàng: 15.000.000đ</p>
                    <p>Thành tiền sau khi áp mã giảm giá: 15.030.000đ</p>

                    <div class="text-center mt-5">
                        <a href="/" class="btn-custom56"> Mua vé </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
