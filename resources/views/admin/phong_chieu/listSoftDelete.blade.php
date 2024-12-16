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
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4 class="card-title">Danh sách phòng chiếu ẩn</h4>

                </div>
                <div class="card-body">
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
                                        <td>{{ $item->trang_thai ? 'Chưa diễn ra' : 'Đang diễn ra' }}</td>
                                        <td>
                                            <div class="form-button-action d-flex justify-content-center">
                                                <button type="button" class="btn btn-link btn-primary btn-lg p-0"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Khôi phục">
                                                    <a href="{{ route('admin.restorePhongchieu', $item->id) }}">
                                                        <i class="fa fa-edit"></i></a>
                                                </button>
                                                <form action="{{ route('admin.forceDelete.phongchieu', $item->id) }}" method="POST"
                                                    style="display:inline-block;"
                                                    onsubmit="return confirm('Bạn có chắc muốn xoá phòng này ra khỏi rạp {{ $item->rap->ten_rap }} vĩnh viễn không!')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-link btn-danger btn-lg"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Xoá">
                                                        <a
                                                             class="text-danger">
                                                            <i class="fa fa-times"></i></a>

                                                    </button>
                                                </form>
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
    $(document).ready(function () {
        $("#basic-datatables").DataTable({});
    });
</script>
@endsection