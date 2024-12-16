@extends('admin.index')

@section('content')
    <div class="card m-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="card-title">Danh sách Thể loại phim đã xóa mềm</div>
        </div>

        <div class="card-body">
            @if ($theLoaiPhims->count())
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên Thể loại</th>
                            <th scope="col" class="text-center">Ngày xóa</th>
                            <th scope="col" class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($theLoaiPhims as $theLoai)
                            <tr>
                                <td>{{ $theLoai->id }}</td>
                                <td>{{ $theLoai->ten_the_loai }}</td>
                                <td class="text-center">{{ $theLoai->deleted_at }}</td>
                                <td class="text-center">
                                    <form action="{{ route('theLoaiPhim.restore', $theLoai->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-success btn-sm">Khôi phục</button>
                                    </form>

                                    <form action="{{ route('theLoaiPhim.forceDelete', $theLoai->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn mục này không?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Xóa vĩnh viễn</button>
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