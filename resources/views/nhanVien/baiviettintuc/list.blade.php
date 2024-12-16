@extends('nhanVien.index')

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
                    <a href="#">Danh sách bài viết tin tức</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title">Danh sách bài viết tin tức</div>
                    <a href="{{ route('bai-viet-tin-tuc-nv.create') }}" class="btn btn-primary">Thêm bài viết tin tức</a>
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
                                <th scope="col">Tiêu đề</th>
                                <th scope="col">Tóm tắt</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Lượt xem</th>
                                <th scope="col">Danh Mục</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($baiviet as $index => $bv)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $bv->tieu_de }}</td>
                                    <td>{{ $bv->tom_tat }}</td>
                                    <td>
                                        @if ($bv->hinh_anh)
                                            <img src="{{ asset('storage/' . $bv->hinh_anh) }}" alt="Hình ảnh" width="50"
                                                height="50">
                                        @else
                                            Không có
                                        @endif
                                    </td>
                                    <td>{{ $bv->luot_xem }}</td>
                                    <td>{{ $bv->danhMuc->ten_danh_muc ?? 'Không có danh mục' }}</td>

                                    <td>
                                        @if ($bv->deleted_at)
                                            Không hoạt động
                                        @else
                                            Hoạt động
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        @if ($bv->trashed())
                                            <div class="btn-group" role="group" aria-label="Hành động">
                                                {{-- Nút khôi phục --}}
                                                <form action="{{ route('nhanvien.bai-viet-tin-tuc.restore', $bv->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm me-1"
                                                        onclick="return confirm('Bạn có muốn khôi phục?')">Khôi
                                                        Phục</button>
                                                </form>
                                                {{-- Nút xóa vĩnh viễn --}}
                                                <form action="{{ route('nhanvien.bai-viet-tin-tuc.forDelete', $bv->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Bạn có muốn xóa?')">Xóa</button>
                                                </form>
                                            </div>
                                        @else
                                            <div class="btn-group" role="group" aria-label="Hành động">
                                                <!-- Nút show -->
                                                <a href="{{ route('bai-viet-tin-tuc-nv.show', $bv->id) }}"
                                                    class="btn btn-info btn-sm me-1">Chi tiết</a>
                                                <!-- Nút chỉnh sửa -->
                                                <a href="{{ route('bai-viet-tin-tuc-nv.edit', $bv->id) }}"
                                                    class="btn btn-warning btn-sm me-1">Sửa</a>
                                                {{-- Nút Ẩn (Xóa mềm) --}}
                                                <form action="{{ route('bai-viet-tin-tuc-nv.destroy', $bv->id) }}"
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
                {{ $baiviet->links() }}
            </div>
        </div>
    </div>
@endsection
