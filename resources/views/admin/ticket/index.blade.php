@extends('admin.index')

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
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('cannotcancelled'))
                    <div class="alert alert-success">
                        {{ session('cannotcancelled') }}
                    </div>
                @endif
                @if (session('vedahuy'))
                    <div class="alert alert-warning">
                        {{ session('vedahuy') }}
                    </div>
                @endif

                <div class="card-body">
                    <form class="d-flex row" action="{{ route('admin.ticket.index') }}" method="get">
                        <div class="col-md-4">
                            <label for="phim_id">Chọn lọc theo phim:</label>
                            <select name="phim" id="phim_id" class="form-control">
                                <option value="all">-- Tất cả phim --</option>
                                @foreach ($phims as $phim)
                                    <option value="{{ $phim->id }}" {{ request('phim_id') == $phim->id ? 'selected' : '' }}>
                                        {{ $phim->ten_phim }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="phong_chieu_id">Chọn lọc theo phòng chiếu:</label>
                            <select name="phong_chieu" id="phong_chieu_id" class="form-control">
                                <option value="all">-- Tất cả phòng chiếu liên quan --</option>
                            </select>
                        </div>
                        <div class="col-md-8 mt-1">
                            <label for="suat_chieu_id">Chọn lọc theo suất chiếu:</label>
                            <select name="suat_chieu" id="suat_chieu" class="form-control">
                                <option value="all">-- Tất cả suất chiếu --</option>
                            </select>
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-secondary">Lọc</button>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table id="" class="display table table-striped table-hover">
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
                                                                            <!-- <img width="40px" src="https://cdn.moveek.com/storage/media/cache/short/665dc87501b36651649752.jpg" alt=""> -->
                                                                            <div class="d-flex flex-column ms-3">
                                                                                <strong
                                                                                    style="font-size: 14.5px;">{{ $item->suatChieu->phim->ten_phim }}</strong>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td style="font-size: 13.5px;padding: 6px 10px !important;">{{ $item->user->ho_ten }}</td>
                                                                    <td style="padding: 6px 10px !important;">
                                                                        <p style="font-size: 13.5px;">{{ $item->ngay_ve_mo }} </p>
                                                                        <span
                                                                            style="font-size: 12.4px;">{{ $item->suatChieu->gio_bat_dau . "~" . $item->suatChieu->gio_ket_thuc }}</span>
                                                                    </td>
                                                                    <td style="padding: 6px 10px !important;">{{ $item->suatChieu->phongChieu->ten_phong_chieu }}</td>
                                                                    <td style="font-size: 13.5px;padding: 6px 10px !important;">
                                                                        {{ $item->maGiamGia == null ? 'Không dùng' : $item->maGiamGia->ten_ma_giam_gia }}
                                                                    </td>
                                                                    <td style="padding: 6px 10px !important;">
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
                                                                    <td style="padding: 6px 10px !important;">{{ $item->phuong_thuc_thanh_toan }}</td>
                                                                    <td style="padding: 6px 10px !important;">{{ number_format($item->tong_tien, 0, ',', '.') }}đ</td>
                                                                    <td style="padding: 6px 10px !important;"><a href="{{ route('admin.ticket.detail', $item->id) }}">Xem</a>
                                                                        @php
                                                                            $gioBatDau = \Carbon\Carbon::createFromFormat('H:i', $item->suatChieu->gio_bat_dau);
                                                                            $gioBatDauTru15Phut = $gioBatDau->subMinutes(10)->format('H:i');
                                                                        @endphp
                                                                        @if ($item->deleted_at !== null)
                                                                            /<a class="text-danger" href="">Vé đã huỷ</a>
                                                                        @else
                                                                            @if ($item->trang_thai == 1)
                                                                                @if ($curdate == $item->ngay_ve_mo)
                                                                                    @if($gioBatDauTru15Phut >= $currentTime)
                                                                                        /<a class="text-danger"
                                                                                            onclick="return confirm('Người dùng sẽ hoàn lại xu khi người dùng huỷ vẻ')"
                                                                                            href="{{ route('admin.huyvend', $item->id) }}">Huỷ vé</a>
                                                                                    @else
                                                                                        /<a class="text-warning" href="">Vé đã hết hạn</a>
                                                                                    @endif
                                                                                @elseif($curdate > $item->ngay_ve_mo)
                                                                                    /<a class="text-warning" href="">Vé đã hết hạn</a>
                                                                                @else
                                                                                    /<a class="text-danger"
                                                                                        onclick="return confirm('Người dùng sẽ hoàn lại xu khi người dùng huỷ vẻ')"
                                                                                        href="{{ route('admin.huyvend', $item->id) }}">Huỷ vé</a>
                                                                                @endif
                                                                            @else
                                                                            <p class="text-success" >Vé đã quét</p>
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
        $('#phim_id').on('change', function () {
            let idrap = $(this).val()
            $('#phong_chieu_id').html('<option value="all">-- Tất cả phòng chiếu liên quan --</option>')
            $('#suat_chieu').html('<option value="all">-- Tất cả suất chiếu --</option>')
            // console.log($(this).val());
            $.ajax({
                url: `{{ asset('admin/phim/phong-chieu') }}/${idrap}`,
                method: 'get',
                success: function (data) {
                    let html = ""
                    if (data.status == 200) {
                        $.each(data.data, function (_, value) {
                            html +=
                                `<option value="${value.id}">${value.ten_phong_chieu} - ${value.rap.ten_rap}</option>`
                        })
                        $('#phong_chieu_id').append(html)
                    }

                }
            })
        })
        $('#phong_chieu_id').on('change', function () {
            let idPhongChieu = $(this).val();
            let idPhim = $('#phim_id').val();
            $('#suat_chieu').html('<option value="all">-- Tất cả suất chiếu --</option>')
            $.ajax({
                url: `{{ asset('admin/suat-chieu/phim') }}/${idPhim}/phong-chieu/${idPhongChieu}`,
                method: 'get',
                success: function (data) {
                    //  console.log(data);   
                    let html = ""
                    if (data.status == 200) {
                        $.each(data.data, function (_, value) {
                            html += `<option value="${value.id}">
                            ${value?.phim.ten_phim}&nbsp - &nbsp${value?.phong_chieu.rap.ten_rap}&nbsp - &nbsp${value.gio_bat_dau + '~' + value.gio_ket_thuc}(${value.ngay})
                            </option>`
                        })
                        $('#suat_chieu').append(html)
                    }
                }
            })
            // console.log($(this).val(),$('#phim_id').val());

        })
    });
</script>
@endsection