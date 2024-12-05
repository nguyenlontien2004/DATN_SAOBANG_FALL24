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
                    <a href="#">Ảnh banner Quảng Cáo</a>
                </li>
            </ul>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Sửa ảnh banner Quảng Cáo</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('anh-banner-quang-cao.update', $anhBannerQuangCao->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="thu_tu">Thứ tự</label>
                        <input type="thu_tu" name="thu_tu" value="{{ $anhBannerQuangCao->thu_tu }}" class="form-control" id="thu_tu" placeholder="Nhập thứ tự"
                            required />
                    </div>

                    <div class="form-group">
                        <label for="hinh_anh">Hình ảnh</label>
                        <input type="file" name="hinh_anh" class="form-control" id="hinh_anh" required />

                        <h5>Ảnh trước đó:</h5><br>
                        <img src="{{ asset('storage/' . $anhBannerQuangCao->hinh_anh) }}" width="100" alt="">
                        <br>
                    </div>

                    <div class="form-group">
                        <label for="banner_quang_cao_id">Vị trí banner quảng cáo </label>
                        <select name="banner_quang_cao_id" class="form-control" id="banner_quang_cao_id" required>
                            @foreach ($vitri as $vt)
                                <option @selected($anhBannerQuangCao->vitri == $vt->id) value="{{ $vt->id }}">{{ $vt->vi_tri }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Cập nhật</button>
                        <a href="{{ route('anh-banner-quang-cao.index') }}" class="btn btn-danger">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
