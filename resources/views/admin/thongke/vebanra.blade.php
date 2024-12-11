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
                    <a href="#">Thống kê vé bán ra theo phim</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title">Thống kê vé bán ra theo phim</div>
                </div>

                <div class="card-body">
                    <div class="container py-3">
                        <form action="{{ route('thongke.vesbanra') }}" method="GET" class="row g-3">
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
                                    <option value="" {{ request('loc' == '' ? 'selected' : '') }}>Chọn quý</option>
                                    <option value="1" {{ request('loc' == '1' ? 'selected' : '') }}> Quý 1</option>
                                    <option value="2" {{ request('loc' == '2' ? 'selected' : '') }}> Quý 2</option>
                                    <option value="3" {{ request('loc' == '3' ? 'selected' : '') }}> Quý 3</option>
                                    <option value="4" {{ request('loc' == '4' ? 'selected' : '') }}> Quý 4</option>
                                </select>
                            </div>
                            <div class="col-md-5 d-flex align-items-end">
                                <div class="btn-group w-100" role="group">
                                    <button type="submit" name="loc" value="nam" class="btn btn-info me-2">Lọc theo
                                        năm</button>
                                    <button type="submit" name="loc" value="quý" class="btn btn-info me-2">Lọc theo
                                        quý</button>
                                    <button type="submit" name="loc" value="thang" class="btn btn-info me-2">Lọc theo
                                        tháng</button>
                                    {{-- <button type="submit" class="btn btn-primary">Lọc</button> --}}
                                </div>
                            </div>
                        </form>
                    </div>

                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên Phim</th>
                                <th>Số Ghế (Vé)</th>
                                <th>Tiền Đồ Ăn</th>
                                <th>Tổng Tiền (Vé)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $tongDoanhThu = 0;
                            @endphp
                            @foreach ($phimVes as $index => $pv)
                                @php
                                    $tongTien = 0;
                                    $soLuongGhe = 0;
                                    $tongTienDoAn = 0;

                                    foreach ($pv->suatChieus as $sc) {
                                        // $tongSoVe += $sc->ves->count();
                                        $tongTien += $sc->ves->sum('tong_tien');
                                        $tongTienDoAn += $sc->ves->sum('tong_tien_an');
                                        foreach ($sc->ves as $ve) {
                                            $soLuongGhe += $ve->detailTicket->sum('so_luong_ghe_ngoi');
                                        }
                                    }

                                    $tongDoanhThu += $tongTien + $tongTienDoAn;

                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $pv->ten_phim }}</td>
                                    <td>{{ $soLuongGhe }}</td>
                                    <td>{{ number_format($tongTienDoAn) }}đ</td>
                                    <td>{{ number_format($tongTien) }}đ</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4">Tổng Doanh Thu</th>
                                <th>{{ number_format($tongDoanhThu) }}đ</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
