@extends('nhanVien.index')

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
                    <a href="#">Danh sách vị trí banner quảng cáo</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title">Danh sách vị trí banner quảng cáo</div>
                    <a href="{{ route('banner-quang-cao.create') }}" class="btn btn-primary">Thêm vị trí banner
                        quảng cáo</a>
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
                                <th scope="col">Vị trí</th>
                                <th scope="col">Mô tả</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($banner as $index => $bn)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $bn->vi_tri }}</td>
                                    <td>{{ $bn->mo_ta }}</td>
                                    <td>
                                        @if ($bn->deleted_at)
                                            Không hoạt động
                                        @else
                                            Hoạt động
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        @if ($bn->trashed())
                                            <div class="btn-group" role="group" aria-label="Hành động">
                                                {{-- Nút khôi phục --}}
                                                <form action="{{ route('banner-quang-cao.restore', $bn->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm me-1"
                                                        onclick="return confirm('Bạn có muốn khôi phục?')">Khôi
                                                        Phục</button>
                                                </form>
                                                {{-- Nút xóa vĩnh viễn --}}
                                                <form action="{{ route('banner-quang-cao.forDelete', $bn->id) }}"
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
                                                <a href="{{ route('banner-quang-cao.edit', $bn->id) }}"
                                                    class="btn btn-warning btn-sm me-1">Sửa</a>
                                                {{-- Nút Ẩn (Xóa mềm) --}}
                                                <form action="{{ route('banner-quang-cao.destroy', $bn->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Bạn có muốn ẩn chứ?')">Ẩn</button>
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
    </div>
@endsection
