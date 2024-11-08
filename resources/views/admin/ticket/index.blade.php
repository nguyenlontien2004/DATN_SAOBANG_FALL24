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
                        <span class="px-2">/</span>
                        <a href="{{ route('admin.ticket.create') }}">Tạo vé giả lập</a>
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
                                        <th>Thanh toán</th>
                                        <th>Tổng vé</th>
                                        <th>Chí tiết</th>
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
                                                            style="font-size: 14.5px;">{{ $item->suatChieu->phim->ten_phim }}</strong>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $item->user->ho_ten }}</td>
                                            <td>{{ $item->suatChieu->phongChieu->ten_phong_chieu }}</td>
                                            <td>{{ $item->maGiamGia == null ? 'Không áp dụng' : $item->maGiamGia->ten_ma_giam_gia }}
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <span class="d-flex">Ghế: <strong>
                                                            @foreach ($item->chiTietVe as $seat)
                                                                {{ $seat->seat->hang_ghe . $seat->seat->so_hieu_ghe }}
                                                            @endforeach
                                                        </strong></span>
                                                    <span><strong>
                                                            @if ($item->chiTietVe[0]->seat->the_loai == 'thuong')
                                                                Thường
                                                            @elseif($item->chiTietVe[0]->seat->the_loai == 'vip')
                                                                Vip
                                                            @else
                                                                Đôi
                                                            @endif
                                                        </strong></span>
                                                </div>
                                            </td>
                                            <td>{{ $item->phuong_thuc_thanh_toan }}</td>
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
