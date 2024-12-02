@extends('nhanVien.index')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="content">
                <h4 class="fs-18 fw-semibold m-0 mb-3">Đặt Vé</h4>

                <!-- Form Đặt Vé -->
                <form action="{{ route('ve.luu') }}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="nguoi_dung_id" class="form-label">ID Người dùng:</label>
                                <input type="number" name="nguoi_dung_id" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="ngay_thanh_toan" class="form-label">Ngày thanh toán:</label>
                                <input type="date" name="ngay_thanh_toan" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="ghe_ngoi_ids" class="form-label">Ghế ngồi:</label>
                                <select name="ghe_ngoi_ids[]" class="form-select" multiple required>
                                    @foreach($gheNgois as $gheNgoi)
                                        <option value="{{ $gheNgoi->id }}">{{ $gheNgoi->ten_ghe }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-success">Đặt vé</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
