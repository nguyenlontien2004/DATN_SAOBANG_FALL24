@extends('nhanVien.index')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="content">
                <h1>Thông tin vé</h1>
                <p>ID Vé: {{ $ve->id }}</p>
                <p>Ngày thanh toán: {{ $ve->ngay_thanh_toan }}</p>
            
                <!-- Hiển thị QR Code -->
                <div>
                    <h3>Mã QR:</h3>
                    <img src="{{ $qrCodeBase64 }}" alt="QR Code">
                </div>
            </div>
        </div>
    </div>
@endsection
