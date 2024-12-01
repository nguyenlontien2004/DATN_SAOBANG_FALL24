@extends('nhanVien.index')

@section('title')
    {{ $title }}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="content">

                <!-- Start Content-->
                <div class="ll">

                    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                        <div class="flex-grow-1">
                            <h4 class="fs-18 fw-semibold m-0">Quản lí món ăn</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <div class="card-header">
                                    <h5 class="card-title mb-0">{{ $title }}</h5>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="row">
                                        <form action="{{ route('do-an.store') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label for="ten_do_an" class="form-label">Tên đồ ăn</label>
                                                    <input type="text" name="ten_do_an" id="ten_do_an"
                                                        class="form-control @error('ten_do_an') is-invalid @enderror"
                                                        value="{{ old('ten_do_an') }}" placeholder="Nhập tên đồ ăn">
                                                    @error('ten_do_an')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label for="gia" class="form-label">Giá</label>
                                                    <input type="text" name="gia" id="gia"
                                                        class="form-control @error('gia') is-invalid @enderror"
                                                        value="{{ old('gia') }}" placeholder="Nhập giá">
                                                    @error('gia')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label for="hinh_anh" class="form-label">Hình ảnh</label>
                                                    <input type="file" id="hinh_anh" name="hinh_anh"
                                                        class="form-control" onchange="showImage(event)">
                                                    <img id="hinh_anh_dm" src="" alt="Ảnh đồ ăn"
                                                        style="width: 150px; display: none">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label for="mo_ta" class="form-label">Mô tả</label>
                                                    <textarea name="mo_ta" id="mo_ta" class="form-control @error('mo_ta') is-invalid @enderror"
                                                        placeholder="Nhập mô tả">{{ old('mo_ta') }}</textarea>
                                                    @error('mo_ta')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label for="luot_mua" class="form-label">Lượt mua</label>
                                                    <input type="number" name="luot_mua" id="luot_mua"
                                                        class="form-control @error('luot_mua') is-invalid @enderror"
                                                        value="{{ old('luot_mua') }}" placeholder="Nhập lượt mua">
                                                    @error('luot_mua')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <label for="trang_thai" class="form-label">Trạng thái</label>
                                                <div class="col-sm-10 d-flex mb-3 gap-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="trang_thai"
                                                            id="gridRadios1" value="1" checked>
                                                        <label class="form-check-label text-success" for="gridRadios1">
                                                            Hiển thị
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="trang_thai"
                                                            id="gridRadios2" value="0">
                                                        <label class="form-check-label text-danger" for="gridRadios2">
                                                            Ẩn
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-center">
                                                <button type="submit" class="btn btn-success">Thêm</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- container-fluid -->
            </div> <!-- content -->
        </div>
    </div>
@endsection
