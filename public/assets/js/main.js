function playVideo(url) {
    document.getElementById('video').src = url;
    $('#videoModal').modal('show'); // Hiển thị modal video
}

function closeModal() {
    document.getElementById('video').src = ''; // Dừng video khi đóng modal
    $('#videoModal').modal('hide'); // Ẩn modal
}
function autoResize(textarea) {
    textarea.style.height = 'auto'; // Reset height
    textarea.style.height = textarea.scrollHeight + 'px'; // Set new height based on content
}
// JS đặt vé
document.addEventListener("DOMContentLoaded", () => {
    const seats = document.querySelectorAll(".seat");
    const summary = document.querySelector(".summary-details");
    const selectedSeats = [];
  
    seats.forEach(seat => {
      seat.addEventListener("click", () => {
        // Toggle selection status
        seat.classList.toggle("selected");
  
        // Get seat details
        const seatName = seat.getAttribute("data-seat");
        const seatType = seat.classList.contains("vip") ? "vip" : "regular";
        const seatPrice = seatType === "vip" ? 20 : 10;
        const seatIndex = selectedSeats.findIndex(s => s.name === seatName);
  
        // Update selected seats
        if (seatIndex >= 0) {
          selectedSeats.splice(seatIndex, 1); // Remove seat
        } else {
          selectedSeats.push({ name: seatName, price: seatPrice }); // Add seat
        }
  
        // Update summary
        // const seatNumbers = selectedSeats.map(s => s.name).join(", ");
        // const totalPrice = selectedSeats.reduce((total, s) => total + s.price, 0);
        // summary.querySelector("p:nth-child(2)").textContent = `Seats: ${seatNumbers}`;
        // summary.querySelector("p:nth-child(3)").textContent = `Total: $${totalPrice}`;
      });
    });
  });
// Lấy phần tử lịch chiếu
var showtimesDiv = document.getElementById("showtimes");

// Kiểm tra xem trạng thái hiển thị của lịch chiếu đã được lưu trong localStorage chưa
if (localStorage.getItem("showtimesVisible") === "true") {
    showtimesDiv.style.display = "block"; // Hiển thị lịch chiếu
} else {
    showtimesDiv.style.display = "none";  // Ẩn lịch chiếu
}

// Lắng nghe sự kiện click vào phần thông tin rạp chiếu
document.getElementById("showtimesToggle").onclick = function() {
    // Kiểm tra trạng thái hiển thị của lịch chiếu
    if (showtimesDiv.style.display === "none") {
        showtimesDiv.style.display = "block";  // Hiển thị lịch chiếu
        localStorage.setItem("showtimesVisible", "true"); // Lưu trạng thái hiển thị
    } else {
        showtimesDiv.style.display = "none";  // Ẩn lịch chiếu
        localStorage.setItem("showtimesVisible", "false"); // Lưu trạng thái ẩn
    }
};
// Lấy phần tử lịch chiếu
var showtimesDiv = document.getElementById("showtimes");

// Lắng nghe sự kiện click vào phần thông tin KĐA
document.getElementById("showtimesToggle").onclick = function() {
    // Kiểm tra trạng thái hiển thị của lịch chiếu
    if (showtimesDiv.style.display === "none") {
        showtimesDiv.style.display = "block";  // Hiển thị lịch chiếu
    } else {
        showtimesDiv.style.display = "none";  // Ẩn lịch chiếu
    }
};
//Tab ẩn đánh giá
    function showReviewTab() {
        document.getElementById('reviewTab').style.display = 'block';
    }
//Chọn điểm đánh giá
function setRating(rating) {
    // Cập nhật giá trị của input rating
    document.getElementById('rating').value = rating;
    
    // Cập nhật màu sắc của các ngôi sao
    let stars = document.querySelectorAll('#stars span');
    stars.forEach(star => {
        if (parseInt(star.getAttribute('data-value')) <= rating) {
            star.classList.add('text-warning');  // Màu vàng (được chọn)
            star.classList.remove('text-muted'); // Bỏ màu xám (chưa chọn)
        } else {
            star.classList.add('text-muted');   // Màu xám (chưa chọn)
            star.classList.remove('text-warning');
        }
    });
}

  
  