@extends('admin.index')

@section('content')

    <div class="page-inner">
        <div class="page-header">
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('admin.ticket.index') }}">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Chi tiết vé</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div>
                <div>
                    <p class="mb-1">Người sở hữu: <strong>{{ $dataTicket->user->ho_ten }}</strong></p>
                    <div class="d-flex align-items-center">
                        <p class="mb-1">Email: <strong>{{ $dataTicket->user->email }}</strong></p>
                        <span class="mx-2">/</span>
                        <p class="mb-1">Số điện thoại:
                            <strong>{{ $dataTicket->user->so_dien_thoai }}</strong>
                        </p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="d-flex my-3 col-5">
                        <img width="200px" style="filter: drop-shadow(2px 4px 6px black);"
                            src="https://cdn.moveek.com/storage/media/cache/short/665dc87501b36651649752.jpg"
                            alt="">
                        <div class="ms-4">
                            <h3 class="mb-2">{{ $dataTicket->showtime->movie->ten_phim }}</h3>
                            <p class="mb-2">Phòng chiếu:
                                <strong>{{ $dataTicket->showtime->screeningRoom->ten_phong_chieu }}</strong>
                            </p>
                            <p class="mb-2">Rạp:
                                <strong>{{ $dataTicket->showtime->screeningRoom->cinema->ten_rap }}</strong>
                            </p>
                            <p class="mb-2">Ghế:
                                <strong>
                                    @foreach ($dataTicket->detailTicket as $seat)
                                        {{ $seat->seat->hang_ghe . $seat->seat->so_hieu_ghe }}
                                    @endforeach
                                </strong>
                                - Loại:
                                <strong>
                                    {{-- @if ($dataTicket->detailTicket[0]->seat->the_loai == 'thuong')
                                        Thường
                                    @elseif($dataTicket->detailTicket[0]->seat->the_loai == 'vip')
                                        Vip
                                    @else
                                        Đôi
                                    @endif --}}
                                </strong>
                            </p>
                            <p class="mb-2">Đồ ăn:
                                @if (count($food) > 0)
                                    {{ implode(
                                        ', ',
                                        array_map(function ($item) {
                                            return $item['food']['ten_do_an'] . ' x ' . $item['so_luong_do_an'];
                                        }, $food->toArray()),
                                    ) }}
                                @else
                                    Không mua
                                @endif
                            </p>
                            <p class="mb-1">Mã giảm giá:
                                {{ $dataTicket->discountCode == null ? 'Không áp dụng' : $dataTicket->discountCode->ten_ma_giam_gia }}
                            </p>
                            <p class="mb-1">Phương thức thanh toán:Online</p>
                            <h4>Tổng đơn hàng: {{ number_format($dataTicket->tong_tien, 0, ',', '.') }}đ</h4>
                        </div>
                    </div>
                    @if (count($food) > 0)
                        <div class="flex-1 col-7 mt-3">
                            <h3>Đồ ăn</h3>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Đồ ăn</th>
                                        <th scope="col">Giá</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Tổng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($food as $item)
                                        <tr>
                                            <td style="width:38%;">
                                                <div class="d-flex">
                                                    <img width="55px"
                                                        src="https://iguov8nhvyobj.vcdn.cloud/media/concession/web/6644731d5a8f5_1715761949.png"
                                                        alt="">
                                                    <div class="ms-1" style="width:65%;">
                                                        {{ $item->food->ten_do_an }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ number_format((int) $item->food->gia, 0, ',', '.') }}đ</td>
                                            <td>{{ $item->so_luong_do_an }}</td>
                                            <td>{{ number_format((int) $item->food->gia * (int) $item->so_luong_do_an, 0, ',', '.') }}đ
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
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
