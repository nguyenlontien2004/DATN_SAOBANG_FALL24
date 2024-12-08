@extends('admin.index')

@section('content')
    <div class=" m-3 page-inner">
        <div class="page-header">
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="#">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Danh sách vé</a>
                </li>
            </ul>
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
            
            <script src="https://cdn.jsdelivr.net/npm/jsqr"></script>
            <script>
                document.getElementById("openCameraButton").addEventListener("click", async () => {
                    try {
                        const stream = await navigator.mediaDevices.getUserMedia({
                            video: {
                                facingMode: "environment",
                            },
                        });
                        document.getElementById("video").style.display = "block";
                        const video = document.getElementById("video");
                        video.srcObject = stream;

                        video.addEventListener("play", () => {
                            const context = document.getElementById("canvas").getContext("2d");
                            const intervalId = setInterval(() => {
                                const canvas = document.getElementById("canvas");
                                canvas.width = video.videoWidth;
                                canvas.height = video.videoHeight;
                                context.drawImage(video, 0, 0, canvas.width, canvas.height);

                                const imageData = context.getImageData(0, 0, canvas.width, canvas
                                    .height);
                                const code = jsQR(imageData.data, canvas.width, canvas.height);
                                if (code) {
                                    const scannedLink = code.data;
                                    document.getElementById("qrResult").innerHTML = `
                        <p>Link quét được: <strong>${scannedLink}</strong></p>
                    `;
                                    clearInterval(intervalId);
                                    stream.getTracks().forEach((track) => track.stop());
                                    video.style.display = "none";
                                    const ticketId = scannedLink.split('/').pop(); // Lấy ID từ link
                                    fetchTicketInfo(ticketId);
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
        </div>

        <div class="modal fade" id="ticketModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4 class="card-title">Danh sách vé</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Phim</th>
                                        <th>Người đặt</th>
                                        <th>Phòng chiếu</th>
                                        <th>Mã giảm giá</th>
                                        <th>Hàng ghế</th>
                                        <th>Trạng thái vé</th>
                                        <th>Tổng vé</th>
                                        <th>Chí tiết vé</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($litsTicket as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="d-flex flex-column ms-3">
                                                        <strong
                                                            style="font-size: 14.5px;">{{ $item->showtime->movie->ten_phim }}</strong>
                                                        <p style="font-size: 12.5px;">2024 ·
                                                            {{ $item->showtime->movie->thoi_luong }} phút</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $item->user->ho_ten }}</td>
                                            <td>{{ $item->showtime->screeningRoom->ten_phong_chieu }}</td>
                                            <td>{{ $item->discountCode == null ? 'Không áp dụng' : $item->discountCode->ten_ma_giam_gia }}
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <span class="d-flex">Ghế: <strong>
                                                            @foreach ($item->detailTicket as $seat)
                                                                {{ $seat->seat->hang_ghe . $seat->seat->so_hieu_ghe }}
                                                            @endforeach
                                                        </strong></span>
                                                </div>
                                            </td>
                                            <td>Cần bàn bạc</td>
                                            <td>{{ number_format($item->tong_tien, 0, ',', '.') }}đ</td>
                                            <td><a href="{{ route('admin.ticket.detail', $item->id) }}">Xem</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#basic-datatables").DataTable({
                responsive: true,
            });
        });
    </script>
@endsection
