@extends('admin.index')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Thêm mới Diễn Viên</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('dienVien.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="ten_dien_vien" class="form-label">Tên Diễn Viên</label>
                        <input type="text" class="form-control" id="ten_dien_vien" name="ten_dien_vien" value="{{old('ten_dien_vien')}}" >
                        @error('ten_dien_vien')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="anh_dien_vien" class="form-label">Ảnh Diễn Viên</label>
                        <input type="file" class="form-control" id="anh_dien_vien" name="anh_dien_vien" accept="image/*" value="{{old('anh_dien_vien')}}"
                            >
                        @error('anh_dien_vien')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nam_sinh" class="form-label">Năm sinh</label>
                        <input type="date" class="form-control" id="nam_sinh" name="nam_sinh" value="{{old('nam_sinh')}}">
                        @error('nam_sinh')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="quoc_tich" class="form-label">Quốc tịch</label>
                            <input type="text" class="form-control" id="quoc_tich" name="quoc_tich" value="{{old('quoc_tich')}}">
                            @error('quoc_tich')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="gioi_tinh" class="form-label">Giới Tính</label>
                            <select class="form-select" id="gioi_tinh" name="gioi_tinh" >
                                <option value="">Chọn giới tính</option>
                                <option value="Nam" {{ old('gioi_tinh') == 'Nam' ? 'selected' : '' }}>Nam</option>
                                <option value="Nữ" {{ old('gioi_tinh') == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                                <option value="Khác" {{ old('gioi_tinh') == 'Khác' ? 'selected' : '' }}>Khác</option>
                            </select>
                            @error('gioi_tinh')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="tieu_su" class="form-label">Tiểu Sử</label>
                        <textarea type="text" class="form-control" id="tieu_su" name="tieu_su" >{{ old('tieu_su') }}</textarea>
                        @error('tieu_su')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- <div class="mb-3">
                        <label for="trang_thai" class="form-label">Trạng Thái</label>
                        <select class="form-select" id="trang_thai" name="trang_thai" >
                            <option value="1">Hoạt động</option>
                            <option value="0">Không hoạt động</option>
                        </select>
                    </div> --}}

                    <button type="submit" class="btn btn-primary">Thêm mới Diễn Viên</button>
                    <a href="{{ route('daoDien.index') }}" class="btn btn-secondary">Quay lại</a>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script-libs')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
@endsection

@section('scripts')
    <script>
        ClassicEditor
            .create(document.querySelector('#tieu_su'), {
                ckfinder: {
                    uploadUrl: "{{ route('admin.dienVien.upload', ['_token' => csrf_token()]) }}"
                }
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection

@section('styles')
    <style>
        .ck-editor__editable_inline {
            height: 300px;
        }
    </style>
@endsection
