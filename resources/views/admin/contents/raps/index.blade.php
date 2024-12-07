@extends('admin.index')

@section('content')
    <div class="card m-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div class="card-title">Danh sách rạp chiếu</div>
                <span class="px-2">/</span>
                <a href="{{ route('rap.create') }}">Thêm mới rạp chiếu</a>
                <span class="px-2">/</span>
            </div>
            <div>
                <form action="{{ route('rap.index') }}" method="GET" class="form-inline d-flex align-items-center">
                    <label for="search" class="me-3 mb-0">Lọc:</label>
                    <input type="text"  value="{{ request('query') }}" class="form-control" id="query" name="query"
                        placeholder="">
                </form>
            </div>
        </div>
        <div class="card-body">
            @if ($raps->count())
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên Rạp</th>
                            <th scope="col">Địa Điểm</th>
                            <th scope="col">Trạng Thái</th>
                            <th scope="col">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($raps as $index => $rap)
                            <tr>
                                <td>{{ $rap->id }}</td>
                                <td>{{ $rap->ten_rap }}</td>
                                <td>{{ $rap->dia_diem }}</td>
                                <td class="text-center">
                                    @if ($rap->trang_thai == 1)
                                        <span class="text-success">* Hoạt động</span>
                                    @else
                                        <span class="text-danger">x Không hoạt động</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-warning btn-sm"
                                        href="{{ route('rap.edit', $rap->id) }}">
                                        Sửa
                                    </a>
                                    <a class="btn btn-info btn-sm"
                                        href="{{ route('rap.show', $rap->id) }}">
                                        xem
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center">Không có dữ liệu.</p>
            @endif
        </div>
        <div class="d-flex justify-content-end">
            {{ $raps->links() }}
        </div>
    </div>
@endsection
