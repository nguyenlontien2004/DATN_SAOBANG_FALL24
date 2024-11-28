@extends('layout.user')

@section('content')
    <div class="row">
        <!-- Tin tức content -->
        <div class="col-md-8">
            <h2>Tiêu đề tin tức</h2>
            <p class="text-muted">Lượt xem: 1.200</p>
            <hr />
            <p>
                <strong>Tóm tắt tin tức:</strong> Đây là phần tóm tắt nội dung chính
                của bài viết, giúp người đọc có cái nhìn tổng quát về thông tin bài
                viết...
            </p>
            <div class="content">
                <p>
                    Chi tiết tin tức sẽ được hiển thị ở đây. Bạn có thể sử dụng đoạn
                    văn bản này để viết chi tiết về tin tức. Nội dung bao gồm thông
                    tin cụ thể về bài viết, hình ảnh hoặc bất kỳ chi tiết nào liên
                    quan.
                </p>
                <!-- Ví dụ hình ảnh tin tức -->
                <img src="news-image.jpg" class="img-fluid" alt="News Image" />
                <p>
                    Phần này tiếp tục mô tả chi tiết nội dung, đưa ra các phân tích
                    hoặc thông tin bổ sung cần thiết.
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
