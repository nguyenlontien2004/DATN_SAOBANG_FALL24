@extends('layout.user')

@section('content')
    <div class=" mb-3">
        <h2 class="h5">Tin tức</h2>
    </div>
    <div class="row">
        @foreach ($baiviet as $bv)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <a href="{{ route('tintuc.show', $bv->id) }}" class="text-decoration-none">
                    <div class="card h-100">
                        <img src="{{ asset('storage/' . $bv->hinh_anh) }}" class="card-img-top"
                            style="height: 190px; width: 100%; object-fit: cover;" alt="Phim cổ trang Trung Quốc" />

                        <div class="card-body">
                            <h5 class="card-title">
                                {{ $bv->tieu_de }}
                            </h5>
                            <p class="card-text">
                                {{ $bv->tom_tat }}
                            </p>
                            <!-- Ngày đăng và lượt xem -->
                            <div class="news-info d-flex justify-content-between">
                                <span>Ngày đăng: {{ $bv->ngay_dang }}</span>
                                <span><i class="bi bi-eye"></i> {{ $bv->luot_xem }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    {{ $baiviet->links() }}
@endsection
