@extends('nhanVien.index')

@section('content')
<style>
    #basic-datatables_length {
        display: none;
    }
</style>
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
                        <table id="basic-   " class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="padding: 6px 10px !important;">Phim</th>
                                    <th style="padding: 6px 10px !important;">Người đặt</th>
                                    <th style="padding: 6px 10px !important;">Suất chiếu</th>
                                    <th style="padding: 6px 10px !important;">Phòng chiếu</th>
                                    <th style="padding: 6px 10px !important;">Mã giảm giá</th>
                                    <th style="padding: 6px 10px !important;">Hàng ghế</th>
                                    <th style="padding: 6px 10px !important;">Thanh toán</th>
                                    <th style="padding: 6px 10px !important;">Tổng vé</th>
                                    <th style="padding: 6px 10px !important;">Chí tiết</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($litsTicket as $item)
                                                                <tr>
                                                                    <td style="padding: 6px 10px !important;">
                                                                        <div class="d-flex">
                                                                            <div class="d-flex flex-column ms-3">
                                                                                <strong
                                                                                    style="font-size: 14.5px;">{{ $item->suatChieu->phim->ten_phim }}</strong>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td style="font-size: 13.5px;padding: 6px 10px !important;">{{ $item->user->ho_ten }}</td>
                                                                    <td  style="padding: 6px 10px !important;">
                                                                        <p style="font-size: 13.5px;" class="pb-0 mb-0">{{ $item->ngay_ve_mo }} </p>
                                                                        <span
                                                                            style="font-size: 12.4px;">{{ $item->suatChieu->gio_bat_dau . "~" . $item->suatChieu->gio_ket_thuc }}</span>
                                                                    </td>
                                                                    <td  style="padding: 6px 10px !important;">{{ $item->suatChieu->phongChieu->ten_phong_chieu }}</td>
                                                                    <td style="font-size: 13.5px;padding: 6px 10px !important;">
                                                                        {{ $item->maGiamGia == null ? 'Không dùng' : $item->maGiamGia->ten_ma_giam_gia }}
                                                                    </td>
                                                                    <td  style="padding: 6px 10px !important;">
                                                                        <div class="d-flex flex-column" style="font-size: 13.5px;">
                                                                            <span class="d-flex text-left">Ghế: <strong>
                                                                                    @php
                                                                                        $ghe = $item->chiTietVe->pluck('seat')->groupBy('the_loai');
                                                                                    @endphp
                                                                                    @foreach ($ghe as $key => $value)
                                                                                        @for ($i = 0; $i < count($value); $i++)
                                                                                            @if ($key == 'doi')
                                                                                                <span class="dataghechon"
                                                                                                    id="{{ $value[$i]['id'] . '-' . $value[$i + 1]['id'] }}"
                                                                                                    data-type="{{ $value[$i]['the_loai'] }}">{{ $value[$i]->hang_ghe . $value[$i]->so_hieu_ghe . $value[$i + 1]->hang_ghe . $value[$i + 1]->so_hieu_ghe}}{{ isset($value[$i + 2]) ? "," : "" }}</span>
                                                                                                @php                $i++ @endphp
                                                                                            @else
                                                                                                <span class="dataghechon" id="{{ $value[$i]['id'] }}"
                                                                                                    data-type="{{ $value[$i]['the_loai'] }}">
                                                                                                    {{ $value[$i]->hang_ghe . $value[$i]->so_hieu_ghe }}{{ isset($value[$i + 1]) ? "," : "" }}</span>
                                                                                            @endif
                                                                                        @endfor
                                                                                    @endforeach
                                                                                </strong>
                                                                            </span>

                                                                        </div>
                                                                    </td>
                                                                    <td  style="padding: 6px 10px !important;">{{ $item->phuong_thuc_thanh_toan }}</td>
                                                                    <td  style="padding: 6px 10px !important;">{{ number_format($item->tong_tien, 0, ',', '.') }}đ</td>
                                                                    <td  style="padding: 6px 10px !important;" class="d-flex">
                                                                        @if ($item->deleted_at !== null)
                                                                         <p class="text-danger"  style="font-size: 13.5px;">Vé huỷ</p>
                                                                         @else
                                                                         @if ($item->trang_thai == 1)
                                                                        <p class="text-warning" style="font-size: 13.5px;">Chưa quét</p>
                                                                        @else
                                                                        <p class="text-success" style="font-size: 13.5px;">Đã quét</p>
                                                                        @endif
                                                                        @endif
                                                                       
                                                                    </td>
                                                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $litsTicket->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#basic-datatables").DataTable({
            responsive: true,
        });      
    });
</script>
@endsection