@extends('admin.index')

@section('content')
    <div class="card container mt-5">
        <div class="card-header d-flex justify-content-left align-items-center">
            <a href="#" onclick="window.history.back()" role="button" class="btn btn-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-backspace mr-2" viewBox="0 0 16 16">
                    <path
                        d="M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z" />
                    <path
                        d="M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z" />
                </svg>
                Quay lại
            </a>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <img alt="Movie poster" class="img-fluid shadow rounded" style="height: 450px; object-fit: cover;"
                        src="{{ asset('storage/' . $phim->anh_phim) }}" />
                </div>
                <!-- Movie Details -->
                <div class="col-md-8">
                    <h2 class="movie-title">{{ $phim->ten_phim }}</h2>
                    <h4 class="movie-subtitle">Operation Undead · 2024 · {{ $phim->thoi_luong }} phút</h4>

                    <div class="movie-rating mb-3">
                        <span class="badge bg-warning text-dark">IMDb</span>
                        <span class="fs-4">6.4</span>
                    </div>

                    {{-- <p class="movie-description mb-3">
                        Ăn tươi nuốt sống đến khi không còn một mảnh xác!
                    </p> --}}

                    <div class="movie-info">
                        <div class="mb-2">
                            <strong>Nội dung</strong>
                            <div>{!! $phim->mo_ta !!}</div>
                        </div>
                        <div class="d-flex justify-content-left mb-2">
                            <div class="mr-5">
                                <strong>Đạo diễn</strong>
                                <p>
                                    @foreach ($phim->daoDiens as $daoDien)
                                        {{ $daoDien->ten_dao_dien }}@if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </p>
                            </div>
                            <div class="border-left mx-4" style="height: 50px;"></div>
                            <div>
                                <strong>Diễn viên</strong>
                                <p>
                                    @foreach ($phim->dienViens as $dienVien)
                                        {{ $dienVien->ten_dien_vien }}@if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-left mb-2">
                            <div class="mr-5">
                                <strong>Ngày chiếu</strong>
                                <p>{{ $phim->ngay_khoi_chieu }}</p>
                            </div>
                            <div class="border-left mx-4" style="height: 50px;"></div>
                            <div>
                                <strong>Ngày kết thúc</strong>
                                <p>{{ $phim->ngay_ket_thuc }}</p>
                            </div>
                        </div>
                        <div class="mb-2">
                            <strong>Thể loại</strong>
                            <p>
                                @foreach ($phim->theLoaiPhims as $theLoaiPhim)
                                    {{ $theLoaiPhim->ten_the_loai }}@if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </p>
                        </div>
                        <div class="mb-2">
                            <strong>Quốc gia</strong>
                            <p>{{ $phim->quoc_gia }}</p>
                        </div>
                    </div>

                    <div class="movie-buttons">
                        <button class="btn btn-danger" data-toggle="modal">
                            <i class="fas fa-play"></i>
                            Xem trailer
                        </button>
                        <button class="btn btn-warning">
                            <i class="fas fa-star"></i>
                            Xem review
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
