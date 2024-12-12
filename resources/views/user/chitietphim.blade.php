@extends('layout.user')
@section('title')
{{ $title }}
@endsection
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@section('content')
<style>
    .d-flex .active-comment {
        text-decoration: underline;
        color: black;
    }

    .loaibinhluan {
        color: #757070;
    }
</style>
@php
    $idyoutube = (str_replace("https://www.youtube.com/watch?v=", "", $chiTietPhim->trailer));
    $embedUrl = "https://www.youtube.com/embed/" . $idyoutube;
@endphp
<div class="container mt-5" style="max-width: 80rem;margin: 0 auto;">
    <div class="row">
        <!-- Poster -->
        <div class="col-md-2">
            <div class="me-3">
                <!-- Hình ảnh của video -->
                <img alt="Video Thumbnail" class="img-fluid rounded film-image"
                    src="{{ asset('storage/' . $chiTietPhim->anh_phim) }}"
                    onclick="playVideo('{{ $embedUrl }}')"
                    style="cursor: pointer; width:100%; height: auto;" />
            </div>
        </div>
        <!-- Movie Details -->
        <div class="col-md-8">
            <h2 class="text-danger">{{ $chiTietPhim->ten_phim }}</h2>
            <p>
                <strong>Thể loại:</strong>
                @foreach ($chiTietPhim->theLoaiPhims as $theLoaiPhim)
                    {{ $theLoaiPhim->ten_the_loai }}@if (!$loop->last)
                        ,
                    @endif
                @endforeach
            </p>
            <p>
                <strong>Thời lượng:</strong>
                {{ $chiTietPhim->thoi_luong }}p
            </p>
            <p>
                <strong>Diễn viên chính:</strong>
                @foreach ($chiTietPhim->dienViens as $dienVien)
                    <a href="{{ route('thongtin.dienvien',$dienVien->id) }}" style="text-decoration: none;">{{ $dienVien->ten_dien_vien }}</a>
                    @if (!$loop->last)
                        ,
                    @endif
                @endforeach
            </p>
            <p>
                <strong>Đạo diễn chính:</strong>
                @foreach ($chiTietPhim->daoDiens as $daoDien)
                <a href="{{ route('thongtin.daodien',$daoDien->id) }}" style="text-decoration: none;">{{ $daoDien->ten_dao_dien }}</a>
                    @if (!$loop->last)
                        ,
                    @endif
                @endforeach
            </p>
            <p>
                <strong>Mô tả:</strong>
                {!! $chiTietPhim->mo_ta !!}
            </p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <!-- Phần này mua ngay nhưng mua vé theo ngày nào nên không cần  -->
                <!-- Phần này cũng vậy có chức năng thêm yêu thích đâu mà cần input này -->
            </div>
            <div class="bip m-3">
                <div class="button-container123">
                    <a href="#" class="button123 trailer" onclick="playVideo('{{ $embedUrl }}')">
                        <i class="fas fa-play"></i>
                        <span>Xem trailer</span>
                    </a>
            
                    <!-- Phần này cũng vậy có chức năng thêm yêu thích đâu mà cần input này -->
                </div>
            </div>
        </div>
    </div>
    <!-- Modal để hiển thị video -->
    <div id="videoModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body" style="padding:0px">
                    <iframe id="video" src="" frameborder="0" allowfullscreen
                        style="width: 100%; height: 60vh;"></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Phần lịch chiếu bên trái -->
        <div class="col-md-8">
            <div>
                <div class="border p-3" style="border-radius: .5rem;">
                    <!-- Phần này không cần thiết xoá đi nếu ông megre thì lấy phần của tôi nha -->

                    <!-- Nội dung lịch chiếu -->
                    <div class="p-3 mb-3">
                        <div class="box-data d-inline-flex justify-content-around mb-2" style="width:100%">
                            @for ($i = 0; $i <= count($listday) - 1; $i++) @if (
                                    Carbon\Carbon::now('Asia/Ho_Chi_Minh')->
                                        format('d-m') == $listday[$i]['date']
                                )
                                                        <div class="chooseDate btn-custom1 text-muteds btn-light border-right-custom active-date"
                                                            data-date="{{$listday[$i]['date']}}">{{ $listday[$i]['date'] }} <br> <span
                                                                style="font-size: .8265rem;font-weight:400;">{{ $listday[$i]['day'] }}</span>
                                                        </div>
                            @elseif($i == count($listday) - 1)
                                <div class="chooseDate btn-custom1 text-muteds btn-light border-left-custom"
                                    data-date="{{$listday[$i]['date']}}">{{ $listday[$i]['date'] }} <br> <span
                                        style="font-size: .8265rem;font-weight:400;">{{ $listday[$i]['day'] }}</span>
                                </div>
                            @else
                                <div class="chooseDate btn-custom1 text-muteds btn-light border-right-custom border-left-custom"
                                    data-date="{{$listday[$i]['date']}}">{{ $listday[$i]['date'] }}<br> <span
                                        style="font-size: .8265rem;font-weight:400;">{{ $listday[$i]['day'] }}</span>
                                </div>
                            @endif
                            @endfor
                        </div>
                        <div style="position: relative;padding:5px 0">
                            <div class="container-booth box-lichchieu">
                                <!-- <div class="border-bottom p-2">
                            <div>
                                <p><strong>CGV:</strong> Beta Đan Phượng</p>
                                <p>Tầng 2, Tòa nhà HHA, Khu đô thị XPHomes...</p>
                            </div>
                            <div class="d-flex pt-1 flex-wrap">
                                <a href="">
                                    <div class="btn-somtime mr-1">15:30~18:30</div>
                                </a>
                                <a href="">
                                    <div class="btn-somtime mr-1">15:30~18:30</div>
                                </a>
                            </div>
                        </div> -->
                            </div>
                            <span class="loader loading-suat"
                                style="position: absolute;top:3px;left:50%;display:none;"></span>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="mt-3">
                        <div class="d-flex">
                            <h3 data-type="danhgia"
                                class="loaibinhluan active-comment text-xl mb-1 mr-3 font-bold cursor-pointer">Đánh giá
                                từ
                                người
                                xem</h3>
                            <h3 data-type="binhluan" class="loaibinhluan  text-xl mb-1 mr-3 font-bold cursor-pointer">
                                Bình
                                luận
                                góp ý</h3>
                        </div>
                        <div style="display: block;" class="danhgia">
                            @foreach ($danhSachDanhGia as $item)
                                <div class="list-group-item mt-2" style="border-bottom: 1px solid #dadada;">
                                    <div class="d-flex w-100 mb-2">
                                        <h5 class="mb-1">
                                            <strong>{{ $item->NguoiDung->ho_ten ?? 'Người dùng ẩn danh' }}</strong>
                                        </h5>
                                        <small class="ml-2">{{ $item->created_at->format('d/m/Y') }}</small>
                                    </div>
                                    <p class="mb-1">Nội dung đánh giá: {{ $item->noi_dung }}</p>
                                    <div class="d-flex mb-2">
                                        Điểm đánh giá:
                                        @for ($i = 1; $i <= 5; $i++) <i
                                                class="fa fa-star {{ $i <= $item->diem_danh_gia ? 'text-warning' : 'text-muted' }}">
                                            </i>
                                        @endfor
                                    </div>

                                </div>
                            @endforeach
                          <!--  -->
                          @auth
            <div class="mt-4">
                <p class="text-muted">
                    <a href="#" onclick="showReviewTab(); return false;">
                        <h2><strong>Viết bài đánh giá</strong></h2> <br>
                    </a>
                </p>
            </div>
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('gioihandanhgia'))
                <div class="alert alert-danger">
                    {{ session('gioihandanhgia') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <!-- Form đánh giá ẩn -->
           <small>
          
               @error('diem_danh_gia')
               <small id="emailHelp2" class="fs-6 text-danger">Đánh giá tổi thiểu là một sao!</small>
             @enderror
           </small>
            <div id="reviewTab" style="display: none; margin-top: 20px;">
                <h4>Đánh giá của bạn</h4>
                <form action="{{ route('danh-gia.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="phim_id" value="{{ $chiTietPhim->id }}">
                    <input type="hidden" name="nguoi_dung_id" value="{{ $userId }}">

                    <div class="mb-3">
                        <label for="content" class="form-label">Nội dung:</label>
                        <textarea name="noi_dung" id="content" class="form-control" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="rating" class="form-label">Điểm đánh giá:</label>
                        <div id="stars">
                            <span class="fa fa-star" data-value="1" onclick="setRating(1)"></span>
                            <span class="fa fa-star" data-value="2" onclick="setRating(2)"></span>
                            <span class="fa fa-star" data-value="3" onclick="setRating(3)"></span>
                            <span class="fa fa-star" data-value="4" onclick="setRating(4)"></span>
                            <span class="fa fa-star" data-value="5" onclick="setRating(5)"></span>
                        </div>
                        <input type="hidden" name="diem_danh_gia" id="rating" value="0">
                    </div>

                    <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
                </form>
            </div>
            <br>
        @else
            <!-- Thông báo khi chưa đăng nhập -->
            <div class="mt-4">
                <p class="text-muted">Bạn cần <a href="{{ route('dangnhap') }}"><strong>đăng nhập</strong></a> để đánh giá.
                </p>
            </div>
        @endauth
                          <!--  -->
                        </div>
                        <div style="display: none;position: relative;" class="binhluan mt-2">
                            <div class="container my-1 container-binhluan">
                                <!-- Bình luận người xem -->
                                <!-- <h3>Bình luận người xem</h3><br> -->
                                @foreach ($binhluan as $item)
                                    <div class="d-flex mb-1"
                                        style="border-bottom: 1px solid #dadada; justify-content: flex-start;flex-direction: column;    align-items: flex-start;">
                                        <div class="d-flex">
                                            <img src="{{ asset('storage/' . $item->NguoiDung->anh_dai_dien) }}"
                                                alt="đại diện"
                                                style="width: 37px; height: 37px; border-radius: 50%; object-fit: cover;"
                                                alt="User" class="rounded-circle me-3" style="width: 40px; height: 40px;" />
                                            <div>
                                                <h6 class="mb-1" style="font-weight: bold;">{{ $item->NguoiDung->ho_ten }}
                                                </h6>
                                                <span class="text-muted"
                                                    style="font-size: 12px;">{{ $item->created_at->locale('vi')->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="mb-1 ms-1 mt-1" style="font-size: 16px; color: #333;">
                                                {!! $item->noi_dung !!}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!-- <div style="position: absolute;width: 100%;height: 100%;top: 0;">
                                <span class="loader"></span>
                            </div> -->

                            <div class="container my-2">
                                <!-- Nội dung bình luận -->
                                <span class="dataUser"
                                    data-user="{{ Auth::check() && Auth::user()->anh_dai_dien !== "" ? asset('storage/' . Auth::user()->anh_dai_dien) : '' }}"></span>
                                @auth
                                    <form action="{{ route('binhluan.store') }}" class="formBinhluan" method="POST">
                                        @csrf
                                        <input type="hidden" name="phim_id" value="{{ $chiTietPhim->id }}">
                                        <input type="hidden" class="idnguoidung" name="nguoi_dung_id" value="{{ $userId }}">
                                        <input type="hidden" class="tennguoidung" name="ho_ten"
                                            value="{{ Auth::user()->ho_ten }}">
                                        <input type="hidden" name="ngay_binh_luan" id="rating" value="{{ date('Y:m:d ') }}">
                                        <div class="d-flex mt-4">
                                            <img src="{{ asset('storage/' . Auth::user()->anh_dai_dien) }}" alt="User"
                                                class="rounded-circle me-3" style="width: 40px; height: 40px;" />
                                            <div class="flex-grow-1 d-flex" style="max-width: 500px;align-items: center;">
                                                <textarea class="form-control noidungbinhluan" name="noi_dung"
                                                    placeholder="Viết bình luận của bạn..." rows="1"
                                                    style="border-radius: 20px; resize: none; overflow: hidden; width: 100%;"
                                                    oninput="autoResize(this)"></textarea>
                                                @error('noi_dung')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <div class="mt-2 ml-2 d-flex justify-content-end">
                                                    <button class="btnsubmitComment btn btn-primary btn-sm"
                                                        style="border-radius: 20px;">Đăng</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @else
                                    <!-- Thông báo khi chưa đăng nhập -->
                                    <div class="mt-4">
                                        <p class="text-muted">Bạn cần <a href="{{ route('dangnhap') }}"><strong>đăng
                                                    nhập</strong></a> để
                                            bình luận.</p>
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Phần phim đang chiếu bên phải -->
        <div class="col-md-4">
            <div class="border p-3 bg-light rounded">
                <h5 class="text-dark fw-bold mb-3">Phim đang chiếu</h5>
                <ul class="list-unstyled">
                    @foreach ($phimDangChieu as $item)
                        @if ($chiTietPhim->id !== $item->id)
                        <li class="border-bottom pb-3 mb-3">
                            <div class="d-flex align-items-start">
                                <div class="me-3">
                                    <!-- Hình ảnh của video -->
                                    <img alt="Video Thumbnail" class="img-fluid rounded film-image"
                                        src="{{ asset('storage/' . $item->anh_phim) }}"
                                        style="cursor: pointer; width: 65px; height: auto;" />
                                </div>
                                <div class="flex-grow-1">
                                    <a href="{{ route('chitietphim', $item->id) }}"
                                        class="text-decoration-none text-warning">
                                        <h6 class="mb-1 fw-bold" style="font-size: 1.3rem;">{{ $item->ten_phim }}</h6>
                                    </a>
                                    <p class="small text-muted mb-1 film-genre">
                                        @foreach ($item->theLoaiPhims as $theLoaiPhim)
                                            {{ $theLoaiPhim->ten_the_loai }}@if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </p>
                                    <!-- <p class="mb-0 text-warning">
                                        <i class="fas fa-star"></i> 6.3
                                    </p> -->
                                </div>
                            </div>
                        </li>
                        @endif
                    @endforeach
                </ul>

            </div>
        </div>
    </div>

</div>
</div>
<script>
    let currDate = "{{ Carbon\Carbon::now('Asia/Ho_Chi_Minh')->format('d-m') }}"
    const idMovie = "{{ $chiTietPhim->id }}"
    const urlApi = "{{ asset('api/suat-chieu/phim') }}"
    const urlBinhLuan = "{{ asset('binh-luan/phim/') }}"
    //$('asa').
</script>
@vite('resources/js/reatimeComment.js')
<script src="{{ asset('js/chitietve.js') }}"></script>
<script src="{{ asset('js/binhluan.js') }}"></script>
@endsection