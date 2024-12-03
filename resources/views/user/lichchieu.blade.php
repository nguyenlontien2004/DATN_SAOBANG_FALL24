@extends('layout.user')
@section('content')
<style>
    .tix-bg {
        background-image: url('https://cdn.moveek.com/build/images/tix-banner.ed8b6071.png');
        background-position: 50% 50%;
        background-size: cover;
        height: 110px;
        margin-top: -25px;
    }

    .cart-movie {
        box-shadow: 0 .75rem 1.5rem rgba(18, 38, 63, .03);
        border: 1px solid #edf2f9;
        border-radius: .5rem;
    }

    .radius7px {
        border-radius: 7px;
    }

    .bg-dark {
        background-color: #12263f !important;
    }

    .rap-active {
        background-color: #2c7be5;
        border-color: #2c7be5;
        color: #fff;
    }

    .rap-active h1 {
        color: #fff;
    }

    .color-custom {
        color: #6e84a3;
    }
</style>
<div class="tix-bg bg-dark">
    <div class="d-flex align-items-center justify-content-center" style="max-width: 80rem;margin: 0 auto; height:100%;">
        <div class="text-center">
            <h1 class="mb-0 text-white" style="font-size: 1.525rem;font-weight: 500;">Lịch chiếu phim</h1>
            <p class="mb-0" style="color:#95aac9;">
                Tìm lịch chiếu phim / rạp nhanh nhất với chỉ 1 bước!
            </p>

        </div>
    </div>
</div>
<div class="container mb-4" style="max-width: 80rem;margin: 0 auto;margin-top:4.239rem;">
    <div class="row">
        <div class="col-md-3">
            <div class="table-responsive table-food">
                <table class="mb-0">
                    <thead>
                        <tr>
                            <th style="color:black;font-size:12.5px;font-weight:600;background-color: #edf2f9;">Rạp
                                chiếu
                            </th>
                            <th style="background-color: #edf2f9;"></th>
                            <th style="background-color: #edf2f9;"></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div>
                    @foreach ($danhsachrap as $key => $item)
                        <div data-idrap="{{ $item->id }}" class="danhsachrap {{ $key == 0 ? 'rap-active' : '' }}"
                            style="border-bottom: 0.3px solid #e8e8e8;">
                            <div class="text-start" style="padding: 0.85em 15px;cursor: pointer;">
                                <h1 class="mb-0 color-custom" style="font-size: 0.95rem;font-weight: 500;">
                                    {{ $item->ten_rap }}
                                </h1>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="box-data d-inline-flex justify-content-around mb-2" style="width:100%">
                @for ($i = 0; $i <= count($listday) - 1; $i++) @if (
                        Carbon\Carbon::now('Asia/Ho_Chi_Minh')->
                            format('d-m') == $listday[$i]['date']
                    )
                                <div class="chooseDate btn-custom1 text-muteds btn-light border-right-custom active-date"
                                    data-date="{{$listday[$i]['ngaychuan']}}">{{ $listday[$i]['date'] }} <br> <span
                                        style="font-size: .8265rem;font-weight:400;">{{ $listday[$i]['day'] }}</span>
                                </div>
                @elseif($i == count($listday) - 1)
                    <div class="chooseDate btn-custom1 text-muteds btn-light border-left-custom"
                        data-date="{{$listday[$i]['ngaychuan']}}">{{ $listday[$i]['date'] }} <br> <span
                            style="font-size: .8265rem;font-weight:400;">{{ $listday[$i]['day'] }}</span>
                    </div>
                @else
                    <div class="chooseDate btn-custom1 text-muteds btn-light border-right-custom border-left-custom"
                        data-date="{{$listday[$i]['ngaychuan']}}">{{ $listday[$i]['date'] }}<br> <span
                            style="font-size: .8265rem;font-weight:400;">{{ $listday[$i]['day'] }}</span>
                    </div>
                @endif
                @endfor
            </div>
            <div class="alert d-flex align-items-center mt-2" style="background-color: #f6c343; padding:13px 20px;"
                role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-info">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M12 16v-4" />
                    <path d="M12 8h.01" />
                </svg>
                <span class="ms-2">Nhấn vào suất chiếu để tiến hành mua vé</span>
            </div>
            <!-- suất chiếu phim ở có ở trong rạp -->
            <div style="position: relative;">
                <span class="loader loading-suat" style="position: absolute;top:3px;left:50%;display:none;"></span>
                <div class="suatchieuphim">

                    <!-- <div class="cart-movie mb-2">
                        <div class="row mt-3 mb-3 ms-1 mr-1">
                            <div class="col-2 col-sm-2">
                                <a class="">
                                    <img class="radius7px" width="95px"
                                        src="https://cdn.moveek.com/storage/media/cache/mini/672109204e009437900999.jpg"
                                        alt="">
                                </a>
                            </div>
                            <div class="col" style="margin-left: -14px;">
                                <h2 class="mb-1" style="color:#12263f;font-weight: 500;">Linh Miêu: Quỷ Nhập Tràng</h2>
                                <div>
                                    <label style="color:#12263f;font-weight: 500;font-size: 13.5px;">Suất chiếu</label>
                                    <div class="d-flex flex-wrap">
                                        <a href="" class="">
                                            <div class="btn-somtime mr-1">08:00~09:30</div>
                                        </a>
                                        <a href="" class="">
                                            <div class="btn-somtime mr-1">08:00~09:30</div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    let currDate = "{{ Carbon\Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d') }}"
    let idrap = "{{ $danhsachrap[0]->id }}"
    const urlLink = "{{ asset('storage/') }}"
    const linkWeb = "{{ asset('') }}"

    const urlApi = "{{ asset('thanh-vien/lich-chieu/phim-rap/') }}"
</script>
<script src="{{ asset('js/lichchieu.js') }}"></script>
@endsection