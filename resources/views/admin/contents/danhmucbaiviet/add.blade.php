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
                    <a href="#">Danh mục bài viết tin tức</a>
                </li>
            </ul>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Thêm danh mục bài viết tin tức</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('danh-muc-bai-viet-tin-tuc.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="ten_danh_muc">Tên danh mục</label>
                        <input type="ten_danh_muc" name="ten_danh_muc" value="{{ old('ten_danh_muc') }}"
                            class="form-control" id="ten_danh_muc" placeholder="Nhập tên danh mục" required />

                        @error('ten_danh_muc')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <a href="{{ route('danh-muc-bai-viet-tin-tuc.index') }}" class="btn btn-danger">Cancel</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
