@extends('admin.index')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="">
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
                    <a href="#">Mã giảm giá</a>
                </li>
            </ul>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Chi tiết mã giảm giá</h4>
            </div>
            <div class="card-body">

                <form action="{{ route('ma_giam_gia.update', ['ma_giam_gium' => $maGiamGia->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="ten_ma_giam_gia">Tên mã giảm giá</label>
                        <input type="text" name="ten_ma_giam_gia" class="form-control" id="ten_ma_giam_gia"
                            value="{{ old('ten_ma_giam_gia', $maGiamGia->ten_ma_giam_gia) }}" required
                            aria-label="Tên mã giảm giá" />
                        @error('ten_ma_giam_gia')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="ma_giam_gia">Mã giảm giá</label>
                        <input type="text" name="ma_giam_gia" class="form-control" id="ma_giam_gia"
                            value="{{ old('ma_giam_gia', $maGiamGia->ma_giam_gia) }}" required aria-label="Mã giảm giá" />
                        @error('ma_giam_gia')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="so_luong">Số lượng</label>
                        <input type="number" name="so_luong" class="form-control" id="so_luong"
                            value="{{ old('so_luong', $maGiamGia->so_luong) }}" placeholder="Nhập số lượng" required
                            aria-label="Số lượng" />
                        @error('so_luong')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="mo_ta">Mô tả</label>
                        <textarea name="mo_ta" class="form-control" id="mo_ta" cols="30" rows="5"
                            placeholder="Nhập mô tả mã giảm giá" aria-label="Mô tả">{{ old('mo_ta', $maGiamGia->mo_ta) }}</textarea>
                        @error('mo_ta')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="ngay_bat_dau">Ngày bắt đầu</label>
                        <input type="date" name="ngay_bat_dau" class="form-control" id="ngay_bat_dau"
                            value="{{ old('ngay_bat_dau', $maGiamGia->ngay_bat_dau) }}" required
                            aria-label="Ngày bắt đầu" />
                        @error('ngay_bat_dau')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="ngay_ket_thuc">Ngày kết thúc</label>
                        <input type="date" name="ngay_ket_thuc" class="form-control" id="ngay_ket_thuc"
                            value="{{ old('ngay_ket_thuc', $maGiamGia->ngay_ket_thuc) }}" required
                            aria-label="Ngày kết thúc" />
                        @error('ngay_ket_thuc')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="gia_tri_giam">Giá trị giảm (%)</label>
                        <input type="number" name="gia_tri_giam" class="form-control" id="gia_tri_giam"
                            placeholder="Nhập giá trị giảm %" value="{{ old('gia_tri_giam', $maGiamGia->gia_tri_giam) }}"
                            required aria-label="Giá trị giảm" />
                        @error('gia_tri_giam')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="card-footer">

                        <a href="{{ route('ma_giam_gia.index') }}" class="btn btn-danger">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
