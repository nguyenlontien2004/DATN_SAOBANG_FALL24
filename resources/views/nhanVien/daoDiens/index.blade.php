@extends('nhanVien.index')

@section('content')
    <div class="card container mt-5">
        <div class="card-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
                <div class="card-title">Danh sách Đạo diễn</div>
                <span class="px-2">/</span>
                <a href="{{ route('nhanviendaoDien.create') }}">Thêm mới Đạo diễn</a>
                <span class="px-2">/</span>
                <a href="{{ route('nhanvien.daoDien.listSoftDelete') }}">Các mục đã xoá mềm</a>
            </div>
            <div>
                <form action="{{ route('daoDien.index') }}" method="GET" class="form-inline d-flex align-items-center">
                    <label for="search" class="me-3 mb-0">Lọc:</label>
                    <input type="text" value="{{ request('query') }}" class="form-control" id="query" name="query"
                        style="min-width: 200px;" name="search" placeholder="">
                </form>
            </div>
        </div>

        <div class="card-body">
            <table class="table ">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên Đạo diễn</th>
                        <th scope="col">Anh Đạo diễn</th>
                        <th scope="col">Năm sinh</th>
                        <th scope="col">Quốc tịch</th>
                        <th scope="col">Gioi Tính</th>
                        <th scope="col">Trạng Thái</th>
                        <th scope="col">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($daoDiens as $index => $daoDien)
                        <tr>
                            <td>{{ $daoDien->id }}</td>
                            <td>{{ $daoDien->ten_dao_dien }}</td>
                            <td>
                                @if ($daoDien->anh_dao_dien)
                                    <img src="{{ asset('storage/' . $daoDien->anh_dao_dien) }}" alt="Ảnh banner"
                                        width="100">
                                @else
                                    Không có ảnh
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($daoDien->nam_sinh)->format('Y-m-d') }}</td>
                            <td>{{ $daoDien->quoc_tich }}</td>
                            <td>{{ $daoDien->gioi_tinh }}</td>
                            <td class="text-center">
                                @if ($daoDien->trang_thai == 1)
                                    <span class="text-success">* Hoạt động</span>
                                @else
                                    <span class="text-danger">x Không hoạt động</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <form method="POST" action="{{ route('nhanvien.daoDien.softDelete', $daoDien->id) }}"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa mục này không?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            Xóa
                                        </button>
                                    </form>
                                    <a class="btn btn-warning" href="{{ route('nhanviendaoDien.edit', $daoDien->id) }}">
                                        Sửa
                                    </a>
                                    <a class="btn btn-info" href="{{ route('nhanviendaoDien.show', $daoDien->id) }}">Xem</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
