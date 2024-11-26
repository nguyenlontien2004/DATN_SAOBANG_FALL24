@extends('admin.index')

@section('content')
<div class="page-inner">
    <div class="page-header mb-1">
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="{{ route('admin.ticket.index') }}">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Tạo vé giả lập</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.storephongChieu') }}" method="post">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Tạo vé giả lập</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group">
                                <label for="email2">Người dùng</label>
                                <select class="form-select" id="exampleFormControlSelect1" request>
                                    <option>Mời chọn người dùng</option>
                                    @foreach ($nguoidung as $item)
                                        <option value="{{ $item->id }}">{{ $item->ho_ten }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('ten_phong_chieu')
                                <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                            @enderror
                            <div class="form-group">
                                <label for="email2">Suất chiếu</label>
                                <select class="form-select" id="exampleFormControlSelect1" request>
                                    <option>Mời chọn suất chiếu</option>
                                    @foreach ($suatChieu as $item)
                                        <option value="{{ $item->id }}">Phòng:
                                            {{ $item->phongChieu->ten_phong_chieu }}({{ $item->gio_bat_dau . '-' . $item->gio_ket_thuc }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('ten_phong_chieu')
                                <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                            @enderror
                            <div class="form-group">
                                <label for="email2">Mã giảm giá (Không bắt buộc)</label>
                                <select class="form-select" id="exampleFormControlSelect1" request>
                                    <option>Mời chọn mã giảm giá</option>
                                    @foreach ($maGiamGia as $item)
                                    <option value="{{ $item->id }}" >{{ $item->ten_ma_giam_gia }}</option> 
                                    @endforeach
                                </select>
                            </div>
                            @error('ten_phong_chieu')
                                <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                            @enderror
                            <div class="form-group">
                                <label for="email2">Đồ ăn (Không bắt buộc)</label>
                                <select class="form-select" id="exampleFormControlSelect1" multiple>
                                    @foreach ($doAn as $item)
                                    <option value="{{ $item->id }}" >{{ $item->ten_do_an}} <span class="mx-4"> - </span> {{number_format($item->gia,0,',','.').'đ' }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('ten_phong_chieu')
                                <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                            @enderror
                            <div class="d-flex px-0">
                                <div class="form-group col-md-6">
                                    <label for="email2">Loại ghế</label>
                                    <select class="form-select" id="exampleFormControlSelect1" request>
                                        <option value="0">Mời chọn loại ghế</option>
                                        <option value="thuong">Ghế thường</option>
                                        <option value="vip">Ghế vip</option>
                                        <option value="doi">Ghế đôi</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="email2">Hàng ghế</label>
                                    <select class="form-select" id="exampleFormControlSelect1" request>
                                        <option>Mời chọn hàng ghế</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Phương thức thanh toán</label>
                                <select class="form-select" name="rap_id" required id="exampleFormControlSelect1">
                                    <option value="0">Mời chọn phương thức</option>
                                    <option value="0">Thanh toán online</option>
                                    <option value="0">Đến quầy thanh toán</option>

                                </select>
                                @error('rap_id')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror

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