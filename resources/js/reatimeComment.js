import './bootstrap';
$(document).ready(function () {
    Echo.channel(`binhLuan.phim.${idMovie}`)
        .listen('RealtimeComment', (e) => {
            const content = htmlComment(e.anh,e.ten,e.ngay,e.noidung)
            $('.container-binhluan').prepend(content)
        });
        function htmlComment(anh,ten,curtime,noidung){
            let html = `
             <div class="d-flex mb-1" style="border-bottom: 1px solid #dadada; justify-content: flex-start;flex-direction: column;    align-items: flex-start;">
                <div class="d-flex">
                     <img src="${anh}"
                        alt="đại diện"
                        style="width: 37px; height: 37px; border-radius: 50%; object-fit: cover;"
                        alt="User" class="rounded-circle me-3" style="width: 40px; height: 40px;" />
                    <div>
                        <h6 class="mb-1" style="font-weight: bold;">${ten}</h6>
                        <span class="text-muted" style="font-size: 12px;">${curtime}</span>
                    </div>
                </div>
                <div>
                    <p class="mb-1 ms-1 mt-1" style="font-size: 16px; color: #333;">${noidung}</p>
                </div>
            </div>
            `
            return html
        }
})