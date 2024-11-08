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
                    <a href="#">Mã giảm giá</a>
                </li>
            </ul>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Thêm mã giảm giá</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('ma_giam_gia.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="ten_ma_giam_gia">Tên mã giảm giá</label>
                        <input type="text" name="ten_ma_giam_gia" class="form-control" id="ten_ma_giam_gia"
                            placeholder="Nhập tên mã giảm giá" required />
                    </div>

                    <div class="form-group">
                        <label for="ma_giam_gia">Mã giảm giá</label>
                        <input type="text" name="ma_giam_gia" class="form-control" id="ma_giam_gia"
                            placeholder="Nhập mã giảm giá" required />
                    </div>

                    <div class="form-group">
                        <label for="so_luong">Số lượng</label>
                        <input type="number" name="so_luong" class="form-control" id="so_luong"
                            placeholder="Nhập số lượng" required />
                    </div>

                    <div class="form-group">
                        <label for="mo_ta">Mô tả</label>
                        <textarea name="mo_ta" class="form-control" id="mo_ta" cols="30" rows="5"
                            placeholder="Nhập mô tả mã giảm giá"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="ngay_bat_dau">Ngày bắt đầu</label>
                        <input type="date" name="ngay_bat_dau" class="form-control" id="ngay_bat_dau" required />
                    </div>

                    <div class="form-group">
                        <label for="ngay_ket_thuc">Ngày kết thúc</label>
                        <input type="date" name="ngay_ket_thuc" class="form-control" id="ngay_ket_thuc" required />
                    </div>

                    <div class="form-group">
                        <label for="gia_tri_giam">Giá trị giảm</label>
                        <input type="number" name="gia_tri_giam" class="form-control" id="gia_tri_giam"
                            placeholder="Nhập giá trị giảm %" required />
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Thêm mới</button>
                        <a href="{{ route('ma_giam_gia.index') }}" class="btn btn-danger">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
