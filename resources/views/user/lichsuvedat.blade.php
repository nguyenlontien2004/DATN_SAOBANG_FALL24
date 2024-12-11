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
    <div class="container5999 d-flex mt-5">
        <!-- Sidebar -->
        <div class="sidebar6669">
            <img alt="Ảnh đại diện người dùng" class="rounded-circle mb-3"
                src="{{ asset('storage/' . Auth::user()->anh_dai_dien) }}" style="width: 150px; height: 150px;" />
            <div class="username text-center font-weight-bold">{{ Auth::user()->ho_ten }} <span>{{ Auth::user()->gold }}
                    xu</span></div>
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
            @if (session('cannotcancelled'))
                <div class="alert alert-success">
                    {{ session('cannotcancelled') }}
                </div>
            @endif
            <table class="table table-striped history-table">
                <thead class="thead-dark">
                    <tr>
                        <th>STT</th>
                        <th>Tên phim</th>
                        <th>Thời gian chiếu</th>
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
                            <td>
                                <p>{{ $ve->suatChieu->ngay }}</p>
                                <span>{{ $ve->suatChieu->gio_bat_dau . '~' . $ve->suatChieu->gio_ket_thuc }}</span>
                            </td>
                            <td>
                                <span>Thanh toán qua {{ $ve->phuong_thuc_thanh_toan }}</span>
                            </td>
                            <td>{{ number_format($ve->tong_tien, 0, ',', '.') }} VNĐ</td>
                            <td class="d-flex ">
                                <a href="{{ route('thongtinve', [$ve->id, $ve->ma_code_ve]) }}">
                                    <button class="btn btn-warning btn-sm">Xem chi tiết</button>
                                </a>

                                @if ($ve->ngay_ve_mo == Carbon\Carbon::now('Asia/Ho_Chi_Minh')->toDateString())
                                    @if (Carbon\Carbon::parse($ve->suatChieu->gio_ket_thuc)->greaterThan(Carbon\Carbon::now('Asia/Ho_Chi_Minh')))
                                        <button class="btn btn-danger btn-sm">vé đã hết hạn</button>
                                    @endif
                                @elseif($ve->ngay_ve_mo < Carbon\Carbon::now('Asia/Ho_Chi_Minh')->toDateString())
                                    <button class="btn btn-danger btn-sm">vé đa hết hạn</button>
                                @else
                                    <form action="{{ route('huyve', $ve->id) }}" method="POST"
                                        onclick="return confirm('Bạn có muốn hủy vé này không. Nếu huỷ chúng tôi sẽ quy đổi số tiền vé đó thành xu và có thể dùng để mua các vé khác!')"
                                        class="d-inline">
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
        </div>
    </div>
@endsection
