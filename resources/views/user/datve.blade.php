@extends('layout.user')
@section('title')
    {{ $title }}
@endsection
<style>
    #showtimes {
        margin-top: 15px;
        padding: 10px;
        border: 1px solid #ddd;
        background-color: #f9f9f9;
    }

    #showtimes ul {
        list-style-type: none;  /* Xóa dấu chấm */
        padding-left: 0;
    }

    #showtimes ul li {
        padding: 5px;
        background-color: #e9ecef;
        margin-bottom: 5px;
        border-radius: 5px;
    }
</style>
@section('content')
    <!-- Header -->

    <head>
        <!-- Thêm Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>
    <header class="text-black text-center py-4">
        <h1>Đặt vé xem phim</h1>
    </header>

    <!-- Movie Selection Section -->
    <section class="movie-selection container my-5">
        <h2 class="text-center mb-4">Chọn phim của bạn</h2>
        <div class="row g-4">
            <!-- Sample movie card -->
            <div class="col-md-3">
                <div class="card">
                    <img src="movie-image.jpg" class="card-img-top" alt="trailler phim">
                    <div class="card-body text-center">
                        <h5 class="card-title">Tên phim</h5>
                        <button class="btn btn-primary select-movie-btn">Chọn phim</button>
                    </div>
                </div>
            </div>
            <!-- Repeat similar cards for more movies -->
        </div>
    </section>

    <!-- Seat Selection Section -->
    <!-- Seat Selection Section -->
    <section class="seat-selection container my-5">
        <h2 class="text-center mb-4">Choose Your Seat</h2>

        <!-- Row A (Green) -->
        <div class="d-flex justify-content-center mb-3">
            <div class="seat available" data-seat="A1">A1</div>
            <div class="seat available" data-seat="A2">A2</div>
            <div class="seat available" data-seat="A3">A3</div>
            <div class="seat available" data-seat="A4">A4</div>
            <div class="seat available" data-seat="A5">A5</div>
            <div class="seat available" data-seat="A6">A6</div>
            <div class="seat available" data-seat="A7">A7</div>
            <div class="seat available" data-seat="A8">A8</div>
            <div class="seat available" data-seat="A9">A9</div>
            <div class="seat available" data-seat="A10">A10</div>
            <div class="seat available" data-seat="A11">A11</div>
            <div class="seat available" data-seat="A12">A12</div>
            <div class="seat available" data-seat="A13">A13</div>
        </div>
        <div class="d-flex justify-content-center mb-3">
            <div class="seat available" data-seat="B1">B1</div>
            <div class="seat available" data-seat="B2">B2</div>
            <div class="seat available" data-seat="B3">B3</div>
            <div class="seat available" data-seat="B4">B4</div>
            <div class="seat available" data-seat="B5">B5</div>
            <div class="seat available" data-seat="B6">B6</div>
            <div class="seat available" data-seat="B7">B7</div>
            <div class="seat available" data-seat="B8">B8</div>
            <div class="seat available" data-seat="B9">B9</div>
            <div class="seat available" data-seat="B10">B10</div>
            <div class="seat available" data-seat="B11">B11</div>
            <div class="seat available" data-seat="B12">B12</div>
            <div class="seat available" data-seat="B13">B13</div>

        </div>
        <div class="d-flex justify-content-center mb-3">
            <div class="seat available" data-seat="C1">C1</div>
            <div class="seat available" data-seat="C2">C2</div>
            <div class="seat available" data-seat="C3">C3</div>
            <div class="seat available" data-seat="C4">C4</div>
            <div class="seat available" data-seat="C5">C5</div>
            <div class="seat available" data-seat="C6">C6</div>
            <div class="seat available" data-seat="C7">C7</div>
            <div class="seat available" data-seat="C8">C8</div>
            <div class="seat available" data-seat="C9">C9</div>
            <div class="seat available" data-seat="C10">C10</div>
            <div class="seat available" data-seat="C11">C11</div>
            <div class="seat available" data-seat="C12">C12</div>
            <div class="seat available" data-seat="C13">C13</div>
        </div>


        <!-- Row B (Red) -->
        <div class="d-flex justify-content-center mb-3">
            <div class="seat vip" data-seat="D2">D2</div>
            <div class="seat vip" data-seat="D1">D1</div>
            <div class="seat vip" data-seat="D3">D3</div>
            <div class="seat vip" data-seat="D4">D4</div>
            <div class="seat vip" data-seat="D5">D5</div>
            <div class="seat vip" data-seat="D6">D6</div>
            <div class="seat vip" data-seat="D7">D7</div>
            <div class="seat vip" data-seat="D8">D8</div>
            <div class="seat vip" data-seat="D9">D9</div>
            <div class="seat vip" data-seat="D10">D10</div>
            <div class="seat vip" data-seat="D11">D11</div>
            <div class="seat vip" data-seat="D12">D12</div>
            <div class="seat vip" data-seat="D13">D13</div>
        </div>
        <div class="d-flex justify-content-center mb-3">
            <div class="seat love" data-seat="L1">L1</div>
            <div class="seat love" data-seat="L3">L3</div>
            <div class="seat love" data-seat="L2">L2</div>
            <div class="seat love" data-seat="L4">L4</div>
        </div>

        <!-- Legend -->
        <div class="d-flex justify-content-center mt-4">
            <div class="legend me-3">
                <div class="seat available-note"></div> Ghế thường
            </div>
            <div class="legend me-3">
                <div class="seat vip-note"></div> Ghế V.I.P
            </div>
            <div class="legend">
                <div class="seat love-note"></div> Ghế đôi
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="border p-3">
                    <!-- Tiêu đề và chọn thành phố -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3>Lịch chiếu: <strong>Chi tiết phim</strong></h3>
                        <div>
                            <label for="city-select" class="form-label me-2">Chọn thành phố:</label>
                            <select class="form-select" id="city-select" style="width: auto">
                                <option selected>Hà Nội</option>
                                <option value="Hồ Chí Minh">Hồ Chí Minh</option>
                                <option value="Đà Nẵng">Đà Nẵng</option>
                                <option value="Hải Phòng">Hải Phòng</option>
                                <option value="Cần Thơ">Cần Thơ</option>
                            </select>
                        </div>
                    </div>

                    <!-- Nội dung lịch chiếu -->
                    <div class="border p-3 mb-3">
                        <div class="d-flex justify-content-around mb-2">
                            <div><button class="btn btn-outline-info">20/9</button></div>
                            <div><button class="btn btn-outline-info">21/9</button></div>
                            <div><button class="btn btn-outline-info">22/9</button></div>
                            <div><button class="btn btn-outline-info">23/9</button></div>
                            <div><button class="btn btn-outline-info">24/9</button></div>
                            <div><button class="btn btn-outline-info">25/9</button></div>
                            <div><button class="btn btn-outline-info">26/9</button></div>
                            <div><button class="btn btn-outline-info">27/9</button></div>
                            <div><button class="btn btn-outline-info">28/9</button></div>
                            <div><button class="btn btn-outline-info">29/9</button></div>
                        </div>

                        <div class="border p-2" id="showtimesToggle" style="cursor: pointer;">
                            <p><strong>CGV:</strong> Beta Đan Phượng</p>
                            <p>Tầng 2, Tòa nhà HHA, Khu đô thị XPHomes...</p>
                        </div>

                        <!-- Lịch chiếu sẽ hiển thị khi bấm vào trên -->
                        <div id="showtimes" style="display: none;">
                            <h4>Lịch chiếu phim:</h4>
                            <ul class="list-unstyled">
                                <li>08:00 AM - 10:00 AM</li>
                                <li>10:30 AM - 12:30 PM</li>
                                <li>01:00 PM - 03:00 PM</li>
                                <li>03:30 PM - 05:30 PM</li>
                                <li>06:00 PM - 08:00 PM</li>
                                <li>08:30 PM - 10:30 PM</li>
                                <li>11:00 PM - 01:00 AM</li>
                                <li>01:30 AM - 03:30 AM</li>
                                <li>04:00 AM - 06:00 AM</li>
                                <li>06:30 AM - 08:30 AM</li>
                            </ul>
                        </div>

                        <div class="border p-2" id="showtimesToggle" style="cursor: pointer;">
                            <p><strong>KĐA:</strong> Beta Đan Phượng</p>
                            <p>Tầng 2, Tòa nhà HHA, Khu đô thị XPHomes...</p>
                        </div>
                        
                        <!-- Lịch chiếu sẽ hiển thị khi bấm vào trên -->
                        <div id="showtimes" style="display: none;">
                            <h4>Lịch chiếu phim:</h4>
                            <ul class="list-unstyled">
                                <li>08:00 AM - 10:00 AM</li>
                                <li>10:30 AM - 12:30 PM</li>
                                <li>01:00 PM - 03:00 PM</li>
                                <li>03:30 PM - 05:30 PM</li>
                                <li>06:00 PM - 08:00 PM</li>
                                <li>08:30 PM - 10:30 PM</li>
                                <li>11:00 PM - 01:00 AM</li>
                                <li>01:30 AM - 03:30 AM</li>
                                <li>04:00 AM - 06:00 AM</li>
                                <li>06:30 AM - 08:30 AM</li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Booking Summary Section -->
    <section class="booking-summary container my-5">
        <div class="summary-details text-center">
            <p><strong>Phim:</strong> Tiêu đề phim đã chọn</p>
            <p><strong>Ghế ngồi:</strong> A1, A2</p>
            <p><strong>Tổng cộng:</strong> $20</p><br>
            <button class="btn btn-success">Xác nhận đặt vé</button>
        </div>
    </section>
@endsection
