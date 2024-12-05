@extends('nhanVien.index')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="content">
                <h4 class="fs-18 fw-semibold m-0 mb-3">Thông Tin Vé</h4>

                <div class="card">
                    <div class="card-body">
                        <!-- Thông tin vé -->
                        <div class="mb-3">
                            <p><strong>ID Vé:</strong> {{ $ve->id }}</p>
                            <p><strong>Ngày thanh toán:</strong> {{ $ve->ngay_thanh_toan }}</p>
                        </div>

                        <!-- Hiển thị QR Code -->
                        <div class="mb-3">
                            <h5 class="fs-16 fw-semibold">Mã QR:</h5>
                            <div class="text-center">
                                <img src="{{ $qrCodeBase64 }}" alt="QR Code" style="width: 200px; height: 200px;">
                            </div>
                        </div>

                        <!-- Thông tin thêm (nếu có) -->
                        <div class="mb-3">
                            <p><strong>Trạng thái thanh toán:</strong> {{ $ve->trang_thai == 0 ? 'Chưa thanh toán' : 'Đã thanh toán' }}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
