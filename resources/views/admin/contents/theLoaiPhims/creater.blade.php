@extends('admin.index')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Thêm mới Thể loại</h5>
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
                <form action="{{ route('theLoaiPhim.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="ten_the_loai" class="form-label">Tên Thể loại</label>
                        <input type="text" class="form-control" id="ten_the_loai" name="ten_the_loai" required>
                    </div>

                    <div class="mb-3">
                        <label for="trang_thai" class="form-label">Trạng Thái</label>
                        <select class="form-select" id="trang_thai" name="trang_thai" required>
                            <option value="1">Hoạt động</option>
                            <option value="0">Không hoạt động</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Thêm mới Thể loại</button>
                    <a href="{{ route('theLoaiPhim.index') }}" class="btn btn-secondary">Quay lại</a>
                </form>
            </div>
        </div>
    </div>
@endsection
