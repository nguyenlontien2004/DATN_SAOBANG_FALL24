@extends('layout.user')
<style>
    .container5999 {
        display: flex;
        gap: 20px;
    }

    .sidebar6669 {
        width: 250px;
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 10px;
    }

    .sidebar6669 a {
        text-decoration: none;
        color: #333;
        font-size: 16px;
        margin-bottom: 10px;
        display: block;
        transition: all 0.3s ease;
    }

    .sidebar6669 a:hover {
        color: #007bff;
    }

    .content {
        flex-grow: 1;
    }

    .history-table th,
    .history-table td {
        text-align: center;
        vertical-align: middle;
    }
</style>
@section('content')
    <div class="container5999">
    @php
            $user = Auth::user();
        @endphp

        <div class="sidebar6669">
            <div class="form-group mb-3 d-flex justify-content-center align-items-center">
                <img alt="Ảnh đại diện người dùng" src="{{ Auth::user()->anh_dai_dien != "" ? asset('storage/' . Auth::user()->anh_dai_dien) : 'https://cdn.moveek.com/bundles/ornweb/img/no-avatar.png' }}"
                    style="border-radius: 50%; height: 100px; width: 100px; object-fit: cover" />
            </div>
            <div class="username">{{ $user->ho_ten }}</div>
            <hr />
            <a href="{{ route('thong-tin-nguoi-dung') }}">Thông tin cá nhân</a>
            <a href="{{ route('doimatkhau') }}">Đổi mật khẩu</a>
            <a href="{{ route('lichsudatve') }}">Lịch sử đặt vé</a>
            <a href="{{ route('formcapnhat') }}">Cập nhật thông tin cá nhân</a>
            <a href="" class="text-danger">
                <form action="{{ route('dangxuat') }}" method="POST">
                @csrf
                <button type="submit">Đăng xuất</button>
            </form> 
            </a>
        </div>

        <!-- Content -->
        <div class="content flex-grow-1 px-4">
            <h1 class="mb-4">Lịch sử đặt vé</h1>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table table-striped history-table">
                <thead class="thead-dark">
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
                    @forelse($lichSuDatVe as $key => $ve)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $ve->suatChieu->phim->ten_phim }}</td>
                            <td>{{ $ve->suatChieu->gio_bat_dau }}</td>
                            <td>Chưa có</td>
                            <td>
                                @if (isset($ve->trang_thai) && $ve->trang_thai == 1)
                                    Đã thanh toán
                                @else
                                    Chưa thanh toán
                                @endif
                            </td>
                            <td>{{ number_format($ve->tong_tien, 0, ',', '.') }} VNĐ</td>
                            <td>
                                <button class="btn btn-warning btn-sm">Xem chi tiết</button>
                                @if ($ve->trang_thai != 1)
                                    <form action="{{ route('huyve', $ve->id) }}" method="POST"
                                        onclick="return confirm('Bạn có muốn hủy vé này không?')"
                                        class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger btn-sm">Hủy vé</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Bạn chưa đặt vé nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Phân trang -->
            <div class="phantrang mt-4">
                {{ $lichSuDatVe->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
