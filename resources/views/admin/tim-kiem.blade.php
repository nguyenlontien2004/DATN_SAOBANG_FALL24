@extends('admin.index')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Kết quả tìm kiếm cho : "{{ request('query') }}"</h5>
            </div>
            <div class="card-body">
                {{-- kết quả cho thể loại --}}
                @if ($theLoaiResults->count() > 0)
                    <h3>Thể Loại Phim</h3>
                    <table class="table table-sm table-hover text-center align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Thể Loại Phim</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($theLoaiResults as $theloai)
                                <tr>
                                    <td>{{ $theloai->id }}</td>
                                    <td>{{ $theloai->ten_the_loai }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center align-middle">
                                            <a href="{{ route('theLoaiPhim.index', ['query' => $theloai->id]) }}"
                                                class="btn btn-sm btn-info me-2 d-flex">
                                                <i class="bi bi-search me-2"></i>Truy vấn
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
                {{-- kết quả tim kiếm đạo diễn --}}
                @if ($daoDienResults->count() > 0)
                    <h3>Đạo diễn</h3>
                    <table class="table table-sm table-hover text-center align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên Đạo Diễn</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($daoDienResults as $daoDien)
                                <tr>
                                    <td>{{ $daoDien->id }}</td>
                                    <td>{{ $daoDien->ten_dao_dien }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center align-middle">
                                            <a href="{{ route('daoDien.show', ['daoDien' => $daoDien->id]) }}"
                                                class="btn btn-sm btn-info me-2 d-flex">
                                                <i class="bi bi-search me-2"></i>Truy vấn
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
                {{-- kết quả tim kiếm đạo diễn --}}
                @if ($dienVienResults->count() > 0)
                    <h3>Diễn viên</h3>

                    <table class="table table-sm table-hover text-center align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên Diễn Viên</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dienVienResults as $dienVien)
                                <tr>
                                    <td>{{ $dienVien->id }}</td>
                                    <td>{{ $dienVien->ten_dien_vien }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
                {{-- kết quả tim kiếm phim --}}
                @if ($phimResults->count() > 0)
                    <h3>Phim</h3>
                    <table class="table table-sm table-hover text-center align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên Phim</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($phimResults as $phim)
                                <tr>
                                    <td>{{ $phim->id }}</td>
                                    <td>{{ $phim->ten_phim }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center align-middle">
                                            <a href="{{ route('phim.show', ['phim' => $phim->id]) }}"
                                                class="btn btn-sm btn-info me-2 d-flex">
                                                <i class="bi bi-search me-2"></i>Truy vấn
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
                {{-- kết quả tim kiếm rap --}}
                @if ($rapResults->count() > 0)
                    <h3>Rạp Chiếu Phim</h3>
                    <table class="table table-sm table-hover text-center align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên Rạp</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rapResults as $rap)
                                <tr>
                                    <td>{{ $rap->id }}</td>
                                    <td>{{ $rap->ten_rap }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center align-middle">
                                            <a href="{{ route('rap.index', ['query' => $rap->id]) }}"
                                                class="btn btn-sm btn-info me-2 d-flex">
                                                <i class="bi bi-search me-2"></i>Truy vấn
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
                {{-- kết quả tim kiếm phòng chiếu --}}
                @if ($phongchieuResults->count() > 0)
                    <h3>Phòng Chiếu</h3>
                    <table class="table table-sm table-hover text-center align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên Phòng chiếu</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($phongchieuResults as $phongchieu)
                                <tr>
                                    <td>{{ $phongchieu->id }}</td>
                                    <td>{{ $phongchieu->ten_phong_chieu }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center align-middle">
                                            <a href="{{ route('admin.phongChieu', ['query' => $phongchieu->id]) }}"
                                                class="btn btn-sm btn-info me-2 d-flex">
                                                <i class="bi bi-search me-2"></i>Truy vấn
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
                {{-- kết quả tim kiếm Người dùng --}}
                @if ($nguoiDungResults->count() > 0)
                    <h3>Người Dùng</h3>
                    <table class="table table-sm table-hover text-center align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên Người Dùng</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nguoiDungResults as $nguoiDung)
                                <tr>
                                    <td>{{ $nguoiDung->id }}</td>
                                    <td>{{ $nguoiDung->ho_ten }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center align-middle">
                                            <a href="{{ route('nguoi-dung.show', ['nguoi_dung' => $nguoiDung->id]) }}"
                                                class="btn btn-sm btn-info me-2 d-flex">
                                                <i class="bi bi-search me-2"></i>Truy vấn
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
                {{-- kết quả tim kiếm Suất Chiếu --}}
                @if ($suatChieuResults->count() > 0)
                    <h3>Suất Chiếu Phim</h3>
                    <table class="table table-sm table-hover text-center align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Phim</th>
                                <th>Thời Gian</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suatChieuResults as $suatChieu)
                            <tr>
                                <td>{{ $suatChieu->id }}</td>
                                <td>{{ $suatChieu->phim->ten_phim }}</td> 
                                <td>{{ \Carbon\Carbon::parse($suatChieu->gio_bat_dau)->format('H:i')}}<->{{\Carbon\Carbon::parse($suatChieu->gio_ket_thuc)->format('H:i') }}</td>
                                <td>
                                    <a href="{{ route('suatChieu.show', ['suatChieu' => $suatChieu->id]) }}" class="btn btn-sm btn-info">
                                        <i class="bi bi-search me-2"></i>Truy vấn
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
                {{-- kết quả tim kiếm vé --}}
                @if ($veResults->count() > 0)
                    <h3>Vé</h3>
                    <table class="table table-sm table-hover text-center align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên Khách Hàng</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($veResults as $ve)
                                <tr>
                                    <td>{{ $ve->id }}</td>
                                    <td>{{ $ve->user->ho_ten }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center align-middle">
                                            <a href="{{ route('admin.ticket.detail', ['id' => $ve->id]) }}"
                                                class="btn btn-sm btn-info me-2 d-flex">
                                                <i class="bi bi-search me-2"></i>Truy vấn
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
                {{-- kết quả tim kiếm mã giảm giá --}}
                @if ($phongchieuResults->count() > 0)
                    <h3>Phòng Chiếu</h3>
                    <table class="table table-sm table-hover text-center align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên Phòng chiếu</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($phongchieuResults as $phongchieu)
                                <tr>
                                    <td>{{ $phongchieu->id }}</td>
                                    <td>{{ $phongchieu->ten_phong_chieu }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center align-middle">
                                            <a href="{{ route('admin.phongChieu', ['query' => $phongchieu->id]) }}"
                                                class="btn btn-sm btn-info me-2 d-flex">
                                                <i class="bi bi-search me-2"></i>Truy vấn
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
                {{-- kết quả tim kiếm đồ ăn --}}
                @if ($phongchieuResults->count() > 0)
                    <h3>Phòng Chiếu</h3>
                    <table class="table table-sm table-hover text-center align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên Phòng chiếu</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($phongchieuResults as $phongchieu)
                                <tr>
                                    <td>{{ $phongchieu->id }}</td>
                                    <td>{{ $phongchieu->ten_phong_chieu }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center align-middle">
                                            <a href="{{ route('admin.phongChieu', ['query' => $phongchieu->id]) }}"
                                                class="btn btn-sm btn-info me-2 d-flex">
                                                <i class="bi bi-search me-2"></i>Truy vấn
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

            </div>
        </div>
    </div>
@endsection
