@extends('layout.user')

@section('content')
    <div class="container5999">
        <div class="sidebar6669">
            <img alt="Ảnh đại diện người dùng"
                src="https://storage.googleapis.com/a1aa/image/u9y6E0sefgilO0ViSNJkVoITvkptQM6YskJidpWdJi4iLFlTA.jpg" />
            <div class="username">Tên người dùng</div>
            <hr />
            <a href="#">Thông tin cá nhân</a>
            <a href="#">Đổi mật khẩu</a>
            <a href="#">Lịch sử đặt vé</a>
            <a href="#">Cập nhật thông tin cá nhân</a>
        </div>
        <div class="content">
            <h1>Lịch sử đặt vé</h1>
            <table class="history-table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên phim</th>
                        <th>Thời gian chiếu</th>
                        <th>Ghế</th>
                        <th>Tình trạng</th>
                        <th>Giá vé</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Phim A</td>
                        <td>20/10/2024 - 18:00</td>
                        <td>A1, A2</td>
                        <td>Đã thanh toán</td>
                        <td>200.000 VNĐ</td>
                        <td>
                            <button class="btn btn-warning">Xem chi tiết</button>
                            <button class="btn btn-danger">Hủy vé</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Phim B</td>
                        <td>21/10/2024 - 20:00</td>
                        <td>B1, B2</td>
                        <td>Đã hủy</td>
                        <td>200.000 VNĐ</td>
                        <td>
                            <button class="btn btn-warning">Xem chi tiết</button>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Phim C</td>
                        <td>22/10/2024 - 19:00</td>
                        <td>C1, C2, C3</td>
                        <td>Đã thanh toán</td>
                        <td>300.000 VNĐ</td>
                        <td>
                            <button class="btn btn-warning">Xem chi tiết</button>
                            <button class="btn btn-danger">Hủy vé</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="phantrang mt-4">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Trước</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Tiếp theo</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection
