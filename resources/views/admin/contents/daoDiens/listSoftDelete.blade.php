{{-- @extends('admin.index')

@section('content')
    <div class="card m-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="card-title">Danh sách Đạo diễn đã xóa mềm</div>
        </div>

        <div class="card-body">
            @if ($daoDiens->count())
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên Đạo diễn</th>
                            <th scope="col" class="text-center">Ngày xóa</th>
                            <th scope="col" class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($daoDiens as $daoDien)
                            <tr>
                                <td>{{ $daoDien->id }}</td>
                                <td>{{ $daoDien->ten_dao_dien }}</td>
                                <td class="text-center">{{ $daoDien->deleted_at }}</td>
                                <td class="text-center">
                                    <form action="{{ route('daoDien.restore', $daoDien->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-success btn-sm">Khôi phục</button>
                                    </form>

                                    <form action="{{ route('daoDien.forceDelete', $daoDien->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn mục này không?');">
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
@endsection --}}
<h1>adsodj</h1>