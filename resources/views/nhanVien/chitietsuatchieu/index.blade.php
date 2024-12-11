@extends('admin.index')

@section('content')
<style>
.select2-dropdown {
    z-index: 10000;
}

.takenSeat {
    z-index: 100;
}

.seat-group-parent {
    margin-bottom: 3px;
}

.empty {
    background-color: transparent;
}

.more-seat {
    padding-top: 10px;
}

.more-seat span {
    width: 25px;
    height: 25px;
    border-radius: 50%;
    border: 1px solid;
    cursor: pointer;
}

.icon-loading {
    position: absolute;
    width: 23px;
    height: 23px;
    border-radius: 50%;
    display: inline-block;
    border-top: 3px solid #FFF;
    border-right: 3px solid transparent;
    box-sizing: border-box;
    animation: rotation 1s linear infinite;
    top: 25%;
    left: 35%;
    transform: translate(-50%, -50%);
}

@keyframes rotation {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}

.loading {
    display: none;
    background-color: #515454;
    opacity: 0.55;
    top: 0;
    width: 100%;
    height: 100%;
    border-radius: 3px;
}
</style>
<div class="page-inner">
    <div class="page-header">
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="{{ route('admin.phongChieu') }}">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Chi tiết suất chiếu</a>
            </li>
        </ul>
    </div>

    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h4 class="card-title">Chi tiết suất chiếu</h4>
        </div>
        <div class="card-body">
            <form class="d-flex row" action="{{ route('admin.chitietsuatchieu') }}" method="get">
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
            <!-- sadaddas -->
            @if($suatchieu !== null)
            <div class="ms-3 mr-3 mt-4">
                @foreach ($suatchieu as $key => $value)
                <div>
                    <p class="mt-4">Suất chiếu ngày: {{ $key }}</p>
                    <div class="row">
                        @foreach ($value as $item)
                        <div class="col-md-6 mt-2">
                            <div class="seat-selection"
                                style="border-radius: 10px;box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;border: 1px solid #ebe5e5">
                                <p class="ps-2">
                                    {{ $item->phim->ten_phim }}&nbsp({{ $item->gio_bat_dau .'~'.$item->gio_ket_thuc }})
                                </p>
                                <p class="ps-2">
                                    Phòng:&nbsp{{ $item->phongChieu->ten_phong_chieu }}&nbsp-&nbsp Tại rạp:&nbsp{{ $item->phongChieu->rap->ten_rap }}
                                </p>
                                <div class="legend">
                                    <div>
                                        <span class="taken"></span>
                                        <p>Ghế đã bán</p>
                                    </div>
                                </div>
                                <div class="seats-wrapper-parent" style="padding: 0px 10px 10px 10px;">
                                    <div class="seats-wrapper-row">
                                        <div class="seats-row">
                                            <div class="row-wrapper">
                                                <div class="seat-row">A</div>
                                                <div class="seat-row">B</div>
                                                <div class="seat-row">C</div>
                                                <div class="seat-row">D</div>
                                                <div class="seat-row">E</div>
                                                <div class="seat-row">F</div>
                                                <div class="seat-row">G</div>
                                                <div class="seat-row">H</div>
                                                <div class="seat-row">I</div>
                                            </div>
                                        </div>
                                        <div class="seats-map">
                                            <div class="row-wrapper">
                                                @foreach ($item->phongChieu->grouped_ghe_ngoi as $key => $value)
                                                @if (count($value) <= 0) <ul class="seat-row">
                                                    <li class="empty"></li>
                                                    </ul>
                                                    @endif
                                                    <ul class="seat-row">
                                                        @for ($i = 0; $i < count($value); $i++) 
                                                        
                                                       
                                                        @if($value[$i]['isDoubleChair'] !==null && $i + 1 < count($value)) {{-- Ghế đôi --}} 
                                                            <div
                                                            id="{{ $value[$i]['id'] . '-' . $value[$i + 1]['id'] }}"
                                                            data-type="{{ $value[$i]['the_loai'] }}"
                                                            class="seat-group-parent doubSeat seats 
                                                            @php 
                                                             foreach($value[$i]['chitietve'] as $check){
                                                             if($check['ticket'] == null){
                                                                echo '';
                                                             }elseif($check['ticket']['suat_chieu_id'] == $item->id){
                                                                echo 'takenSeat';
                                                              
                                                             }

                                                             }
                                                            @endphp
                                                            ">
                                                            <li id="{{ $value[$i]['id'] }}"
                                                                data-hang="{{ $key . $value[$i]['so_hieu_ghe'] }}"
                                                                class="seat-group">
                                                                {{ $key . $value[$i]['so_hieu_ghe'] }}
                                                            </li>
                                                            <li id="{{ $value[$i + 1]['id'] }}"
                                                                data-hang="{{ $key . $value[$i + 1]['so_hieu_ghe'] }}"
                                                                class="seat-group">
                                                                {{ $key . $value[$i + 1]['so_hieu_ghe'] }}
                                                            </li>
                                            </div>
                                            {{-- --}}
                                            @php $i++ @endphp
                                            @else
                                            {{-- Ghế thường --}}
                                          
                                            <li id="{{ $value[$i]['id'] }}" data-type="{{ $value[$i]['the_loai'] }}"
                                                data-hang="{{ $key . $value[$i]['so_hieu_ghe'] }}"
                                                class="seats 
                                                     @php 
                                                             foreach($value[$i]['chitietve'] as $check){
                                                             if($check['ticket'] == null){
                                                             echo '';
                                                             }elseif($check['ticket']['suat_chieu_id'] == $item->id){
                                                                echo 'takenSeat';
                                                             }

                                                             }
                                                            @endphp
                                               
                                                {{ $value[$i]['the_loai'] == 'thuong' ? 'regularchair' : 'seatVip' }}">
                                                {{ $key . $value[$i]['so_hieu_ghe'] }}
                                            </li>
                                            @endif
                                            @endfor
                                            </ul>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>

</div>
</div>

<script>
//admin.suatchieutheophim
$(document).ready(function() {
    $("#basic-datatables").DataTable({});
    $('#phim_id').on('change', function() {
        let idrap = $(this).val()
        $('#phong_chieu_id').html('<option value="all">-- Tất cả phòng chiếu liên quan --</option>')
        $('#suat_chieu').html('<option value="all">-- Tất cả suất chiếu --</option>')
        // console.log($(this).val());
        $.ajax({
            url: `{{ asset('admin/phim/phong-chieu') }}/${idrap}`,
            method: 'get',
            success: function(data) {
                let html = ""
                if (data.status == 200) {
                    $.each(data.data, function(_, value) {
                        html +=
                            `<option value="${value.id}">${value.ten_phong_chieu}</option>`
                    })
                    $('#phong_chieu_id').append(html)
                }

            }
        })
    })
    $('#phong_chieu_id').on('change', function() {
        let idPhongChieu = $(this).val();
        let idPhim = $('#phim_id').val();
        $('#suat_chieu').html('<option value="all">-- Tất cả suất chiếu --</option>')
        $.ajax({
            url: `{{ asset('admin/suat-chieu/phim') }}/${idPhim}/phong-chieu/${idPhongChieu}`,
            method: 'get',
            success: function(data) {
                //  console.log(data);   
                let html = ""
                if (data.status == 200) {
                    $.each(data.data, function(_, value) {
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