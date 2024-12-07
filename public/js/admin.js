// lọc theo thể loại trong phim
document
    .querySelector('select[name="the_loai"]')
    .addEventListener("change", function () {
        const filterForm = document.getElementById("filterForm");
        filterForm.submit();
    });
function search() {
    const query = document.getElementById("searchInput").value.trim();

    if (!query) {
        document.getElementById("searchResults").style.display = "none";
        return;
    }

    // Gửi yêu cầu AJAX tới server với giá trị tìm kiếm
    const xhr = new XMLHttpRequest();
    xhr.open("GET", `/search?query=${query}`, true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            // Nhận kết quả tìm kiếm từ server và hiển thị
            const results = JSON.parse(xhr.responseText);
            const resultContainer = document.getElementById("searchResults");

            // Nếu có kết quả, hiển thị chúng
            if (results.length > 0) {
                let html = "";
                results.forEach((result) => {
                    html += `<div>${
                        
                        result.ten_dao_dien || result.ten_dien_vien
                    }</div>`;
                });
                resultContainer.innerHTML = html;
                resultContainer.style.display = "block";
            } else {
                resultContainer.innerHTML = "<div>No results found</div>";
                resultContainer.style.display = "block";
            }
        }
    };
    xhr.send();
}
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

                const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
                const code = jsQR(imageData.data, canvas.width, canvas.height);
                if (code) {
                    const scannedLink = code.data;
                    document.getElementById("qrResult").innerHTML = `
                        <p>Link quét được: <strong>${scannedLink}</strong></p>
                    `;

                    // Dừng camera
                    clearInterval(intervalId);
                    stream.getTracks().forEach((track) => track.stop());
                    video.style.display = "none";

                    // Gọi API để lấy thông tin vé
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

// Hàm gọi API để lấy thông tin vé
const fetchTicketInfo = async (ticketId) => {
    try {
        const response = await fetch(`http://127.0.0.1:8000/api/check-qrCode/${ticketId}`);
        const qrResult = document.getElementById("qrResult");

        if (response.ok) {
            const data = await response.json();
            // Hiển thị modal với thông tin vé
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

// Hàm hiển thị modal
const showModal = (data) => {
    const modalContent = `
        <div class="modal-header">
            <h5 class="modal-title">Thông tin vé</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <p>ID vé: ${data.id}</p>
            <p>Người dùng: ${data.nguoi_dung_id}</p>
            <p>Suất chiếu: ${data.suat_chieu_id}</p>
            <p>Mã giảm giá: ${data.ma_giam_gia_id || "Không có"}</p>
            <p>Ngày thanh toán: ${data.ngay_thanh_toan}</p>
            <p>Tổng tiền: ${data.tong_tien}</p>
            <p>Phương thức thanh toán: ${data.phuong_thuc_thanh_toan}</p>
            <p>Trạng thái: ${data.trang_thai}</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            <button id="printTicketButton" class="btn btn-primary">In vé</button>
        </div>
    `;

    // Tạo modal
    const modal = document.getElementById("ticketModal");
    modal.querySelector('.modal-content').innerHTML = modalContent;

    // Hiển thị modal
    $(modal).modal('show');

    document.getElementById("printTicketButton").addEventListener("click", () => {
        window.print();
    });
};
