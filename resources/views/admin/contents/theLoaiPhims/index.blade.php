@extends('admin.index')

@section('content')
    <div class="card m-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div class="card-title">Danh sách Thể loại phim</div>
                <span class="px-2">/</span>
                <a href="{{ route('theLoaiPhim.create') }}">Thêm mới Thể loại phim</a>
                <span class="px-2">/</span>
                <a href="{{ route('theLoaiPhim.listSoftDelete') }}">Các mục đã xoá mềm</a>
            </div>
            <div>
                <form class="form-inline d-flex align-items-center" action="{{ route('theLoaiPhim.index') }}" method="GET">
                    <label for="search" class="me-3 mb-0">Lọc:</label>
                    <input type="text" class="form-control" value="{{ request('query') }}" id="query"
                        style="min-width: 200px;" name="query" placeholder="">
                </form>
            </div>
        </div>

        <div class="card-body">
            @if ($theLoaiPhims->count())
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 10%;">#</th>
                            <th scope="col" style="width: 40%;">Tên Thể loại</th>
                            <th scope="col" style="width: 25%;" class="text-center">Trạng Thái</th>
                            <th scope="col" style="width: 25%;" class="text-center">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($theLoaiPhims as $index => $theLoai)
                            <tr>
                                <td>{{ $theLoai->id }}</td>
                                <td>{{ $theLoai->ten_the_loai }}</td>
                                <td class="text-center">
                                    @if ($theLoai->trang_thai == 1)
                                        <span class="text-success">* Hoạt động</span>
                                    @else
                                        <span class="text-danger">x Không hoạt động</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center">
                                        <form action="{{ route('theLoaiPhim.softDelete', $theLoai->id) }}" method="POST"
                                            style="display:inline-block;"
                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa mục này không?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Xóa </button>
                                        </form>
                                        <a class="btn btn-warning btn-sm"
                                            href="{{ route('theLoaiPhim.edit', $theLoai->id) }}">
                                            Sửa
                                        </a>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center">Không có dữ liệu.</p>
            @endif

        </div>
    </div>
@endsection
