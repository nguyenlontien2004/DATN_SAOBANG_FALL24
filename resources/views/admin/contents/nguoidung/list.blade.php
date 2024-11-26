@extends('admin.index')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Tables</h3>
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
                    <a href="#">Danh sách người dùng</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Danh sách người dùng</div>
                    <div class="thongbao text-center">
                        @if (session('success'))
                            <span class="text text-success font-weight-bold"
                                style="font-size: 1.2rem;">{{ session('success') }}</span>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Họ tên</th>
                                <th scope="col">Email</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Mật khẩu</th>
                                <th scope="col">Ngày đăng ký</th>
                                <th scope="col">Vai trò</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nguoidung as $index => $nd)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $nd->ho_ten }}</td>
                                    <td>{{ $nd->email }}</td>
                                    <td>{{ $nd->so_dien_thoai }}</td>
                                    <td>
                                        @if ($nd->hinh_anh)
                                            <img src="{{ asset('storage/' . $nd->hinh_anh) }}" alt="Hình ảnh" width="50"
                                                height="50">
                                        @else
                                            Không có hình ảnh
                                        @endif
                                    </td>
                                    <td>{{ $nd->mat_khau }}</td>
                                    <td>{{ $nd->created_at }}</td>
                                    <td>
                                        @if ($nd->vaiTros->isNotEmpty())
                                            @foreach ($nd->vaiTros as $vt)
                                                {{ $vt->ten_vai_tro }}
                                            @endforeach
                                        @else
                                            Không có vai trò
                                        @endif
                                    </td>
                                    <td>
                                        @if ($nd->deleted_at)
                                            Không hoạt động
                                        @else
                                            Hoạt động
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        @if ($nd->trashed())
                                            <div class="btn-group" role="group" aria-label="Hành động">
                                                {{-- Nút khôi phục --}}
                                                <form action="{{ route('nguoi-dung.restore', $nd->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm me-1"
                                                        onclick="return confirm('Bạn có muốn khôi phục?')">Khôi
                                                        Phục</button>
                                                </form>
                                                {{-- Nút xóa vĩnh viễn --}}
                                                <form action="{{ route('nguoi-dung.forceDelete', $nd->id) }}"
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
                                                <a href="{{ route('nguoi-dung.show', $nd->id) }}"
                                                    class="btn btn-info btn-sm me-1">Show</a>
                                                <!-- Nút chỉnh sửa -->
                                                <a href="{{ route('nguoi-dung.edit', $nd->id) }}"
                                                    class="btn btn-warning btn-sm me-1">Edit</a>
                                                {{-- Nút Ẩn (Xóa mềm) --}}
                                                <form action="{{ route('nguoi-dung.destroy', $nd->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Bạn có chắc chắn ẩn người dùng tin tức?')">Ẩn</button>
                                                </form>
                                            </div>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $nguoidung->links() }}
            </div>
        </div>
    </div>
@endsection
