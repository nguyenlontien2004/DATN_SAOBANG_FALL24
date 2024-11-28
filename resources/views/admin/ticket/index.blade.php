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
                    <a href="#">Danh sách vé</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4 class="card-title">Danh sách vé</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Phim</th>
                                        <th>Người đặt</th>
                                        <th>Phòng chiếu</th>
                                        <th>Mã giảm giá</th>
                                        <th>Hàng ghế</th>
                                        <th>Trạng thái vé</th>
                                        <th>Tổng vé</th>
                                        <th>Chí tiết vé</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($litsTicket as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex">
                                                    <!-- <img width="40px" src="https://cdn.moveek.com/storage/media/cache/short/665dc87501b36651649752.jpg" alt=""> -->
                                                    <div class="d-flex flex-column ms-3">
                                                        <strong
                                                            style="font-size: 14.5px;">{{ $item->showtime->movie->ten_phim }}</strong>
                                                        <p style="font-size: 12.5px;">2024 ·
                                                            {{ $item->showtime->movie->thoi_luong }} phút</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $item->user->ho_ten }}</td>
                                            <td>{{ $item->showtime->screeningRoom->ten_phong_chieu }}</td>
                                            <td>{{ $item->discountCode == null ? 'Không áp dụng' : $item->discountCode->ten_ma_giam_gia }}
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <span class="d-flex">Ghế: <strong>
                                                            @foreach ($item->detailTicket as $seat)
                                                                {{ $seat->seat->hang_ghe . $seat->seat->so_hieu_ghe }}
                                                            @endforeach
                                                        </strong></span>
                                                    <span>Loại: <strong>
                                                            @if ($item->detailTicket[0]->seat->the_loai == 'thuong')
                                                                Thường
                                                            @elseif($item->detailTicket[0]->seat->the_loai == 'vip')
                                                                Vip
                                                            @else
                                                                Đôi
                                                            @endif
                                                        </strong></span>
                                                </div>
                                            </td>
                                            <td>Cần bàn bạc</td>
                                            <td>{{ number_format($item->tong_tien, 0, ',', '.') }}đ</td>
                                            <td><a href="{{ route('admin.ticket.detail', $item->id) }}">Xem</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#basic-datatables").DataTable({
                responsive: true,
            });
        });
    </script>
@endsection
