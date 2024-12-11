@extends('nhanVien.index')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="content">

                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-18 fw-semibold m-0">Danh sách vé</h4>
                    </div>
                </div>
                <div>
                    <h1 class="text-center my-4">Quét mã QR</h1>
                    <div class="text-center mb-3">
                        <button id="openCameraButton" class="btn btn-primary">
                            <i class="fa fa-camera"></i> Mở Camera
                        </button>
                    </div>
                    
                    <div class="card mx-auto" style="max-width: 600px;">
                        <div class="card-body text-center">
                            <video id="video" class="img-fluid border" style="display: none;" autoplay></video>
                            <canvas id="canvas" style="display: none;"></canvas>
                            <p class="mt-3">Kết quả: <span id="qrResult" class="font-weight-bold text-primary">Chưa có kết quả</span></p>
                        </div>
                    </div>
                </div>
        
                <div class="modal fade" id="ticketModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                            </div><!-- end card header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    @if (session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    <table class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID Vé</th>
                                                <th scope="col">Người dùng</th>
                                                <th scope="col">Ngày thanh toán</th>
                                                <th scope="col">Trạng thái</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($ves as $ve)
                                                <tr>
                                                    <th scope="row">{{ $ve->id }}</th>
                                                    <td>{{ $ve->user->name ?? 'Không xác định' }}</td>
                                                    <td>{{ $ve->ngay_thanh_toan }}</td>
                                                    <td>
                                                        {{ $ve->trang_thai == 0 ? 'Chưa thanh toán' : 'Đã thanh toán' }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- start row -->
            </div> <!-- content -->
        </div>
    </div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/jsqr"></script>
<script>
    document.getElementById("openCameraButton").addEventListener("click", async () => {
        try {
            const stream = await navigator.mediaDevices.getUserMedia({
                video: { facingMode: "environment" },
            });
            const video = document.getElementById("video");
            video.style.display = "block";
            video.srcObject = stream;

            video.addEventListener("play", () => {
                const context = document.getElementById("canvas").getContext("2d");
                const intervalId = setInterval(() => {
                    if (video.readyState === video.HAVE_ENOUGH_DATA) {
                        const canvas = document.getElementById("canvas");
                        canvas.width = video.videoWidth;
                        canvas.height = video.videoHeight;
                        context.drawImage(video, 0, 0, canvas.width, canvas.height);

                        const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
                        const code = jsQR(imageData.data, canvas.width, canvas.height);
                        if (code) {
                            const scannedLink = code.data;
                            const url = new URL(scannedLink);
                            const ticketId = url.pathname.split('/').pop();
                            document.getElementById("qrResult").innerHTML = `<p>Link quét được: <strong>${scannedLink}</strong></p>`;
                            clearInterval(intervalId);
                            stream.getTracks().forEach((track) => track.stop());
                            video.style.display = "none";
                            fetchTicketInfo(ticketId);
                        }
                    }
                }, 500);
            });
        } catch (error) {
            alert("Không thể mở camera. Vui lòng kiểm tra quyền truy cập!");
            console.error(error);
        }
    });

    const fetchTicketInfo = async (ticketId) => {
        try {
            const response = await fetch(`http://127.0.0.1:8000/api/check-qrCode/${ticketId}`);
            const qrResult = document.getElementById("qrResult");

            if (response.ok) {
                const data = await response.json();
                showModal(data);
            } else {
                const errorData = await response.json();
                qrResult.innerHTML += `<p>${errorData.message || "Không tìm thấy thông tin vé!"}</p>`;
            }
        } catch (error) {
            console.error("Lỗi khi gọi API:", error);
            document.getElementById("qrResult").innerHTML += `<p>Kết quả: Lỗi hệ thống. Vui lòng thử lại!</p>`;
        }
    };

    const showModal = (data) => {
        const modalContent = `
            <div class="modal-header">
                <h5 class="modal-title">Thông tin vé</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>ID vé: ${data.id}</p>
                <p>Suất chiếu: ${data.suat_chieu_id}</p>
                <p>Ngày thanh toán: ${data.ngay_thanh_toan}</p>
                <p>Tổng tiền: ${data.tong_tien}</p>
                <p>Phương thức thanh toán: ${data.phuong_thuc_thanh_toan}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button id="printTicketButton" class="btn btn-primary">In vé</button>
            </div>
        `;
        const modal = document.getElementById("ticketModal");
        modal.querySelector('.modal-content').innerHTML = modalContent;
        $(modal).modal('show');

        document.getElementById("printTicketButton").addEventListener("click", () => {
            window.print();
        });
    };
</script>

@endsection