@extends('admin.index')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('admin.phongChieu') }}">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Danh sách phòng chiếu</a>
                </li>
            </ul>
        </div>

        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h4 class="card-title">Danh sách phòng chiếu</h4>
                <span class="px-2">/</span>
                <a href="{{ route('admin.themphongChieu') }}">Thêm phòng chiếu</a>
                <span class="px-2">/</span>
                <a href="{{ route('admin.listSoftDeletehongChieu') }}">Các mục đã xoá mềm</a>
            </div>
            <div class="card-body">
            @if (session('error'))
                    <div class="alert alert-warning">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Phòng chiếu</th>
                                <th>Thuộc rạp chiếu</th>
                                <th>Trạng thái</th>
                                <th>Hoạt động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $item)
                                <tr>
                                    <td>{{ $item->ten_phong_chieu }}</td>
                                    <td>{{ $item->rap->ten_rap }}</td>
                                    <td>{{ !$item->trang_thai ? 'Tạm ngừng hoạt động' : 'Đang hoạt động' }}
                                    </td>
                                    <td>
                                        <div class="form-button-action d-flex justify-content-center">
                                            <button type="button" class="btn btn-link btn-primary btn-lg p-0"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Sửa">
                                                <a href="{{ route('admin.editphongChieu', $item->id) }}">
                                                    <i class="fa fa-edit"></i></a>
                                            </button>
                                            <button type="button" class="btn btn-link btn-danger btn-lg"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Xoá">
                                                <a onclick="return confirm('Bạn có chắc muốn xoá phòng này ra khỏi rạp {{ $item->rap->ten_rap }} không!')"
                                                    class="text-danger"
                                                    href="{{ route('admin.softDeletehongChieu', $item->id) }}">
                                                    <i class="fa fa-times"></i></a>

                                            </button>
                                            <button type="button" class="btn btn-link btn-danger btn-lg p-0"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Quản lý ghê">
                                                <a href="{{ route('admin.quanLyGhecuaphong', $item->id) }}"
                                                    class="text-warning">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="lucide lucide-armchair">
                                                        <path d="M19 9V6a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v3" />
                                                        <path
                                                            d="M3 16a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-5a2 2 0 0 0-4 0v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V11a2 2 0 0 0-4 0z" />
                                                        <path d="M5 18v2" />
                                                        <path d="M19 18v2" />
                                                    </svg>
                                                </a>
                                            </button>

                                        </div>

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#basic-datatables").DataTable({});
        });
    </script>
@endsection
