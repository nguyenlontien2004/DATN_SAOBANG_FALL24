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
                <div class="form-group  mt-3">
                    <form action="{{ route('thongke.rap') }}" method="GET" class="row g-3">
                        <div class="col-md-2">
                            <label for="bat_dau" class="form-label">Từ ngày</label>
                            <input type="date" name="bat_dau" id="bat_dau" class="form-control"
                                value="{{ $bd ? $bd->toDateString() : '' }}" onchange="this.form.submit()">
                        </div>
                        <div class="col-md-2">
                            <label for="ket_thuc" class="form-label">Đến ngày</label>
                            <input type="date" name="ket_thuc" id="ket_thuc" class="form-control"
                                value="{{ $kt ? $kt->toDateString() : '' }}"onchange="this.form.submit()">
                        </div>
                        <div class="col-md-3">
                            <label for="quy" class="form-label">Lọc theo quý</label>
                            <select class="form-control" name="loc" id="loc" onchange="this.form.submit()">
                                <option value="" {{ request('loc') == '' ? 'selected' : '' }}>Chọn quý</option>
                                <option value="1" {{ request('loc') == '1' ? 'selected' : '' }}> Quý 1</option>
                                <option value="2" {{ request('loc') == '2' ? 'selected' : '' }}> Quý 2</option>
                                <option value="3" {{ request('loc') == '3' ? 'selected' : '' }}> Quý 3</option>
                                <option value="4" {{ request('loc') == '4' ? 'selected' : '' }}> Quý 4</option>
                            </select>
                        </div>
                        <div class="col-md-5 d-flex align-items-end">
                            <div class="btn-group w-100" role="group">
                                <button type="submit" name="loc" value="nam" class="btn btn-info me-2">Lọc theo
                                    năm</button>
                                <button type="submit" name="loc" value="thang" class="btn btn-info me-2">Lọc theo
                                    tháng</button>
                                <button type="submit" name="loc" value="tuan" class="btn btn-info me-2">Lọc theo
                                    tuần</button>
                                {{-- <button type="submit" class="btn btn-primary">Lọc</button> --}}
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body">

                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên Rạp</th>
                                <th>Số Ghế (Vé)</th>
                                <th>Tổng Tiền (Vé)</th>
                                <th>Tiền Đồ Ăn</th>
                                <th>Tiền Phim (Rạp)</th>
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
                                    $tienPhim = 0;

                                    foreach ($cn->phongChieus as $p) {
                                        // $tongSoVe += $p->ves->count();
                                        // dd($p->toArray());
                                        foreach ($p->suatChieu as $schieu) {
                                            $tongTien += $schieu->ves->sum('tong_tien');
                                            $tongTienDoAn += $schieu->ves->sum('tong_tien_an');
                                            // $tienPhim += $schieu->suatChieu->sum('gia');
                                            foreach ($schieu->ves as $ve) {
                                                $soLuongGhe += $ve->detailTicket
                                                    ->pluck('detailTicket.ghe_ngoi_id')
                                                    ->count();
                                            }
                                        }
                                    }

                                    $tienPhim += $tongTien - $tongTienDoAn;

                                    $tongDoanhThu += $tongTien + $tongTienDoAn;

                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $cn->ten_rap }}</td>
                                    <td>{{ $soLuongGhe }}</td>
                                    <td>{{ number_format($tongTien) }}đ</td>
                                    <td>{{ number_format($tongTienDoAn) }}đ</td>
                                    <td>{{ number_format($tienPhim) }}đ</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="5">Tổng Doanh Thu</th>
                                <th>{{ number_format($tongDoanhThu) }}đ</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
