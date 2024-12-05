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
                    <a href="#">Bài viết tin tức</a>
                </li>
            </ul>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Thêm bài viết tin tức</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('bai-viet-tin-tuc.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="tieu_de">Tên đề</label>
                        <input type="text" name="tieu_de" class="form-control" id="tieu_de"
                            placeholder="Nhập tên danh mục" value="{{ old('tieu_de') }}" />
                        @error('tieu_de')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="noi_dung">Nội dung bài viết</label>
                        <textarea name="noi_dung" class="form-control" id="noi_dung" rows="5" placeholder="Nhập nội dung bài viết">{{ old('noi_dung') }}</textarea>
                        @error('noi_dung')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tom_tat">Tóm tắt</label>
                        <textarea name="tom_tat" class="form-control" id="tom_tat" placeholder="Nhập tóm tắt" rows="3">{{ old('tom_tat') }}</textarea>
                        @error('tom_tat')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="hinh_anh">Hình ảnh</label>
                        <input type="file" name="hinh_anh" class="form-control" id="hinh_anh" />
                        @error('hinh_anh')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="ngay_dang">Ngày đăng</label>
                        <input type="date" name="ngay_dang" class="form-control" id="ngay_dang"
                            value="{{ old('ngay_dang') }}" />
                        @error('ngay_dang')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="danh_muc_bai_viet_tin_tuc_id">Danh mục bài viết</label>
                        <select name="danh_muc_bai_viet_tin_tuc_id" class="form-control" id="danh_muc_bai_viet_tin_tuc_id">
                            <option value="">-- Chọn danh mục --</option>
                            @foreach ($danhmuc as $dm)
                                <option value="{{ $dm->id }}"
                                    {{ old('danh_muc_bai_viet_tin_tuc_id') == $dm->id ? 'selected' : '' }}>
                                    {{ $dm->ten_danh_muc }}
                                </option>
                            @endforeach
                        </select>
                        @error('danh_muc_bai_viet_tin_tuc_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="{{ route('bai-viet-tin-tuc.index') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <!-- <script>
        ClassicEditor
            .create(document.querySelector('#noi_dung'), {
                ckfinder: {
                    uploadUrl: '?_token= }}'
                }
            })
            .catch(
                error => {
                    console.error(error);
                }
            )
    </script> -->
@endsection
