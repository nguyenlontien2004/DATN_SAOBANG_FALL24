@extends('nhanVien.index')

@section('content')
<style>
    .customghe{
        list-style: none;
    margin: 2px;
    text-align: center;
    padding: 6px 5.5px;
    border-radius: 5px;
    }
</style>
<div>
   <div class="ms-4 mt-3">
    <a href=""> Quét QR đồ ăn</a>
    <span class="px-2">/</span>
    <a href="{{ route('nhanvien.checkmacodedoan') }}">Kiểm tra đồ ăn qua mã vé</a>
   </div>
</div>
<div>

    <h1 class="text-center my-4">Quét đồ ăn qua mã QR</h1>
    <div class="text-center mb-3">
        <button id="openCameraButton" class="btn btn-primary">
            <i class="fa fa-camera"></i> Mở Camera
        </button>
    </div>

    <div class="card mx-auto" style="max-width: 600px;">
        <div class="card-body text-center">
            <video id="video" class="img-fluid border" style="display: none;" autoplay></video>
            <canvas id="canvas" style="display: none;"></canvas>
            <p class="mt-3">Kết quả: <span id="qrResult" class="font-weight-bold text-primary">Chưa có kết quả</span>
            </p>
        </div>
    </div>

</div>
<div class="modal fade container-seat" style="width:100%;max-width: 100%;" id="ticketModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog seat-selection" role="document">
        <div class="modal-content seats-wrapper-parent">
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/jsqr"></script>
<script>
    let link='';
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
                        link =scannedLink;
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
            response = await fetch(`http://127.0.0.1:8000/check-qrCode/${ticketId}?doan=1`);
            const qrResult = document.getElementById("qrResult");
            if (response.ok) {
                const data = await response.json();
               console.log(data)
                showModal(data);
            } else {
                const errorData = await response.json();
                qrResult.innerHTML += `<p>${errorData.message || "Không tìm thấy thông tin vé!"}</p>`;
            }
            console.log(response);
            
        } catch (error) {
            console.error("Lỗi khi gọi API:", error);
            $.notify({
                    icon: 'icon-bell',
                    message: error.responseJSON.msg,
                }, {
                    type: 'danger',
                    placement: {
                        from: "top",
                        align: "right"
                    },
                    time: 1000,
                });      
            document.getElementById("qrResult").innerHTML += `<p>Kết quả: Lỗi hệ thống. Vui lòng thử lại!</p>`;
        }
    };
    const showModal = (data) => {
        let modalContent = `
        <div class="modal-header">
            <h5 class="modal-title">Thông tin vé</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body seats-wrapper-row">
            <p class="mb-0">Người sở hữu:${data.data.nguoi_dung}</p>
            <p class="mb-0">Email:${data.data.email}</p>
            <div class="d-flex align-items-center">Đồ ăn: `
        $.each(data.data.do_ans,function(_,value){
          modalContent+= `<div><strong>${value.ten_do_an}</strong>X <strong>${value.pivot.so_luong_do_an}</strong></div>`
        })
        modalContent+=`</div>
            <p>Suất chiếu: ${data.data.thoigiansuatchieu}</p>

            <p class="${ data.satatus == 200 ? 'text-success':'text-danger' }">${data.message}</p>
        </div>
       
    `;
        const modal = document.getElementById("ticketModal");
        modal.querySelector('.modal-content').innerHTML = modalContent;
        $(modal).modal('show');

        // document.getElementById("printTicketButton").addEventListener("click", () => {
        //     window.print();
        // });
    };
</script>
@endsection