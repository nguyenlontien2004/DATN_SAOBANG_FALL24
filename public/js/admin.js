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
