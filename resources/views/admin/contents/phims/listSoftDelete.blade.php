@extends('admin.index')

@section('content')
   <div class="card m-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div class="card-title">Danh sách xóa mềm</div>
            </div>
        </div>
        <div class="card-body">
            @if ($phims->count())
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên Rạp</th>
                            <th scope="col">Anh Phim</th>
                            <th class="text-center" scope="col">Thòi Gian Xóa</th>
                            <th class="text-center" scope="col">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($phims as $index => $phim)
                            <tr>
                                <td>{{ $loop->index }}</td>
                                <td>{{ $phim->ten_phim }}</td>
                                <td>
                                    @if ($phim->anh_phim)
                                        <img src="{{ asset('storage/' . $phim->anh_phim) }}" alt="Ảnh phim" width="100">
                                    @else
                                        Không có ảnh
                                    @endif
                                </td>
                                <td class="text-center">{{ $phim->deleted_at }}</td>
                                <td class="text-center">
                                    <form action="{{ route('phim.restore', $phim->id) }}" method="POST" style="display:inline-block;">
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
                <p class="text-center">Không có dữ liệu.</p>
            @endif
        </div>
        <div class="d-flex justify-content-end">
            {{ $phims->links() }}
        </div>
    </div>
@endsection