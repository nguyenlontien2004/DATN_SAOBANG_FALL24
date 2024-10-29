@extends('admin.index')

@section('content')
    <div class="card container mt-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="card-title">Danh sách Suất Chiếu</div>
            <a href="{{ route('suatChieu.create') }}" class="btn btn-primary">Thêm mới Suất Chiếu</a>
        </div>

        <div class="card-body">
            <table class="table table-head-bg-success">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên Suất Chiếu</th>
                        <th scope="col">Thời Gian Bắt Đầu</th>
                        <th scope="col">Phòng Chiếu</th>
                        <th scope="col">Phim</th>
                        <th scope="col">Trạng Thái</th>
                        <th scope="col">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($suatChieus as $index => $suatChieu)
                        <tr>
                            <td>{{ $suatChieu->id }}</td>
                            <td>Suất Chiếu {{ $suatChieu->gio_bat_dau }}</td>
                            <td>{{ $suatChieu->gio_bat_dau }}</td>
                            <td>{{ $suatChieu->phongChieu->ten_phong_chieu }}</td>
                            <td>{{ $suatChieu->phim->ten_phim }}</td>
                            <td class="text-center">
                                @if ($suatChieu->trang_thai == 1)
                                    <span class="text-success">* Hoạt động</span>
                                @else
                                    <span class="text-danger">x Không hoạt động</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <form method="POST" action="{{ route('suatChieu.destroy', $suatChieu->id) }}"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa mục này không?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash2" viewBox="0 0 16 16">
                                                <path
                                                    d="M14 3a.7.7 0 0 1-.037.225l-1.684 10.104A2 2 0 0 1 10.305 15H5.694a2 2 0 0 1-1.973-1.671L2.037 3.225A.7.7 0 0 1 2 3c0-1.105 2.686-2 6-2s6 .895 6 2M3.215 4.207l1.493 8.957a1 1 0 0 0 .986.836h4.612a1 1 0 0 0 .986-.836l1.493-8.957C11.69 4.689 9.954 5 8 5s-3.69-.311-4.785-.793" />
                                            </svg>
                                        </button>
                                    </form>
                                    <a class="btn btn-warning" href="{{ route('suatChieu.edit', $suatChieu->id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd"
                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
