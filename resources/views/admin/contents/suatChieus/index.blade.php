@extends('admin.index')

@section('content')
    <div class="card container mt-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="card-title">Danh sách Suất Chiếu</div>
            <a href="{{ route('suatChieu.create') }}" class="btn btn-primary">Thêm mới Suất Chiếu</a>
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
                                <option value="{{ $phongChieu->id }}" {{ request('phong_chieu_id') == $phongChieu->id ? 'selected' : '' }}>
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
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Phim</th>
                        <th scope="col">Thời Gian Bắt Đầu</th>
                        <th scope="col">Thời Gian Kết Thúc</th>
                        <th scope="col">Phòng Chiếu</th>
                        <th scope="col">Trạng Thái</th>
                        <th scope="col">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($suatChieus as $suatChieu)
                        <tr>
                            <td>{{ $suatChieu->id }}</td> 
                            <td>{{ $suatChieu->phim->ten_phim }}</td>
                            <td>{{ \Carbon\Carbon::parse($suatChieu->gio_bat_dau)->format('H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($suatChieu->gio_ket_thuc)->format('H:i') }}</td>
                            <td>{{ $suatChieu->phongChieu->ten_phong_chieu }}</td>
                           
                            <td class="text-center">
                                @if ($suatChieu->trang_thai == 1)
                                    <span class="text-success">* Hoạt động</span>
                                @else
                                    <span class="text-danger">x Không hoạt động</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <form method="POST" action="{{ route('suatChieu.destroy', $suatChieu->id) }}"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa mục này không?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Xóa</button>
                                    </form>
                                    <a class="btn btn-warning" href="{{ route('suatChieu.edit', $suatChieu->id) }}">Sửa</a>
                                    <a class="btn btn-info" href="{{ route('suatChieu.show', $suatChieu->id) }}">Xem</a>
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
        </div>
    </div>
@endsection
