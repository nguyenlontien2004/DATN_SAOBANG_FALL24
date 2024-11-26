@extends('admin.index')

@section('content')
    <div class="card container mt-5">
        <!-- Header Section -->
        <div class="card-header d-flex justify-content-start align-items-center">
            <a href="#" onclick="window.history.back()" role="button" class="btn btn-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace mr-2" viewBox="0 0 16 16">
                    <path d="M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z" />
                    <path d="M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z" />
                </svg>
                Quay lại
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <img alt="Movie poster" class="img-fluid shadow rounded" style="height: 450px; object-fit: cover;" src="{{ asset('storage/' . $dienViens->anh_dien_vien) }}" />
                </div>
                <div class="col-md-8">
                    <h2 class="movie-title">{{ $dienViens->ten_dien_vien }}</h2>
                    <div class="movie-info">
                        <div class="d-flex mb-2">
                            <div class="mr-5">
                                <strong>Ngày Sinh</strong>
                                <p>{{ $dienViens->nam_sinh }}</p>
                            </div>
                        </div>
                        <div class="mb-2">
                            <strong>Quốc gia</strong>
                            <p>{{ $dienViens->quoc_tich }}</p>
                        </div>
                        <div class="mb-2">
                            <strong>Giới Tính</strong>
                            <p>{{ $dienViens->gioi_tinh }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-2">
                <strong>Tiểu Sử</strong>
                <div>{!! $dienViens->tieu_su !!}</div>
            </div>
        </div>
    </div>
@endsection
