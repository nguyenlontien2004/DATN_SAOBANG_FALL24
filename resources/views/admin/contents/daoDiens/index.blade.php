@extends('admin.index')

@section('content')
    <div class="card m-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div class="card-title">Danh sách Đạo diễn</div>
                <span class="px-2">/</span>
                <a href="{{ route('daoDien.create') }}">Thêm mới Đạo diễn</a>
                <span class="px-2">/</span>
                {{-- <a href="{{ route('daodien.listSoftDelete') }}">Các mục đã xoá mềm</a> --}}
                <a href="{{ url('/admin/daoDien/listSoftDelete') }}">Các mục đã xoá mềm</a>
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
            <div class="d-flex justify-content-end">
                {{ $daoDiens->links() }}
            </div>
            @if ($daoDiens->count())
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
                                        {{-- <form method="POST" action="{{ route('daoDien.destroy', $daoDien->id) }}"
                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa mục này không?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                Xóa
                                            </button>
                                        </form> --}}
                                        {{-- <form action="{{ route('daodien.softDelete', $daoDien->id) }}" method="POST"
                                            style="display:inline-block;"
                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa mục này không?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Xóa </button>
                                        </form> --}}
                                        <a class="btn btn-warning" href="{{ route('daoDien.edit', $daoDien->id) }}">
                                            Sửa
                                        </a>
                                        <a class="btn btn-info" href="{{ route('daoDien.show', $daoDien->id) }}">Xem</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center">Không tìm thấy kết quả phù hợp.</p>
            @endif

        </div>
    </div>
@endsection
