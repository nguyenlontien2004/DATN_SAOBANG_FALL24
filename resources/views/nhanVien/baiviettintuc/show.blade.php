@extends('nhanVien.index')

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
                    <a href="#">Bài viết tin tức</a>
                </li>
            </ul>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Chi tiết bài viết tin tức</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('bai-viet-tin-tuc.update', $baiVietTinTuc->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="tieu_de">Tên đề</label>
                        <input type="tieu_de" name="tieu_de" class="form-control" id="tieu_de"
                            value="{{ $baiVietTinTuc->tieu_de }}" required />
                    </div>

                    <div class="form-group">
                        <label for="noi_dung">Nội dung bài viết</label>
                        <textarea name="noi_dung" class="form-control" id="noi_dung" rows="5" required>{{ $baiVietTinTuc->noi_dung }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="tom_tat">Tóm tắt</label>
                        <textarea name="tom_tat" class="form-control" id="tom_tat" rows="3" required>{{ $baiVietTinTuc->tom_tat }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="hinh_anh">Hình ảnh</label>
                        <img src="{{ asset('storage/' . $baiVietTinTuc->hinh_anh) }}" width="100" alt=""> <br>
                    </div>

                    <div class="form-group">
                        <label for="ngay_dang">Ngày đăng</label>
                        <input type="date" name="ngay_dang" class="form-control" id="ngay_dang"
                            value="{{ $baiVietTinTuc->ngay_dang }}" required />
                    </div>

                    <div class="form-group">
                        <label for="danh_muc_id">Danh mục bài viết</label>
                        <select name="danh_muc_id" class="form-control" id="danh_muc_id" required>
                            @foreach ($danhmuc as $dm)
                                <option @selected($baiVietTinTuc->danhmuc_id == $dm->id) value="{{ $dm->id }}">{{ $dm->ten_danh_muc }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>
                <div class="card-footer">
                    <a href="{{ route('bai-viet-tin-tuc.index') }}" class="btn btn-danger">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
@endsection
