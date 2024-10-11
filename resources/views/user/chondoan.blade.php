@extends('layout.user')

@section('content')
    <div class="main-content">
        <div>
            <div class="ticketing-steps">
                <div class="container-ticket-steps">
                    <div class="row">
                        <div class="ticketing-step col">
                            <div class="wrapper-content">
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
                            <div class="wrapper-content text-danger">
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
            <div class="container-seat">
                <div class="mb-3"></div>
                <div class="row">
                    <div class="col-lg-8 col-12">
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
                                    <tr>
                                        <td class="concession-name">
                                            Sweet Combo 69oz <br />
                                            <span>
                                                TIẾT KIỆM 46K!!! Gồm: 1 Bắp (69oz) + 2 Nước có gaz
                                                (22oz)
                                            </span>
                                        </td>
                                        <td class="concession-price text-right">
                                            88.000&nbsp;₫
                                        </td>
                                        <td>
                                            <div class="quantity-toggle-food">
                                                <a class="minus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="0.75" stroke-linecap="round"
                                                        stroke-linejoin="round" class="lucide lucide-minus">
                                                        <path d="M5 12h14" />
                                                    </svg>
                                                </a>
                                                <input type="text" min="0" max="10" value="0"
                                                    style="width: 30px" />
                                                <a class="plus">
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
                                    <tr>
                                        <td class="concession-name">
                                            Sweet Combo 69oz <br />
                                            <span>TIẾT KIỆM 46K!!! Gồm: 1 Bắp (69oz) + 2 Nước có gaz
                                                (22oz)</span>
                                        </td>
                                        <td class="concession-price text-right">
                                            88.000&nbsp;₫
                                        </td>
                                        <td>
                                            <div class="quantity-toggle-food">
                                                <a class="minus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="0.75" stroke-linecap="round"
                                                        stroke-linejoin="round" class="lucide lucide-minus">
                                                        <path d="M5 12h14" />
                                                    </svg>
                                                </a>
                                                <input type="text" min="0" max="10" value="0"
                                                    style="width: 30px" />
                                                <a class="plus">
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12 order-sm-last">
                        <div class="container-ticket-information">
                            <div class="content-ticket-information">
                                <p>Joke 2:Điên có đôi</p>
                                <strong>Beta Đan Phượng</strong>
                                <p>Suất 09:00 04/10/2024</p>
                                <p>Phòng chiếu P1 - Ghế <span>...</span></p>
                            </div>
                        </div>
                        <div class="container-total-oldel-ticket">
                            <div class="content-total-oldel-ticket">
                                <p class="text-total">Tổng đơn hàng</p>
                                <span>0&nbsp;₫</span>
                            </div>
                        </div>
                        <div class="flow-actions sticky-footer-bars">
                            <div class="flow-actions sticky-footer-bars">
                                <div class="row">
                                    <div class="col-3">
                                        <a href="#"
                                            class="action-pre btn btn-lg btn-outline-dark btn-block disabled">
                                            ←
                                        </a>
                                    </div>
                                    <div class="col-9">
                                        <a href="#" class="action-next btn btn-lg btn-dark btn-block disabled"><span
                                                data-v-0c8aac4d="" class="d-md-none">0&nbsp;₫ |</span>
                                            Tiếp tục
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
