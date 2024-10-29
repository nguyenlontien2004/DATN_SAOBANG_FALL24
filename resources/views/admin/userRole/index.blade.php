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
                    <a href="#">Danh sách vai trò người dùng</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4 class="card-title">Danh sách vai trò người dùng</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Ảnh</th>
                                        <th>Người dùng</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Vai trò</th>
                                        <th>Điều chỉnh vai trò</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roleAndUser as $item)
                                        <tr>
                                            <td>#{{ $loop->index + 1 }}</td>
                                            <td><img width="45px" height="45px"
                                                    src="https://i.pinimg.com/1200x/bc/43/98/bc439871417621836a0eeea768d60944.jpg"
                                                    alt=""></td>
                                            <td>{{ $item->user->ho_ten }}</td>
                                            <td>{{ $item->user->email }}</td>
                                            <td>{{ $item->user->so_dien_thoai }}</td>
                                            <td>{{ $item->role->ten_vai_tro }}</td>
                                            <td>
                                                <div class="form-button-action d-flex justify-content-center">
                                                    <button type="button" class="btn btn-link btn-primary btn-lg p-0"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Cập nhât vai trò">
                                                        <a
                                                            href="{{ route('admin.roleAndUser.edit', $item->nguoi_dung_id) }}">
                                                            <i class="fa fa-edit"></i></a>
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
