@extends('nhanVien.index')

@section('title')
    {{ $title }}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="content">

                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-18 fw-semibold m-0">Quản lí đồ ăn</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h5 class="card-title align-content-center mb-0">{{ $title }}</h5>

                                <a href="{{ route('do-an.create') }}" class="btn btn-success"><i
                                        data-feather="plus-square"></i>Thêm món
                                    ăn</a>
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
                                                <th scope="col">#</th>
                                                <th scope="col">Tên món</th>
                                                <th scope="col">Giá</th>
                                                <th scope="col">Hình ảnh</th>
                                                <th scope="col">Mô tả</th>
                                                <th scope="col">Lượt mua</th>
                                                <th scope="col">Trạng thái</th>
                                                <th scope="col">Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($listDoAn as $index => $item)
                                                <tr>
                                                    <th scope="row">{{ $index + 1 }}</th>
                                                    <td>{{ $item->ten_do_an }}</td>
                                                    <td>{{ number_format($item->gia, 0, ',', '.') }} VND</td>
                                                    <td><img src="{{ Storage::url($item->hinh_anh) }}" alt="Ảnh đồ ăn"
                                                            width="100px" height="50"></td>
                                                    <td>{{ $item->mo_ta }}</td>
                                                    <td>{{ $item->luot_mua }}</td>
                                                    <td
                                                        class="{{ $item->trang_thai == true ? 'text-success' : 'text-danger' }}">
                                                        {{ $item->trang_thai == true ? 'Hiển thị' : 'Ẩn' }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('do-an.edit', $item->id) }}">Sửa</a>

                                                        <form action="{{ route('do-an.destroy', $item->id) }}"
                                                            method="post" class="d-inline"
                                                            onsubmit="return confirm('Bạn có chắc chắn không?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="border-0 bg-white">
                                                                Xóa
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                    {{ $listDoAn->links('pagination::bootstrap-5') }}
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
