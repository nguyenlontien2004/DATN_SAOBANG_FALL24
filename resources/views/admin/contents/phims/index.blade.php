@extends('admin.index')

@section('content')
    <div class="card m-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div class="card-title">Danh sách Phim</div>
                <span class="px-2">/</span>
                <a href="{{ route('phim.create') }}">Thêm mới Phim</a>
                <span class="px-2">/</span>
                <a href="{{ route('phim.listSoftDelete') }}">Các mục đã xoá mềm</a>
            </div>
            <div>
                <form action="{{ route('phim.index') }}" method="GET" class="form-inline d-flex align-items-center">
                    <label for="search" class="me-3 mb-0">Search:</label>
                    <input type="text" value="{{ request('query') }}" class="form-control" id="query" name="query"
                        style="min-width: 200px;" name="search" placeholder="">
                </form>
            </div>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('phim.index') }}" id="filterForm" class="mb-4">
                <div class="row">
                    <div class="col-md-4 d-flex align-items-center">
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
            @if ($phims->count())
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên Phim</th>
                            <th scope="col">Ảnh Phim</th>
                            <th class="text-center" scope="col">Hành Động</th>
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
                                {{-- <td>
                                    @foreach ($phim->theLoaiPhims as $theLoaiPhim)
                                        {{ $theLoaiPhim->ten_the_loai }}@if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </td> --}}
                                <td class="text-center">
                                    {{-- <div class="d-flex justify-content-center">
                                        <form method="POST" action="{{ route('phim.destroy', $phim->id) }}"
                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa mục này không?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Xóa</button>
                                        </form>
                                        <a class="btn btn-warning" href="{{ route('phim.edit', $phim->id) }}">Sửa</a>
                                        <a class="btn btn-info" href="{{ route('phim.show', $phim->id) }}">Xem</a>
                                    </div> --}}
                                    <form action="{{ route('phim.softDelete', $phim->id) }}" method="POST"
                                        style="display:inline-block;"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa mục này không?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Xóa </button>
                                    </form>
                                    <a class="btn btn-warning btn-sm" href="{{ route('phim.edit', $phim->id) }}">
                                        Sửa
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">Không có phim nào phù hợp với điều kiện lọc.</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            @else
                <p class="text-center">Không có dữ liệu.</p>
            @endif
        </div>
        <div class="d-flex justify-content-end">
            {{ $phims->links() }}
        </div>
    </div>
@endsection
