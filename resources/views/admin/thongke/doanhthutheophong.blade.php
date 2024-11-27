@extends('admin.index')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('doanhthutheorap') }}">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Doanh thu theo phòng của rạp <span class="ps-1 pr-1" >-</span> {{ $phongChieu->ten_rap }}</a>
                </li>
            </ul>
        </div>

        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h4 class="card-title">Doanh thu theo phòng của rạp<span class="ps-1 pr-1" >-</span>{{ $phongChieu->ten_rap }}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Phòng chiếu</th>
                                <th>Tổng doanh thu</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($phongChieu->phongChieus as $item)
                           <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $item->ten_phong_chieu }}</td>
                            <td>{{ number_format($item->ves->sum('tong_tien'),0,',','.') }}đ</td>
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
