@extends('admin.index')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="#">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Tables</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Danh sách mã giảm giá</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title">Danh sách mã giảm giá</div>
                    <a href="{{ route('ma_giam_gia.create') }}" class="btn btn-primary">Thêm mã giảm giá</a>
                </div>
                <div class="thongbao text-center">
                    @if (session('success'))
                        <span class="alert alert-success font-weight-bold"
                            style="font-size: 1.2rem;">{{ session('success') }}</span>
                    @endif
                </div>

                <div class="card-body">
                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Mã giảm giá</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Giá trị giảm</th>
                                <th scope="col">Ngày bắt đầu</th>
                                <th scope="col">Ngày kết thúc</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($magiamgia as $index => $mgg)
                                <tr>
                                    <td>{{ $mgg->id }}</td>
                                    <td>{{ $mgg->ma_giam_gia }}</td>
                                    <td>{{ $mgg->so_luong }}</td>
                                    <td>{{ $mgg->gia_tri_giam }} %</td>
                                    <td>{{ $mgg->ngay_bat_dau }}</td>
                                    <td>{{ $mgg->ngay_ket_thuc }}</td>
                                    <td>
                                        @if ($mgg->deleted_at)
                                            Không hoạt động
                                        @else
                                            Hoạt động
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="btn-group" role="group" aria-label="Hành động">
                                            @if ($mgg->trashed())
                                                <!-- Nút Khôi phục -->
                                                <form action="{{ route('ma_giam_gia.restore', ['id' => $mgg->id]) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm me-1"
                                                        onclick="return confirm('Bạn có muốn khôi phục?')">Khôi
                                                        phục</button>
                                                </form>

                                                <!-- Nút Xóa vĩnh viễn -->
                                                <form action="{{ route('ma_giam_gia.forceDelete', ['id' => $mgg->id]) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn?')">Xóa</button>
                                                </form>
                                            @else
                                                {{-- Nút show --}}
                                                <a href="{{ route('ma_giam_gia.show', ['ma_giam_gium' => $mgg->id]) }}"
                                                    class="btn btn-info btn-sm me-1">Chi tiết</a>

                                                <!-- Nút Chỉnh sửa -->
                                                <a href="{{ route('ma_giam_gia.edit', ['ma_giam_gium' => $mgg->id]) }}"
                                                    class="btn btn-warning btn-sm me-1">Sửa</a>

                                                <!-- Nút Ẩn (Xóa mềm) -->
                                                <form
                                                    action="{{ route('ma_giam_gia.destroy', ['ma_giam_gium' => $mgg->id]) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Bạn có chắc chắn ẩn bài viết tin tức?')">Ẩn</button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- {{ $magiamgia->links() }} --}}
            </div>
        </div>
    </div>
@endsection
