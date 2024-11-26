@extends('admin.index')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Thêm mới Rạp</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('rap.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="ten_rap" class="form-label">Tên Rạp</label>
                        <input type="text" class="form-control" id="ten_rap" name="ten_rap" value="{{ old('ten_rap') }}"> 
                        @error('ten_rap')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="dia_diem" class="form-label">Địa Điểm</label>
                        <input type="text" class="form-control" id="dia_diem" name="dia_diem" value="{{ old('dia_diem') }}"> 
                        @error('dia_diem')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm mới Rạp</button>
                    <a href="{{ route('rap.index') }}" class="btn btn-secondary">Quay lại</a>
                </form>
            </div>
        </div>
    </div>
@endsection
