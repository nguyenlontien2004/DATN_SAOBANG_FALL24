@extends('layout.user')

@section('content')
<div class="main-content" style="margin-top: -25px;">
    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="width: 250px;">
    <div class="modal-content">
      <div class="flex align-items-center flex-col">
      {!! $ve->qr_code !!}
      <button class="btn btn-warning mb-2" data-bs-dismiss="modal" aria-label="Close" >Close</button>
      </div>
    </div>
  </div>
</div>
    <div>
        <div class="container-seat">
            <!-- Khối chứa QR code và thông tin vé -->
            <div class="qr-info-container mt-5 mb-5">
                <div class="flex pl-8">
                    <p data-type="vecuatoi" class="btnvedoan ms-2 underline pb-0" style="font-size: 18px; cursor: pointer;">Vé của tôi</p>
                    <p data-type="doan" class="btnvedoan ms-3 pb-0" style="font-size: 18px; cursor: pointer;">Đồ ăn</p>
                </div>
                <div class="vecuatoi" style="display:block;" >
                <div class="ttv flex mt-3" >
                    <!-- Dấu gạch ngăn cách theo chiều dọc -->
                    <div class="flex col-7 flex-col">
                        <div class="pl-7 flex">
                            <div class="flex-shrink-0">
                                <img class="rounded-lg" src="{{ asset('storage/' . $ve->suatChieu->phim->anh_phim) }}"
                                    alt="Poster Phim" width="150" />
                            </div>
                            <div class="ml-4">
                                <div class="dong mb-2">
                                    <p class="text-lg font-bold flex-grow">Phim: {{ $ve->suatChieu->phim->ten_phim }}
                                    </p>
                                </div>
                                @if ($ve->deleted_at !== null)
                                <p class="text-danger">Vé đã được huỷ</p>
                                @elseif($ve->trang_thai == 1)
                                <p class="text-warning">Chưa quét</p>
                                @elseif($ve->trang_thai == 0)
                                <p class="text-danger">Đã quét</p>
                                @endif
                                <p class="mt-2">Mã vé: <strong>{{ $ve->ma_code_ve }}</strong></p>
                                <p class="mt-2">Thời lượng: <strong>{{ $ve->suatChieu->phim->thoi_luong . 'p'}}</strong>
                                </p>
                                <p class="mt-2">Rạp: <strong>{{ $ve->suatChieu->phongChieu->rap->ten_rap }}</strong></p>
                                <p class="mt-1">Phòng chiếu:
                                    <strong>{{ $ve->suatChieu->phongChieu->ten_phong_chieu }}</strong>
                                </p>
                                <div class="mt-1">
                                    <p class="mt-1">Mã giảm giá:
                                        <strong>{{ $ve->maGiamGia == null ? 'Không áp dụng' : $ve->maGiamGia->ten_ma_giam_gia . '-' . $ve->maGiamGia->gia_tri_giam . '%' }}</strong>
                                    </p>
                                </div>

                            </div>

                        </div>
                        <div class="pl-7">
                            <div class="flex" style="align-items: baseline;">
                                <p class="mt-2 mr-2 flex align-items-center">
                                    <svg class="mr-1" xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-calendar-days">
                                        <path d="M8 2v4" />
                                        <path d="M16 2v4" />
                                        <rect width="18" height="18" x="3" y="4" rx="2" />
                                        <path d="M3 10h18" />
                                        <path d="M8 14h.01" />
                                        <path d="M12 14h.01" />
                                        <path d="M16 14h.01" />
                                        <path d="M8 18h.01" />
                                        <path d="M12 18h.01" />
                                        <path d="M16 18h.01" />
                                    </svg>
                                    {{ $ve->suatChieu->gio_bat_dau . "~" . $ve->suatChieu->gio_ket_thuc }} <br>
                                    {{ $ve->ngay_ve_mo }}
                                </p>
                                <p class="d-flex ms-2">
                                    <svg class="mr-1" xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-armchair">
                                        <path d="M19 9V6a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v3" />
                                        <path
                                            d="M3 16a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-5a2 2 0 0 0-4 0v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V11a2 2 0 0 0-4 0z" />
                                        <path d="M5 18v2" />
                                        <path d="M19 18v2" />
                                    </svg>
                                    @foreach ($ghe as $key => $value)
                                        <strong>
                                            @for ($i = 0; $i < count($value); $i++) @if ($key == 'doi')
                                                {{ $value[$i]->hang_ghe . $value[$i]->so_hieu_ghe . $value[$i + 1]->hang_ghe . $value[$i + 1]->so_hieu_ghe}}{{ isset($value[$i + 2]) ? "," : "" }}
                                            @php            $i++ @endphp @else
                                                {{ $value[$i]->hang_ghe . $value[$i]->so_hieu_ghe }}{{ isset($value[$i + 1]) ? "," : "" }}
                                            @endif
                                            @endfor
                                        </strong>
                                    @endforeach
                                </p>
                            </div>
                            <p class="mt-1" style="font-size:18px;font-weight:500;">Tổng đơn hàng:
                                {{ number_format($ve->tong_tien, 0, ',', '.') }}đ
                            </p>
                        </div>

                    </div>
                    <div class="col-5 text-center">
                        <!-- qr-code p-8  -->
                        <div class="" data-bs-toggle="modal" data-bs-target="#exampleModal" style="cursor: pointer;">
                            <div>
                                {!! $ve->qr_code !!}
                               
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="doan ttv pl-7 pr-8 mt-4" style="display:none;">
                    <table class="table pl-7 pr-8">
                        <thead>
                            <tr>
                                <th>Đồ ăn</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Tổng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($food as $item)
                            <tr>
                                <td>
                                    <div class="flex align-items-center">
                                        <img width="75px" src="{{ asset('storage/'.$item->food->hinh_anh) }}" alt="">
                                        <p>{{ $item->food->ten_do_an }}</p>
                                    </div>
                                </td>
                                <td>{{ number_format( $item->food->gia ,0,',','.')}}đ</td>
                                <td>{{ $item->so_luong_do_an }}</td>
                                <td>{{ number_format(($item->food->gia*$item->so_luong_do_an),0,',','.') }}đ</td>
                            </tr>
                            @endforeach
                       
                        </tbody>
                    </table>
                </div>
                <!-- Nút quay lại trang chủ -->
                <div class="text-end m-3">
                    <a href="{{ asset('/') }}" class="btn-custom"> Quay lại trang chủ </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // localStorage.removeItem('timeve');
    // localStorage.removeItem('idsuatchieu');
    $('.btnvedoan').on('click', function () {
        let data = $(this).attr('data-type')
        $.each($('.btnvedoan'), function () {
            $(this).removeClass('underline')
        })
        if(data=='vecuatoi'){
            $('.vecuatoi').show()
            $('.doan').hide()
        }else{
            $('.vecuatoi').hide()
            $('.doan').show()
        }
        $(this).addClass('underline')
    })
</script>
@endsection