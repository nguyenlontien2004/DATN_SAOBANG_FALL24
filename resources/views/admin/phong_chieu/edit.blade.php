@extends('admin.index')

@section('content')
    <div class="page-inner">
        <div class="page-header mb-1">
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin.phongChieu') }}">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Sửa phòng chiếu</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('admin.updataphongChieu', $data->id) }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Sửa phòng chiếu</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email2">Tên phòng chiếu</label>
                                        <input type="text" name="ten_phong_chieu" value="{{ $data->ten_phong_chieu }}"
                                            required class="form-control" id="email2" />
                                        @error('ten_phong_chieu')
                                            <small id="emailHelp2"
                                                class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Thuộc hệ thống rạp</label>
                                        <select class="form-select" name="rap_id" required id="exampleFormControlSelect1">
                                            <option value="0">Mời chọn hệ thống rạp</option>
                                            @foreach ($list_rap as $item)
                                                <option value="{{ $item->id }}"
                                                    @if ($item->id == $data->rap_id) selected @endif>
                                                    {{ $item->ten_rap }}</option>
                                            @endforeach
                                        </select>
                                        @error('rap_id')
                                            <small id="emailHelp2"
                                                class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror

                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" value="1" type="radio" name="trang_thai"
                                            id="trang_thai1" @if ($data->trang_thai == true) checked @endif>
                                        <label class="form-check-label" for="trang_thai1">
                                            Phòng chiếu đang hoạt động
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" value="0" type="radio" name="trang_thai"
                                            id="trang_thai2" @if ($data->trang_thai == false) checked @endif>
                                        <label class="form-check-label" for="trang_thai2">
                                            Phòng chiếu đã tạm ngừng hoạt động
                                        </label>
                                    </div>
                                    @if (session()->has('success'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session()->get('success') }}
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <button class="btn btn-success">Submit</button>
                            <button class="btn btn-danger">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
