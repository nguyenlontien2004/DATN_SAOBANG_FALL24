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
                <h4 class="card-title">Thêm banner quảng cáo</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('banner-quang-cao.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="vi_tri">Vị trí</label>
                        <input type="vi_tri" name="vi_tri" class="form-control" id="vi_tri" value="{{ old('vi_tri') }}"
                            placeholder="Nhập vị trí" />

                        @error('vi_tri')
                            <div class="text text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="mo_ta">Mô tả</label>
                        <input type="mo_ta" name="mo_ta" class="form-control" id="mo_ta"
                            value="{{ old('mo_ta') }} " placeholder="Nhập vị trí" />

                        @error('mo_ta')
                            <div class="text text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Thêm mới</button>
                        <a href="{{ route('banner-quang-cao.index') }}" class="btn btn-danger">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
