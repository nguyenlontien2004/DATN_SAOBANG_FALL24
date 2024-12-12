@extends('nhanVien.index')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="content">

                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-18 fw-semibold m-0">Danh sách vé chưa thanh toán</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                            </div><!-- end card header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    @if (session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    <table class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID Vé</th>
                                                <th scope="col">Người dùng</th>
                                                <th scope="col">Ngày thanh toán</th>
                                                <th scope="col">Trạng thái</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($ves as $ve)
                                                <tr>
                                                    <th scope="row">{{ $ve->id }}</th>
                                                    <td>{{ $ve->user->name ?? 'Không xác định' }}</td>
                                                    <td>{{ $ve->ngay_thanh_toan }}</td>
                                                    <td>
                                                        {{ $ve->trang_thai == 0 ? 'Chưa thanh toán' : 'Đã thanh toán' }}
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

                <!-- start row -->
            </div> <!-- content -->
        </div>
    </div>
@endsection