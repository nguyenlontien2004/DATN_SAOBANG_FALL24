@extends('admin.index')

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
                    <a href="#">Danh sách vai trò</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4 class="card-title">Danh sách vai trò</h4>
                        <span class="px-2">/</span>
                        <a href="{{ route('admin.role.create') }}">Thêm vai trò</a>
                        <span class="px-2">/</span>
                        <a href="{{ route('admin.role.listRoleSoft') }}">Vai trò đã ẩn</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên vai trò</th>
                                        <th>Hoạt động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($role as $item)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $item->ten_vai_tro }}</td>
                                            <td>
                                                <div class="form-button-action d-flex justify-content-center">
                                                    <button type="button" class="btn btn-link btn-primary btn-lg p-0"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Sửa">
                                                        <a href="{{ route('admin.role.edit', $item->id) }}"> <i
                                                                class="fa fa-edit"></i></a>
                                                    </button>
                                                    <button type="button" class="btn btn-link btn-danger btn-lg"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Xoá">
                                                        <a onclick="return confirm('Bạn có chắc muốn xoá không!')"
                                                            class="text-danger"
                                                            href="{{ route('admin.role.delete', $item->id) }}">
                                                            <i class="fa fa-times"></i></a>

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
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#basic-datatables").DataTable({});
        });
    </script>
@endsection
