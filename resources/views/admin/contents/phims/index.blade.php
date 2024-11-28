@extends('admin.index')

@section('content')
    <div class="card container mt-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="card-title">Danh sách Phim</div>
            <a href="{{ route('phim.create') }}" class="btn btn-primary">Thêm mới Phim</a>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('phim.index') }}" id="filterForm" class="mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <label for="the_loai" class="me-2">Thể loại:</label>
                        <select name="the_loai" id="the_loai" class="form-select" style="width: 200px"
                            onchange="document.getElementById('filterForm').submit();">
                            <option value="">Tất cả</option>
                            @foreach ($theLoaiPhims as $theLoai)
                                <option value="{{ $theLoai->id }}"
                                    {{ request('the_loai') == $theLoai->id ? 'selected' : '' }}>
                                    {{ $theLoai->ten_the_loai }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên Phim</th>
                        <th scope="col">Ảnh Phim</th>
                        <th scope="col">Thể Loại</th>
                        <th scope="col">Thời Lượng</th>
                        <th scope="col">Lượt Xem</th>
                        <th scope="col">Ngày Khởi Chiếu</th>
                        <th scope="col">Ngày Kết Thúc</th>
                        <th scope="col">Trạng Thái</th>
                        <th scope="col">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($phims as $index => $phim)
                        <tr>
                            <td>{{ $phim->id }}</td>
                            <td>{{ $phim->ten_phim }}</td>
                            <td>
                                @if ($phim->anh_phim)
                                    <img src="{{ asset('storage/' . $phim->anh_phim) }}" alt="Ảnh phim" width="100">
                                @else
                                    Không có ảnh
                                @endif
                            </td>
                            <td>
                                @foreach ($phim->theLoaiPhims as $theLoaiPhim)
                                    {{ $theLoaiPhim->ten_the_loai }}@if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $phim->thoi_luong }}</td>
                            <td>{{ $phim->luot_xem_phim }}</td>
                            <td>{{ \Carbon\Carbon::parse($phim->ngay_khoi_chieu)->format('Y-m-d') }}</td>
                            <td>{{ \Carbon\Carbon::parse($phim->ngay_ket_thuc)->format('Y-m-d') }}</td>
                            <td class="text-center">
                                @if ($phim->trang_thai == 1)
                                    <span class="text-success">* Hoạt động</span>
                                @else
                                    <span class="text-danger">x Không hoạt động</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <form method="POST" action="{{ route('phim.destroy', $phim->id) }}"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa mục này không?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Xóa</button>
                                    </form>
                                    <a class="btn btn-warning" href="{{ route('phim.edit', $phim->id) }}">Sửa</a>
                                    <a class="btn btn-info" href="{{ route('phim.show', $phim->id) }}">Xem</a>
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">Không có phim nào phù hợp với điều kiện lọc.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    @endsection
