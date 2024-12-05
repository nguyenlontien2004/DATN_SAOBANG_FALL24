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
                    <a href="#">Danh sách ảnh banner quảng cáo</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title">Danh sách ảnh banner quảng cáo</div>
                    <div class="thongbao text-center">
                        @if (session('success'))
                            <span class="alert alert-success font-weight-bold"
                                style="font-size: 1.2rem;">{{ session('success') }}</span>
                        @endif
                    </div>
                    <a href="{{ route('anh-banner-quang-cao.create') }}" class="btn btn-primary">Thêm ảnh banner quảng
                        cáo</a>
                </div>
                <div class="card-body">
                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Vị Trí</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Thứ tự</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($anhbanner as $index => $abn)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $abn->banner->vi_tri }}</td>
                                    <td>
                                        @if ($abn->hinh_anh)
                                            <img src="{{ asset('storage/' . $abn->hinh_anh) }}" alt="Ảnh banner"
                                                width="100">
                                        @else
                                            Không có ảnh
                                        @endif
                                    </td>
                                    <td>{{ $abn->thu_tu }}</td>
                                    <td class="text-center align-middle">
                                        @if ($abn->trashed())
                                            <div class="btn-group" role="group" aria-label="Hành động">
                                                {{-- Nút khôi phục --}}
                                                <form action="{{ route('anh-banner-quang-cao.restore', $abn->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm me-1"
                                                        onclick="return confirm('Bạn có muốn khôi phục?')">Khôi
                                                        Phục</button>
                                                </form>
                                                {{-- Nút xóa vĩnh viễn --}}
                                                <form action="{{ route('anh-banner-quang-cao.forDelete', $abn->id) }}"
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
                                                <a href="{{ route('anh-banner-quang-cao.edit', $abn->id) }}"
                                                    class="btn btn-warning btn-sm me-1">Edit</a>
                                                {{-- Nút Ẩn (Xóa mềm) --}}
                                                <form action="{{ route('anh-banner-quang-cao.destroy', $abn->id) }}"
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
