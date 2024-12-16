@extends('nhanVien.index')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="#">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#"></a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Danh sách danh mục bài viết tin tức</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title">Danh sách danh mục bài viết tin tức</div>
                    <a href="{{ route('danh-muc-bai-viet-tin-tuc-nv.create') }}" class="btn btn-primary">Thêm danh mục bài viết
                        tin tức</a>
                </div>
                <div class="thongbao text-center">
                    @if (session('success'))
                        <span class="alert alert-success font-weight-bold"
                            style="font-size: 1.2rem;">{{ session('success') }}</span>
                    @endif
                </div>
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên danh Mục</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($danhmuc as $index => $dm)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $dm->ten_danh_muc }}</td>
                                <td>
                                    @if ($dm->deleted_at)
                                        Không hoạt động
                                    @else
                                        Hoạt động
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    @if ($dm->trashed())
                                        <div class="btn-group" role="group" aria-label="Hành động">
                                            {{-- Nút khôi phục --}}
                                            <form action="{{ route('nhanvien.danh-muc-bai-viet-tin-tuc.restore', $dm->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm me-1"
                                                    onclick="return confirm('Bạn có muốn khôi phục?')">Khôi
                                                    Phục</button>
                                            </form>
                                            {{-- Nút xóa vĩnh viễn --}}
                                            <form action="{{ route('nhanvien.danh-muc-bai-viet-tin-tuc.forDelete', $dm->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Bạn có muốn xóa?')">Xóa</button>
                                            </form>
                                        </div>
                                    @else
                                        <div class="btn-group" role="group" aria-label="Hành động">

                                            <!-- Nút chỉnh sửa -->
                                            <a href="{{ route('danh-muc-bai-viet-tin-tuc-nv.edit', $dm->id) }}"
                                                class="btn btn-warning btn-sm me-1">Sửa</a>
                                            {{-- Nút Ẩn (Xóa mềm) --}}
                                            <form action="{{ route('danh-muc-bai-viet-tin-tuc-nv.destroy', $dm->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Bạn có chắc chắn ẩn bài viết tin tức?')">Ẩn</button>
                                            </form>
                                        </div>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
