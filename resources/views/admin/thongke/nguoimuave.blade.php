@extends('admin.index')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="#">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Thống kê người dùng mua vé</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="card-title">Thống kê người dùng mua vé</div>
            </div>
            <div class="form-group  mt-3">
                <form action="{{ route('thongke.nguoimua') }}" method="GET" class="row g-3">
                    <div class="col-md-2">
                        <label for="bat_dau" class="form-label">Từ ngày</label>
                        <input type="date" name="bat_dau" id="bat_dau" class="form-control"
                            value="{{ $bd ? $bd->toDateString() : '' }}" onchange="this.form.submit()">
                    </div>
                    <div class="col-md-2">
                        <label for="ket_thuc" class="form-label">Đến ngày</label>
                        <input type="date" name="ket_thuc" id="ket_thuc" class="form-control"
                            value="{{ $kt ? $kt->toDateString() : '' }}" onchange="this.form.submit()">
                    </div>
                    <div class="col-md-3">
                        <label for="quy" class="form-label">Lọc theo quý</label>
                        <select class="form-control" name="loc" id="loc" onchange="this.form.submit()">
                            <option value="" {{ request('loc') == '' ? 'selected' : '' }}>Chọn quý</option>
                            <option value="1" {{ request('loc') == '1' ? 'selected' : '' }}> Quý 1</option>
                            <option value="2" {{ request('loc') == '2' ? 'selected' : '' }}> Quý 2</option>
                            <option value="3" {{ request('loc') == '3' ? 'selected' : '' }}> Quý 3</option>
                            <option value="4" {{ request('loc') == '4' ? 'selected' : '' }}> Quý 4</option>
                        </select>
                    </div>
                    <div class="col-md-5 d-flex align-items-end">
                        <div class="btn-group w-100" role="group">
                            <button type="submit" name="loc" value="nam" class="btn btn-info me-2">Lọc theo
                                năm</button>
                            <button type="submit" name="loc" value="thang" class="btn btn-info me-2">Lọc theo
                                tháng</button>
                            <button type="submit" name="loc" value="tuan" class="btn btn-info me-2">Lọc theo
                                tuần</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card-body">

                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Họ Và Tên</th>
                            <th>Email</th>
                            <th>Số Điện Thoại</th>
                            <th>Số Lần Mua</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($nguoiMua as $index => $nguoi)
                           @if ($nguoi->ves_count > 0 )
                           <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $nguoi->ho_ten }}</td>
                                <td>{{ $nguoi->email }}</td>
                                <td>{{ $nguoi->so_dien_thoai }}</td>
                                <td>{{ $nguoi->ves->count() }}</td>
                            </tr>
                           @endif
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Không có dữ liệu.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection