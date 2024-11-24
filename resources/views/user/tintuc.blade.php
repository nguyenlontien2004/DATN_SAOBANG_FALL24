@extends('layout.user')

@section('content')
    <div class="row">
        <div class="col-12 mb-3">
            <h2 class="h5">Tin tức</h2>
        </div>

        <!-- Tin tức cards -->
        @foreach ($baiviet as $bv)
            <a href="{{ route('tintuc.show', $bv->id) }}">
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('storage/' . $bv->hinh_anh) }}" class="card-img-top" style="height:180; width:300"
                            alt="Phim cổ trang Trung Quốc" />
                        <div class="card-body">
                            <h5 class="card-title">
                                {{ $bv->tieu_de }}
                            </h5>
                            <p class="card-text56">
                                {{ $bv->tom_tat }}
                            </p>
                            <!-- Ngày đăng và lượt xem -->
                            <div class="news-info">
                                <span>Ngày đăng: {{ $bv->ngay_dang }}</span>
                                <span><i class="bi bi-eye"></i> {{ $bv->luot_xem }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach

    </div>
    {{ $baiviet->links() }}
@endsection
