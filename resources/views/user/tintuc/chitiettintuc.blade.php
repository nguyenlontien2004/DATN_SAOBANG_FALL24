@extends('layout.user')

@section('content')
    <div class="row">
        <!-- Tin tức content -->
        <div class="col-md-8 news-content bg-light">
            <h2 class="news-title">{{ $tt->tieu_de }}</h2>
            <hr />
            <p class="summary">
                <strong>Tóm tắt tin tức:</strong> {{ $tt->tom_tat }}
            </p>
            <div class="content">
                <p>{!! $tt->noi_dung !!}</p>
            </div>

            <div class="f mt-3 d-flex justify-content-between align-items-center">
                <p class="text-muted view-count">
                    <i class="bi bi-calendar-date"></i> Ngày đăng: {{ $tt->ngay_dang }}
                </p>
                <p class="text-muted view-count">
                    <i class="bi bi-eye"></i> Lượt xem: {{ $tt->luot_xem }}
                </p>
            </div>

        </div>

        <!-- Sidebar Tin tức liên quan -->
        <div class="col-md-4">
            <div class="p-3 bg-light">
                <h4 class="border-bottom pb-2">Tin tức</h4>
                <!-- Danh sách tin tức liên quan -->
                @foreach ($lienquan as $lq)
                    <a href="{{ route('tintuc.show', $lq->id) }}">
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <div class="d-flex">
                                    <img src="{{ asset('storage/' . $lq->hinh_anh) }}" alt="News Thumbnail" class="me-3"
                                        style="width: 64px; height: 64px" />
                                    <div>
                                        <h5 class="h6 mb-1">{{ $lq->tieu_de }}</h5>
                                        <p class="small text-muted mb-0">
                                            {{ $lq->tom_tat }}
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </a>
                @endforeach

            </div>
        </div>
    </div>
@endsection
