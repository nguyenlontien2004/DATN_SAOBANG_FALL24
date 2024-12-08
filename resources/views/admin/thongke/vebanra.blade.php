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
                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên Phim</th>
                                <th>Số Vé Bán Ra</th>
                                {{-- <th>Gía Vé</th> --}}
                                <th>Tổng Tiền (Vé)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $tongDoanhThu = 0;
                            @endphp
                            @foreach ($phimVes as $index => $pv)
                                @php
                                    $tongSoVe = 0;
                                    $tongTien = 0;

                                    foreach ($pv->suatChieus as $sc) {
                                        $tongSoVe += $sc->ves->count();
                                        $tongTien += $sc->ves->sum('tong_tien');
                                    }

                                    $tongDoanhThu += $tongTien;

                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $pv->ten_phim }}</td>
                                    <td>{{ $tongSoVe }}</td>
                                    {{-- <td>{{ $pv->gia_phim }}</td> --}}
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
