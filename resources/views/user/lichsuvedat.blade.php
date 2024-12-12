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
<div class="d-flex mt-5" style="max-width:85%; margin:0 auto;">
    <!-- Sidebar -->
    @php
            $user = Auth::user();
        @endphp
    <div class="sidebar6669">
            <div class="form-group mb-3 d-flex justify-content-center align-items-center">
                <img alt="Ảnh đại diện người dùng" src="{{ Auth::user()->anh_dai_dien != "" ? asset('storage/' . Auth::user()->anh_dai_dien) : 'https://cdn.moveek.com/bundles/ornweb/img/no-avatar.png' }}"
                    style="border-radius: 50%; height: 100px; width: 100px; object-fit: cover" />
            </div>
            <div class="username">{{ $user->ho_ten }} <span>{{Auth::user()->gold }} xu</span></div>
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
        @if (session('vedahuy'))
            <div class="alert alert-warning">
                {{ session('vedahuy') }}
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Tên phim</th>
                    <th scope="col">Thời gian chiếu</th>
                    <th scope="col">Thanh toán</th>
                    <th scope="col">Giá vé</th>
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($lichSuDatVe as $key => $ve)
                    <tr>
                        <td>{{ $ve->suatChieu->phim->ten_phim }}</td>
                        <td>
                            <p class="mb-0">{{ $ve->suatChieu->ngay }}</p>
                            <span>{{ $ve->suatChieu->gio_bat_dau.'~'.$ve->suatChieu->gio_ket_thuc }}</span>
                        </td>
                        <td>
                            <span>{{ $ve->phuong_thuc_thanh_toan }}</span>
                        </td>
                        <td>{{ number_format($ve->tong_tien, 0, ',', '.') }}đ</td>
                        <td class="d-flex">
                                <a href="{{ route('client.chitietvedat', [$ve->id]) }}">
                                    <button class="btn btn-warning btn-sm">Xem chi tiết</button>
                                </a>                
                         @php
                         $gioBatDau = \Carbon\Carbon::createFromFormat('H:i', $ve->suatChieu->gio_bat_dau);
                         $gioBatDauTru15Phut = $gioBatDau->subMinutes(15)->format('H:i');
                         @endphp

                       @if ($ve->deleted_at !== null)
                        <p class="btn btn-danger btn-sm pb-0 mb-0" style="color:white;">Vé đã huỷ</p>
                       @else
                       @if ($ve->ngay_ve_mo == Carbon\Carbon::now('Asia/Ho_Chi_Minh')->toDateString())
                          @if ($ve->trang_thai == 1)
                          @if ($gioBatDauTru15Phut >= $currentTime)
                          <form action="{{ route('huyve', $ve->id) }}" method="POST"
                                    onclick="return confirm('Bạn có muốn hủy vé này không. Nếu huỷ chúng tôi sẽ quy đổi số tiền vé đó thành xu và có thể dùng để mua các vé khác!')" class="d-inline">
                                    @csrf
                                    <button class="btn btn-danger btn-sm">Hủy vé</button>
                                </form>
                          
                          @endif
                          @else
                          
                          @endif
                        @elseif($ve->ngay_ve_mo < Carbon\Carbon::now('Asia/Ho_Chi_Minh')->toDateString())
                       <p></p>
                       @else
                       <form action="{{ route('huyve', $ve->id) }}" method="POST"
                                    onclick="return confirm('Bạn có muốn hủy vé này không. Nếu huỷ chúng tôi sẽ quy đổi số tiền vé đó thành xu và có thể dùng để mua các vé khác!')" class="d-inline">
                                    @csrf
                                    <button class="btn btn-danger btn-sm">Hủy vé</button>
                                </form>
                        @endif
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