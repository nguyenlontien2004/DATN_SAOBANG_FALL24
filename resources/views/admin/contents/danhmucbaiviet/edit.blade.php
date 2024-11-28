@extends('admin.index')

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
                    <a href="#">Forms</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Chỉnh sửa danh mục</a>
                </li>
            </ul>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('danh-muc-bai-viet-tin-tuc.update', $danhMucBaiVietTinTuc->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="ten_danh_muc">Tên danh mục</label>
                        <input type="ten_danh_muc" class="form-control" name="ten_danh_muc" id="ten_danh_muc"
                            value="{{ $danhMucBaiVietTinTuc->ten_danh_muc }}" required />
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Cập nhật</button>
                            <a href="{{ route('danh-muc-bai-viet-tin-tuc.index') }}" class="btn btn-danger">Quay lại</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
