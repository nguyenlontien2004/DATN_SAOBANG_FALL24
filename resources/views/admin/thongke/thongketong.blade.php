@extends('admin.index')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Tables</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="#">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Tables</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Thống kê tổng doanh thu theo rạp</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title">Thống kê tổng doanh thu theo rạp</div>
                </div>

                <div class="card-body">
                    <div class="form-control">
                        <form action="{{ route('thongke.vesbanra') }}" method="GET">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="bat_dau">Từ ngày</label>
                                    <input type="date" name="bat_dau" id="bat_dau" class="form-control"
                                        value="{{ request('bat_dau') }}">
                                </div>
                                <div class="col-md-3">
                                    <label for="ket_thuc">Đến ngày</label>
                                    <input type="date" name="ket_thuc" id="ket_thuc" class="form-control"
                                        value="{{ request('ket_thuc') }}">
                                </div>
                                <div class="col-md-2">
                                    <label for="ket_thuc">Đến ngày</label>
                                    <input type="date" name="ket_thuc" id="ket_thuc" class="form-control"
                                        value="{{ request('ket_thuc') }}">
                                </div>
                                <button type="submit">Lọc theo năm</button>
                                <button type="submit">Lọc theo quý</button>
                                <button type="submit">Lọc theo tháng</button>
                            </div>
                        </form>
                    </div>
                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên Phim</th>
                                <th>Số Ghế</th>
                                <th>Tiền Đồ Ăn</th>
                                <th>Tổng Tiền (Vé)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $tongDoanhThu = 0;
                            @endphp
                            @foreach ($chiNhanh as $index => $cn)
                                @php
                                    $tongTien = 0;
                                    $soLuongGhe = 0;
                                    $tongTienDoAn = 0;

                                    foreach ($cn->suatChieus as $sc) {
                                        // $tongSoVe += $sc->ves->count();
                                        $tongTien += $sc->ves->sum('tong_tien');
                                        $tongTienDoAn += $sc->ves->sum('tong_tien_an');
                                        foreach ($dc->ves as $ve) {
                                            $soLuongGhe += $ve->chiTietVes->sum('so_luong_ghe_ngoi');
                                        }
                                    }

                                    $tongDoanhThu += $tongTien + $tongTienDoAn;

                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $cn->ten_rap }}</td>
                                    <td>{{ $soLuongGhe }}</td>
                                    <td>{{ number_format($tongTienDoAn) }}đ</td>
                                    <td>{{ number_format($tongTien) }}đ</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3">Tổng Doanh Thu</th>
                                <th>{{ number_format($tongDoanhThu) }}đ</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
