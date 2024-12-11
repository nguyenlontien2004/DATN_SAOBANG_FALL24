@extends('admin.index')

@section('content')
    <div class="page-inner">
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
            <h1>Quét mã QR</h1>
            <button id="openCameraButton">Mở Camera</button>
            <!-- <input type="file" id="uploadImage" accept="image/*"> -->
            <video id="video" style="display: none;" autoplay></video>
            <canvas id="canvas" style="display: none;"></canvas>
            <p>Kết quả: <span id="qrResult">Chưa có kết quả</span></p>
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
                    try {response = await fetch(`http://127.0.0.1:8000/api/check-qrCode/${ticketId}`);
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
                        <span class="px-2">/</span>
                        <a href="{{ route('admin.ticket.create') }}">Tạo vé giả lập</a>
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
                                        <th>Thanh toán</th>
                                        <th>Tổng vé</th>
                                        <th>Chí tiết</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($litsTicket as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex">
                                                    <!-- <img width="40px" src="https://cdn.moveek.com/storage/media/cache/short/665dc87501b36651649752.jpg" alt=""> -->
                                                    <div class="d-flex flex-column ms-3">
                                                        <strong
                                                            style="font-size: 14.5px;">{{ $item->suatChieu->phim->ten_phim }}</strong>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $item->user->ho_ten }}</td>
                                            <td>{{ $item->suatChieu->phongChieu->ten_phong_chieu }}</td>
                                            <td>{{ $item->maGiamGia == null ? 'Không áp dụng' : $item->maGiamGia->ten_ma_giam_gia }}
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <span class="d-flex text-left">Ghế: <strong>
                                                        @php
                                                        $ghe = $item->chiTietVe->pluck('seat')->groupBy('the_loai');
                                                        @endphp
                                                            @foreach ($ghe as $key=>$value)
                                                            @for ($i = 0; $i < count($value); $i++)
                                                                @if ($key == 'doi')
                                                                    <span class="dataghechon" id="{{ $value[$i]['id'] . '-' . $value[$i + 1]['id'] }}" data-type="{{ $value[$i]['the_loai'] }}">{{ $value[$i]->hang_ghe . $value[$i]->so_hieu_ghe . $value[$i + 1]->hang_ghe . $value[$i + 1]->so_hieu_ghe}}{{ isset($value[$i + 2]) ? "," : "" }}</span>
                                                                    @php $i++ @endphp
                                                                @else
                                                                   <span class="dataghechon" id="{{ $value[$i]['id'] }}" data-type="{{ $value[$i]['the_loai'] }}"> {{ $value[$i]->hang_ghe . $value[$i]->so_hieu_ghe }}{{ isset($value[$i + 1]) ? "," : "" }}</span>
                                                                @endif
                                                            @endfor
                                                            @endforeach
                                                        </strong>
                                                    </span>
                                                   
                                                </div>
                                            </td>
                                            <td>{{ $item->phuong_thuc_thanh_toan }}</td>
                                            <td>{{ number_format($item->tong_tien, 0, ',', '.') }}đ</td>
                                            <td><a href="{{ route('admin.ticket.detail', $item->id) }}">Xem</a>
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
    </div>
    <script>
        $(document).ready(function() {
            $("#basic-datatables").DataTable({
                responsive: true,
            });
        });
    </script>
@endsection
