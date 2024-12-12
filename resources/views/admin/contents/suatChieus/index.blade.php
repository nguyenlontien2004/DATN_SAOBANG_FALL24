@extends('admin.index')

@section('content')
    <div class="card m-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div class="card-title">Danh sách suất chiếu</div>
                <span class="px-2">/</span> 
                <a href="{{ route('suatChieu.create') }}">Thêm mới suất chiếu</a>
                <span class="px-2">/</span>
                <a href="{{ route('admin.suatChieu.listSoftDelete') }}">Các mục đã xoá mềm</a>
            </div>
            <div>
                <form action="{{ route('suatChieu.index') }}" method="GET" class="form-inline d-flex align-items-center">
                    <label for="search" class="me-3 mb-0">Lọc:</label>
                    <input type="text" value="{{ request('query') }}" class="form-control" id="query"
                        style="min-width: 200px;" name="query" placeholder="">
                </form>
            </div>
        </div>

        <div class="card-body">
            <form method="GET" action="{{ route('suatChieu.index') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <label for="phim_id">Lọc theo phim:</label>
                        <select name="phim_id" id="phim_id" class="form-control">
                            <option value="">-- Tất cả phim --</option>
                            @foreach ($phims as $phim)
                                <option value="{{ $phim->id }}" {{ request('phim_id') == $phim->id ? 'selected' : '' }}>
                                    {{ $phim->ten_phim }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="phong_chieu_id">Lọc theo phòng chiếu:</label>
                        <select name="phong_chieu_id" id="phong_chieu_id" class="form-control">
                            <option value="">-- Tất cả phòng chiếu --</option>
                            @foreach ($phongChieus as $phongChieu)
                                <option value="{{ $phongChieu->id }}"
                                    {{ request('phong_chieu_id') == $phongChieu->id ? 'selected' : '' }}>
                                    {{ $phongChieu->ten_phong_chieu }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-secondary">Lọc</button>
                    </div>
                </div>
            </form>
            @if (session('error'))
                    <div class="alert alert-warning">
                        {{ session('error') }}
                    </div>
                @endif
            @if (session('khongthehuy'))
                    <div class="alert alert-warning">
                        {{ session('khongthehuy') }}
                    </div>
                @endif
            @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            @if ($suatChieus->count())
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Phim</th>
                            <th scope="col">Phòng Chiếu</th>
                            <th scope="col">Gio Bắt Đầu</th>
                            <th scope="col">Gio Kết Thúc</th>
                            <th scope="col">Ngày</th>
                            <th scope="col">Giá suấtc chiếu</th>
                            <th scope="col">Trạng Thái</th>
                            <th scope="col">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($suatChieus as $suatChieu)
                            <tr>
                                <td>{{ $loop->index+ 1 }}</td>
                                <td>{{ $suatChieu->phim->ten_phim }}</td>
                                <td>Phòng: {{ $suatChieu->phongChieu->ten_phong_chieu }}</td>
                                <td><span class="text-info">{{ \Carbon\Carbon::parse($suatChieu->gio_bat_dau)->format('H:i') }}</span></td>
                                <td><span class="text-danger">{{ \Carbon\Carbon::parse($suatChieu->gio_ket_thuc)->format('H:i') }}</span></td>
                                <td>{{$suatChieu->ngay}}</td>
                                <td>{{ number_format($suatChieu->gia,0,',','.') }}đ</td>
                                <td class="text-center">
                                    @php
                                     $formtime = \Carbon\Carbon::parse($suatChieu->gio_bat_dau)->format('H:i');
                                     
                                     $gioBatDau = \Carbon\Carbon::createFromFormat('H:i', $suatChieu->gio_bat_dau);
                                     //dd($gioBatDau);
                                     $gioBatDauTru15Phut = $gioBatDau->subMinutes(15)->format('H:i');
                                    @endphp
                                    @if ($date == $suatChieu->ngay)
                                    @if ($gioBatDauTru15Phut >= $currentTime)
                                    <span class="text-success">Hoạt động</span>
                                    @else
                                    <span class="text-danger">Suất đa đóng</span>
                                    @endif
                                        
                                    @elseif($date > $suatChieu->ngay)
                                    <span class="text-danger">Suất đã đóng</span>
                                    @else
                                        <span class="text-success">Hoạt động</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center align-items-center">
                                         <form action="{{ route('admin.huysuatchieu', $suatChieu->id) }}" 
                                         onsubmit="return confirm('Khi huỷ suất chiếu thì các vé mà khách hàng mua sẽ bị huỷ và phải hoàn xu cho khách. Bạn có đồng ý không!');"
                                         method="POST">
                                         @csrf
                                             <button class="btn btn-danger btn-sm mr-1" style="margin-right: 2px;">Huỷ</button>
                                         </form>

                                        <form action="{{ route('admin.suatChieu.softDelete', $suatChieu->id) }}" method="POST"
                                            style="display:inline-block;"
                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa mục này không?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm mr-1" style="margin-right: 2px;">Xóa </button>
                                        </form>
                                        <a class="btn btn-warning btn-sm mr-1" style="margin-right: 2px;"
                                            href="{{ route('suatChieu.edit', $suatChieu->id) }}">Sửa</a>
                                        <a class="btn btn-info btn-sm mr-1" style="margin-right: 2px;"
                                            href="{{ route('suatChieu.show', $suatChieu->id) }}">Xem</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Không tìm thấy suất chiếu phù hợp</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            @else
                <p class="text-center">Không có dữ liệu.</p>
            @endif
        </div>
    </div>
@endsection