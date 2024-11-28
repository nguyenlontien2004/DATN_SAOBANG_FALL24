@extends('admin.index')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Chỉnh sửa Phim</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('phim.update', $phim->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="ten_phim" class="form-label">Tên Phim</label>
                        <input type="text" class="form-control" id="ten_phim" name="ten_phim"
                            value="{{ old('ten_phim', $phim->ten_phim) }}">
                        @error('ten_phim')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="anh_phim" class="form-label">Ảnh Phim</label>
                        @if ($phim->anh_phim)
                            <div>
                                <img src="{{ asset('storage/' . $phim->anh_phim) }}" alt="Ảnh Phim" class="img-fluid"
                                    width="200">
                            </div>
                        @else
                            <div>Chưa có ảnh phim</div>
                        @endif
                        <input type="file" class="form-control" id="anh_phim" name="anh_phim" accept="image/*"
                            value="{{ old('anh_phim') }}">
                        @error('anh_phim')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="gia_phim" class="form-label">Gía Phim</label>
                        <input type="number" class="form-control" id="gia_phim" name="gia_phim"
                            value="{{ old('gia_phim') }}">
                        @error('gia_phim')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="mo_ta" class="form-label">Mô Tả</label>
                        <textarea class="form-control" id="mo_ta" name="mo_ta">{{ old('mo_ta', $phim->mo_ta) }}</textarea>
                        @error('mo_ta')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-4">
                            <label for="do_tuoi" class="form-label">Độ Tuổi</label>
                      
                            <input type="number" class="form-control" id="do_tuoi" name="do_tuoi"
                                value="{{ old('do_tuoi', $phim->do_tuoi) }}">
                            @error('do_tuoi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="ngon_ngu" class="form-label">Ngôn Ngữ</label>
                            <input type="text" class="form-control" id="ngon_ngu" name="ngon_ngu"
                                value="{{ old('ngon_ngu', $phim->ngon_ngu) }}">

                            @error('ngon_ngu')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="luot_xem_phim" class="form-label">Lượt Xem</label>
                            {{-- <input type="number" class="form-control" id="luot_xem_phim" name="luot_xem_phim"
                                value="{{ old('luot_xem_phim') }}"> --}}
                            <input type="number" class="form-control" id="luot_xem_phim" name="luot_xem_phim"
                                value="{{ old('luot_xem_phim', $phim->luot_xem_phim) }}">

                            @error('luot_xem_phim')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-md-4">
                            <label for="thoi_luong" class="form-label">Thời Lượng (phút)</label>
                            <input type="number" class="form-control" id="thoi_luong" name="thoi_luong"
                                value="{{ old('thoi_luong', $phim->thoi_luong) }}">
                            @error('thoi_luong')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="ngay_khoi_chieu" class="form-label">Ngày Khởi Chiếu</label>
                            <input type="date" class="form-control" id="ngay_khoi_chieu" name="ngay_khoi_chieu"
                                value="{{ old('ngay_khoi_chieu', $phim->ngay_khoi_chieu) }}">
                            @error('ngay_khoi_chieu')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="ngay_ket_thuc" class="form-label">Ngày Kết Thúc</label>
                            <input type="date" class="form-control" id="ngay_ket_thuc" name="ngay_ket_thuc"
                                value="{{ old('ngay_ket_thuc', $phim->ngay_ket_thuc) }}">
                            @error('ngay_ket_thuc')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="trailer" class="form-label">Trailer (link)</label>
                        <input type="url" class="form-control" id="trailer" name="trailer"
                            value="{{ old('trailer', $phim->trailer) }}">
                        @error('trailer')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="the_loai_phim_ids">Chọn Thể Loại</label>
                            <select name="the_loai_phim_ids[]" class="form-control" multiple>
                                @foreach ($theLoaiPhims as $theLoai)
                                    <option value="{{ $theLoai->id }}"
                                        {{ in_array($theLoai->id, $phim->theLoaiPhims->pluck('id')->toArray() ?? []) ? 'selected' : '' }}>
                                        {{ $theLoai->ten_the_loai }}
                                    </option>
                                @endforeach
                            </select>
                            @error('the_loai_phim_ids')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="dao_dien_ids">Chọn Đạo Diễn</label>
                            <select name="dao_dien_ids[]" class="form-control" multiple>
                                @foreach ($daoDiens as $daoDien)
                                    <option value="{{ $daoDien->id }}"
                                        {{ in_array($daoDien->id, $phim->daoDiens->pluck('id')->toArray() ?? []) ? 'selected' : '' }}>
                                        {{ $daoDien->ten_dao_dien }}
                                    </option>
                                @endforeach
                            </select>
                            @error('dao_dien_ids')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="dien_vien_ids">Chọn Diễn Viên</label>
                            <select id="dien_vien_ids" name="dien_vien_ids[]" class="form-control" multiple>
                                @foreach ($dienViens as $dienVien)
                                    <option value="{{ $dienVien->id }}"
                                        {{ in_array($dienVien->id, $phim->dienViens->pluck('id')->toArray() ?? []) ? 'selected' : '' }}>
                                        {{ $dienVien->ten_dien_vien }}
                                    </option>
                                @endforeach
                            </select>
                            @error('dien_vien_ids')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="trang_thai" class="form-label">Trạng Thái</label>
                        <select class="form-select" id="trang_thai" name="trang_thai">
                            <option value="1" {{ $phim->trang_thai == 1 ? 'selected' : '' }}>Hoạt động</option>
                            <option value="0" {{ $phim->trang_thai == 0 ? 'selected' : '' }}>Không hoạt động</option>
                        </select>
                        @error('trang_thai')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3" id="vai_tro_container">
                        <label for="vai_tro_dien_vien">Vai Trò Diễn Viên</label>
                        <div class="form-group">
                            <select name="vai_tro_dien_vien[]" class="form-control">
                                <option value="Diễn viên chính">Diễn viên chính</option>
                                <option value="Diễn viên phụ">Diễn viên phụ</option>
                            </select>
                            @error('vai_tro_dien_vien')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhật Phim</button>
                    <a href="{{ route('phim.index') }}" class="btn btn-secondary">Quay lại</a>
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
            .create(document.querySelector('#mo_ta'), {
                ckfinder: {
                    uploadUrl: "{{ route('admin.phim.upload', ['_token' => csrf_token()]) }}"
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
            height: 500px;
        }
    </style>
@endsection
