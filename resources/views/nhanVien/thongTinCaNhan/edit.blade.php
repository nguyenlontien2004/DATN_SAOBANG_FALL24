@extends('nhanVien.index')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="content">
                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <h2 class="fs-18 fw-semibold m-0 text-center">Thông tin cá nhân</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h5 class="m-0">Cập nhật thông tin cá nhân</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('profile.update',$thongTin->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="anh_dai_dien" class="form-label">Ảnh đại diện:</label>
                                        <input type="file" id="anh_dai_dien" name="anh_dai_dien" class="form-control">
                                        <img id="hinh_anh_dm" src="{{ Storage::url($thongTin->anh_dai_dien) }}"
                                                        alt="Ảnh đại diện" style="width: 150px;">
                                    </div>
                                    <div class="mb-3">
                                        <label for="ho_ten" class="form-label">Họ và Tên:</label>
                                        <input type="text" id="ho_ten" name="ho_ten" value="{{ $thongTin->ho_ten }}" 
                                            class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email:</label>
                                        <input type="email" id="email" name="email" value="{{ $thongTin->email }}" 
                                            class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="so_dien_thoai" class="form-label">Số điện thoại:</label>
                                        <input type="text" id="so_dien_thoai" name="so_dien_thoai" 
                                            value="{{ $thongTin->so_dien_thoai }}" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="gioi_tinh" class="form-label">Giới tính:</label>
                                        <select id="gioi_tinh" name="gioi_tinh" class="form-select">
                                            <option value="Nam" {{ $thongTin->gioi_tinh == 'Nam' ? 'selected' : '' }}>Nam</option>
                                            <option value="Nữ" {{ $thongTin->gioi_tinh == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                                            <option value="Khác" {{ $thongTin->gioi_tinh == 'Khác' ? 'selected' : '' }}>Khác</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="dia_chi" class="form-label">Địa chỉ:</label>
                                        <textarea id="dia_chi" name="dia_chi" rows="3" 
                                            class="form-control">{{ $thongTin->dia_chi }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nam_sinh" class="form-label">Năm sinh:</label>
                                        <input type="datetime" id="nam_sinh" name="nam_sinh" 
                                            value="{{ $thongTin->nam_sinh }}" class="form-control">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-warning">Cập Nhật</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- content -->
        </div>
    </div>
@endsection
