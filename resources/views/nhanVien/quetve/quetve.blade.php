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
    <a href=""> Quét QR vé</a>
    <span class="px-2">/</span>
    <a href="{{ route('nhanvien.viewcheckmacodeve') }}">Kiểm tra mã vé</a>
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
            response = await fetch(`http://127.0.0.1:8000/check-qrCode/${ticketId}`);
            const qrResult = document.getElementById("qrResult");
            if (response.ok) {
                const data = await response.json();
                if(data.status == 404){
                    $.notify({
                    icon: 'icon-bell',
                    message: data.message,
                }, {
                    type: 'danger',
                    placement: {
                        from: "top",
                        align: "right"
                    },
                    time: 1000,
                });      
                }else{  
                    showModal(data); 
                }
            } else {
                const errorData = await response.json();
                qrResult.innerHTML += `<p>${errorData.message || "Không tìm thấy thông tin vé!"}</p>`;
            }
            console.log(response);
            
        } catch (error) {
            console.error("Lỗi khi gọi API:", error);
            // document.getElementById("qrResult").innerHTML += `<p>Kết quả: Lỗi hệ thống. Vui lòng thử lại!</p>`;
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
            <div class="d-flex align-items-center">Ghế: 
            <div class="seats-map" >
            <div class="row-wrapper list-row-seats d-flex" >`
        $.each(data.data.ghe,function(loai,value){
        //   modalContent += ``
           let i = 0
            for (i; i < value.length; i++) {
                if (value[i].isDoubleChair !== null && i + 1 < value.length) {
                    let nextSeat = value[i + 1]; 
                    modalContent += `<div class="seat-group-parent  doubSeat seat" style="display: flex;list-style: none;">
                                           <li  class="seat-group m-2">${value[i].hang_ghe}${value[i].so_hieu_ghe}</li>
                                           <li class="seat-group m-2">${value[i].hang_ghe}${nextSeat.so_hieu_ghe}</li>
                                       </div>`;
                    i++;
                }else{
                    modalContent += `<li class="customghe ${value[i].the_loai == 'thuong' ? 'regularchair' : 'seatVip'}">${value[i].hang_ghe}${value[i].so_hieu_ghe}</li>`;
                }             
            }
          //modalContent += `</p>`
        })
        modalContent+=`</div></div></div>
            <p>Suất chiếu: ${data.data.thoigiansuatchieu}</p>
            <p>Ngày vé mở xem: ${data.data.ngay_ve_mo}</p>
            <p>Ngày thanh toán: ${data.data.ngay_thanh_toan}</p>
            <p>Tổng tiền: ${data.data.tong_tien}đ</p>
            <p>Phương thức thanh toán: ${data.data.phuong_thuc_thanh_toan}</p>
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