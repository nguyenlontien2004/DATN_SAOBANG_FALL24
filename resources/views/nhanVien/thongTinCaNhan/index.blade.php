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
                                <div class="text-center mb-4">
                                    @if ($user->anh_dai_dien)
                                        <img src="{{ Storage::url($user->anh_dai_dien) }}" alt="Ảnh đại diện"
                                            class="rounded-circle img-thumbnail" style="width: 150px; height: 150px;">
                                    @else
                                        <img src="{{ asset('images/default-avatar.png') }}" alt="Default Avatar"
                                            class="rounded-circle img-thumbnail" style="width: 150px; height: 150px;">
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="ho_ten" class="form-label">Họ và Tên:</label>
                                    <input type="text" id="ho_ten" name="ho_ten" value="{{ $user->ho_ten }}"
                                        class="form-control" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" id="email" name="email" value="{{ $user->email }}"
                                        class="form-control" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="so_dien_thoai" class="form-label">Số điện thoại:</label>
                                    <input type="text" id="so_dien_thoai" name="so_dien_thoai"
                                        value="{{ $user->so_dien_thoai }}" class="form-control" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="gioi_tinh" class="form-label">Giới tính:</label>
                                    <input type="text" id="gioi_tinh" name="gioi_tinh" value="{{ $user->gioi_tinh }}"
                                        class="form-control" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="dia_chi" class="form-label">Địa chỉ:</label>
                                    <textarea id="dia_chi" name="dia_chi" rows="3" class="form-control" readonly>{{ $user->dia_chi }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="nam_sinh" class="form-label">Năm sinh:</label>
                                    <input type="datetime" id="nam_sinh" name="nam_sinh" value="{{ $user->nam_sinh }}"
                                        class="form-control" readonly>
                                </div>
                                <div class="text-center">
                                    <a href="{{ route('profile.edit', $user->id) }}"><button type="submit"
                                            class="btn btn-success">Cập Nhật Thông Tin</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
