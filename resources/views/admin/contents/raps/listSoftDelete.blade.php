@extends('admin.index')

@section('content')
    <div class="card m-5">
        {{-- <div class="card-header d-flex justify-content-between align-items-center">
            <div class="card-title">Danh sách Rạp</div>
            <a href="{{ route('rap.create') }}" class="btn btn-primary">Thêm mới Rạp</a>
        </div> --}}
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div class="card-title">Danh sách xóa mềm</div>
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
                            <th class="text-center" scope="col">Thòi Gian Xóa</th>
                            <th class="text-center" scope="col">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($raps as $index => $rap)
                            <tr>
                                <td>{{ $rap->id }}</td>
                                <td>{{ $rap->ten_rap }}</td>
                                <td>{{ $rap->dia_diem }}</td>
                                <td class="text-center">{{ $rap->deleted_at }}</td>
                                <td class="text-center">
                                    <form action="{{ route('rap.restore', $rap->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-success btn-sm">Khôi phục</button>
                                    </form>

                                    <form action="{{ route('rap.forceDelete', $rap->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn mục này không?');">
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
                <p class="text-center">Không có dữ liệu.</p>
            @endif
        </div>
        <div class="d-flex justify-content-end">
            {{ $raps->links() }}
        </div>
    </div>
@endsection
