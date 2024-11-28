@extends('layout.user')

@section('content')
    <div class="row">
        <div class="col-12 mb-3">
            <h2 class="h5">Tin tức</h2>
        </div>

        <!-- Tin tức cards -->
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card h-100">
                <img src="https://via.placeholder.com/300x180" class="card-img-top" alt="Phim cổ trang Trung Quốc" />
                <div class="card-body">
                    <h5 class="card-title">
                        Phim cổ trang Trung Quốc 2024 khiến bạn cực phấn khích
                    </h5>
                    <p class="card-text56">
                        Nội dung: Những bộ phim cổ trang Trung Quốc đầy kịch tính và mãn
                        nhãn...
                    </p>
                    <!-- Ngày đăng và lượt xem -->
                    <div class="news-info">
                        <span>Ngày đăng: 2024-10-04</span>
                        <span><i class="bi bi-eye"></i> 3,214 lượt xem</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Repeat for more news articles -->
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card h-100">
                <img src="https://via.placeholder.com/300x180" class="card-img-top" alt="Phim cổ trang Trung Quốc" />
                <div class="card-body">
                    <h5 class="card-title">
                        Phim cổ trang Trung Quốc 2024 khiến bạn cực phấn khích
                    </h5>
                    <p class="card-text">
                        Nội dung: Những bộ phim cổ trang Trung Quốc đầy kịch tính và mãn
                        nhãn...
                    </p>
                    <!-- Ngày đăng và lượt xem -->
                    <div class="news-info">
                        <span>Ngày đăng: 2024-10-04</span>
                        <span><i class="bi bi-eye"></i> 5,120 lượt xem</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link">Previous</a>
            </li>
            <li class="page-item active">
                <a class="page-link" href="#">1</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">67</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
    </nav>
@endsection
