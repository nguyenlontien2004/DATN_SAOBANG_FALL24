@extends('admin.layouts.master')
@section('noidung')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Thêm mới Rạp</h5>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        <div class="card-body">
            <form action="{{ route('rap.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="ten_rap" class="form-label">Tên Rạp</label>
                    <input type="text" class="form-control" id="ten_rap" name="ten_rap" required>
                </div>

                <div class="mb-3">
                    <label for="dia_diem" class="form-label">Địa Điểm</label>
                    <input type="text" class="form-control" id="dia_diem" name="dia_diem" required>
                </div>

                <div class="mb-3">
                    <label for="trang_thai" class="form-label">Trạng Thái</label>
                    <select class="form-select" id="trang_thai" name="trang_thai" required>
                        <option value="1">Hoạt động</option>
                        <option value="0">Không hoạt động</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Thêm mới Rạp</button>
                <a href="{{ route('rap.index') }}" class="btn btn-secondary">Quay lại</a>
            </form>
        </div>
    </div>
</div>
@endsection
