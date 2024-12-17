@extends('admin.index')

@section('content')
<div class="page-inner">
    <div class="page-header">
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
                <a href="#">Thống kê tổng doanh theo thể loại</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="card-title">Thống kê tổng doanh theo thể loại</div>
            </div>
            <div class="form-group  mt-3">
                <form action="{{ route('thongke.theloai12') }}" method="GET" class="row g-3">
                    <div class="col-md-2">
                        <label for="bat_dau" class="form-label">Từ ngày</label>
                        <input type="date" name="bat_dau" id="bat_dau" class="form-control"
                            value="{{ $bd ? $bd->toDateString() : '' }}" onchange="this.form.submit()">
                    </div>
                    <div class="col-md-2">
                        <label for="ket_thuc" class="form-label">Đến ngày</label>
                        <input type="date" name="ket_thuc" id="ket_thuc" class="form-control"
                            value="{{ $kt ? $kt->toDateString() : '' }}" onchange="this.form.submit()">
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
                        </div>
                    </div>
                </form>
            </div>

            <div class="card-body">
                <ul class="nav nav-tabs mb-3" id="tabMenu" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link nav-link-loai active" id="table-tab" data-bs-toggle="tab"
                            data-bs-target="#tableContent" data-bs="tableContent" type="button" role="tab">
                            Bảng
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link nav-link-loai" data-bs="chartContent" id="chart-tab" data-bs-toggle="tab" data-bs-target="#chartContent"
                            type="button" role="tab">
                            Biểu đồ
                        </button>
                    </li>
                </ul>

              
                    <div class="tab-content" id="tabContent" style="display:block;" >
                        <div class="tab-pane fade show active" id="tableContent"  role="tabpanel">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Thể loại</th>
                                        <th>Tổng doanh thu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($theLoai as $index => $tl)
                                                                        @php
                                                                            $tongTien = 0;
                                                                            $tongTienDoAn = 0;
                                                                            $tienPhim = 0;
                                                                            foreach ($tl->phims as $phim) {
                                                                                // dd($phim->toArray());
                                                                                foreach ($phim->suatChieus as $suatChieu) {
                                                                                    $tongTien += $suatChieu->ves->sum('tong_tien');
                                                                                    $tongTienDoAn += $suatChieu->ves->sum('tong_tien_an');
                                                                                }
                                                                            }
                                                                            $tienPhim += $tongTien - $tongTienDoAn;

                                                                        @endphp

                                                                        <tr>
                                                                            <td>{{ $index + 1 }}</td>
                                                                            <td>{{ $tl->ten_the_loai }}</td>
                                                                            <td>{{ number_format($tienPhim) }} VND</td>
                                                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="chartContent" role="tabpanel" style="display:none;">
                        <canvas id="revenueChart"></canvas>
                    </div>
              
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let labels = @json(collect($tongDoanhThuTheoTheLoai)->pluck('ten_the_loai'));
    let data = @json(collect($tongDoanhThuTheoTheLoai)->pluck('doanh_thu'));
    
    $('.nav-link-loai').on('click',function(){
        let data = $(this).attr('data-bs')
        if(data == 'tableContent'){
           $('#tableContent').show()
           $('#chartContent').hide()
        }else if(data=='chartContent'){
            $('#chartContent').show()
            $('#tableContent').hide()
        }
    })

    const ctx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Tổng doanh thu (VND)',
                data: data,
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function (value) {
                            return value.toLocaleString() + ' VND';
                        }
                    }
                }
            }
        }
    });
</script>
@endsection