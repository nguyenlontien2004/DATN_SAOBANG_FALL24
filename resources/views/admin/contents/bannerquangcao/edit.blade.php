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
                    <a href="#">Thông tin banner quảng cáo</a>
                </li>
            </ul>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Chỉnh sửa banner quảng cáo</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('banner-quang-cao.update', $bannerQuangCao->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="vi_tri">Vị trí</label>
                        <input type="vi_tri" name="vi_tri" class="form-control" id="vi_tri"
                            value="{{ $bannerQuangCao->vi_tri }}" required />
                    </div>

                    <div class="form-group">
                        <label for="mo_ta">Mô tả</label>
                        <input type="mo_ta" name="mo_ta" class="form-control" id="mo_ta"
                            value="{{ $bannerQuangCao->mo_ta }}" required />
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="{{ route('banner-quang-cao.index') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
