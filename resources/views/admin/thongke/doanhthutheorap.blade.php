@extends('admin.index')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="#">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Doanh thu theo rạp</a>
                </li>
            </ul>
        </div>

        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h4 class="card-title">Doanh thu theo rạp</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Rạp chiếu</th>
                                <th>Địa điểm</th>
                                <th>Tổng doanh thu</th>
                                <th>Thống kê từng phòng của rạp</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($rapThongke as $item)
                           <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $item->ten_rap }}</td>
                            <td>{{ $item->dia_diem }}</td>
                            <td>{{ number_format($item->ves->sum('tong_tien'),0,',','.') }}đ</td>
                            <td><a href="{{ route('doanhthutheophong',$item->id) }}">Xem của rạp {{ $item->ten_rap }}</a></td>
                           </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#basic-datatables").DataTable({});
        });
    </script>
@endsection
