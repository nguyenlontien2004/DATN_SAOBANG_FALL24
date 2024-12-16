
@extends('nhanVien.index')

@section('content')
    <div class="card m-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="card-title">Danh sách Đạo diễn đã xóa mềm</div>
        </div>

        <div class="card-body">
            @if ($dienViens->count())
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Diễn Viên</th>
                            <th scope="col" class="text-center">Ngày xóa</th>
                            <th scope="col" class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dienViens as $dienVien)
                            <tr>
                                <td>{{ $dienVien->id }}</td>
                                <td><div class="d-flex">
                                <img src="{{ asset('storage/' . $dienVien->anh_dien_vien) }}" alt="Ảnh banner" width="100">
                                    <p class="ps-3">{{ $dienVien->ten_dien_vien }}</p>
                                </div></td>
                                <td class="text-center">{{ $dienVien->deleted_at }}</td>
                                <td class="text-center">
                                    <form action="{{ route('nhanvien.dienVien.restore', $dienVien->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-success btn-sm">Khôi phục</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center">Không có dữ liệu xóa mềm.</p>
            @endif
        </div>
    </div>
@endsection
