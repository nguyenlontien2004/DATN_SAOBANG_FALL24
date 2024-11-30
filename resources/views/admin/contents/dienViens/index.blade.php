@extends('admin.index')

@section('content')
    <div class="card container mt-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="card-title">Danh sách Diễn Viên</div>
            <a href="{{ route('dienVien.create') }}" class="btn btn-primary">Thêm mới Diễn Viên</a>
        </div>
        <div class="card-body">
            <table class="table ">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên Diễn Viên</th>
                        <th scope="col">Anh Diễn Viên</th>
                        <th scope="col">Năm sinh</th>
                        <th scope="col">Quốc tịch</th>
                        <th scope="col">Gioi Tính</th>
                        <th scope="col">Trạng Thái</th>
                        <th scope="col">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dienViens as $index => $dienVien)
                        <tr>
                            <td>{{ $dienVien->id }}</td>
                            <td>{{ $dienVien->ten_dien_vien }}</td>
                            <td>
                                @if ($dienVien->anh_dien_vien)
                                    <img src="{{ asset('storage/' . $dienVien->anh_dien_vien) }}" alt="Ảnh banner"
                                        width="100">
                                @else
                                    Không có ảnh
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($dienVien->nam_sinh)->format('Y-m-d') }}</td>
                            <td>{{ $dienVien->quoc_tich }}</td>
                            <td>{{ $dienVien->gioi_tinh }}</td>
                            <td class="text-center">
                                @if ($dienVien->trang_thai == 1)
                                    <span class="text-success">* Hoạt động</span>
                                @else
                                    <span class="text-danger">x Không hoạt động</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <form method="POST" action="{{ route('dienVien.destroy', $dienVien->id) }}"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa mục này không?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            Xóa
                                        </button>
                                    </form>
                                    <a class="btn btn-warning" href="{{ route('dienVien.edit', $dienVien->id) }}">
                                        Sửa
                                    </a>
                                    <a class="btn btn-info" href="{{ route('dienVien.show', $dienVien->id) }}">Xem</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
