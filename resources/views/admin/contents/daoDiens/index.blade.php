@extends('admin.index')

@section('content')
    <div class="card mt-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="card-title">Danh sách Đạo diễn</div>
            <a href="{{ route('daoDien.create') }}" class="btn btn-primary">Thêm mới Đạo diễn</a>
        </div>

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên Đạo diễn</th>
                        <th scope="col">Anh Đạo diễn</th>
                        <th scope="col">Năm sinh</th>
                        <th scope="col">Quốc tịch</th>
                        <th scope="col">Gioi Tính</th>
                        <th scope="col">Tiểu Sử</th>
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
                            <td>{{ $daoDien->tieu_su }}</td>
                            <td class="text-center">
                                @if ($daoDien->trang_thai == 1)
                                    <span class="text-success">* Hoạt động</span>
                                @else
                                    <span class="text-danger">x Không hoạt động</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <form method="POST" action="{{ route('daoDien.destroy', $daoDien->id) }}"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa mục này không?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            Xóa
                                        </button>
                                    </form>
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
        </div>
    </div>
@endsection
