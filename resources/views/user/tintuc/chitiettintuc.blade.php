@extends('layout.user')

@section('content')
    <div class="row">
        <!-- Tin tức content -->
        <div class="col-md-8">

            <h2>{{ $tt->tieu_de }}</h2>
            <p class="text-muted">Lượt xem: {{ $tt->luot_xem }}</p>
            <hr />
            <p>
                <strong>Tóm tắt tin tức:</strong> {{ $tt->tom_tat }}
            </p>
            <div class="content">
                <p>
                    {!! $tt->noi_dung !!}
                </p>
            </div>

        </div>

        <!-- Sidebar Tin tức liên quan -->
        <div class="col-md-4">
            <div class="p-3 bg-light">
                <h4 class="border-bottom pb-2">Tin tức</h4>
                <!-- Danh sách tin tức liên quan -->
                <ul class="list-unstyled">
                    <li class="mb-3">
                        <div class="d-flex">
                            <img src="thumbnail1.jpg" alt="News Thumbnail" class="me-3"
                                style="width: 64px; height: 64px" />
                            <div>
                                <h5 class="h6 mb-1">Tiêu đề của bài viết</h5>
                                <p class="small text-muted mb-0">
                                    Tóm tắt bài viết ngắn gọn...
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="mb-3">
                        <div class="d-flex">
                            <img src="thumbnail2.jpg" alt="News Thumbnail" class="me-3"
                                style="width: 64px; height: 64px" />
                            <div>
                                <h5 class="h6 mb-1">Tiêu đề của bài viết</h5>
                                <p class="small text-muted mb-0">
                                    Tóm tắt bài viết ngắn gọn...
                                </p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
