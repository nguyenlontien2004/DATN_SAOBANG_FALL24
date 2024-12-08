@extends('layout.user')

@section('content')
    <div class="container mt-5" style="max-width: 80rem; margin: 0 auto;">
        <div class="mb-4 text-center">
            <h2 class="fw-bold">Tin tức</h2>
            <p class="text-muted">Cập nhật những tin tức mới nhất mỗi ngày</p>
        </div>

        <!-- Bộ lọc -->
        <div class="loc mb-5">
            <form action="{{ route('tintuc.hienthi') }}" method="GET"
                class="d-flex justify-content-between align-items-center">
                <div class="form-group me-3" style="flex: 1;">
                    <select class="form-control" name="danh_muc_bai_viet_tin_tuc_id" id="danh_muc_bai_viet_tin_tuc_id">
                        <option value="">Tất cả tin tức</option>
                        @foreach ($danhmuc as $dm)
                            <option value="{{ $dm->id }}"
                                {{ request('danh_muc_bai_viet_tin_tuc_id') == $dm->id ? 'selected' : '' }}>
                                {{ $dm->ten_danh_muc }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary d-flex align-items-center">
                    <i class="bi bi-filter me-2"></i> Lọc
                </button>
            </form>
        </div>

        <!-- Danh sách bài viết -->
        <div class="row g-4">
            @foreach ($baiviet as $bv)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="{{ route('tintuc.show', $bv->id) }}" class="text-decoration-none">
                        <div class="card shadow-sm border-0 h-100">
                            <img src="{{ asset('storage/' . $bv->hinh_anh) }}" class="card-img-top rounded-top"
                                style="height: 190px; object-fit: cover;" alt="Phim cổ trang Trung Quốc" />
                            <div class="card-body">
                                <h6 class="card-title fw-bold text-dark">
                                    {{ \Illuminate\Support\Str::limit($bv->tieu_de, 50) }}
                                </h6>
                                <p class="card-text text-muted small">
                                    {{ \Illuminate\Support\Str::limit($bv->tom_tat, 80) }}
                                </p>
                                <div class="news-info d-flex justify-content-between small text-muted">
                                    <span><i class="bi bi-calendar3"></i> {{ $bv->ngay_dang }}</span>
                                    <span><i class="bi bi-eye"></i> {{ $bv->luot_xem }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Phân trang -->
        <div class="mt-5 d-flex justify-content-center">
            {{ $baiviet->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
