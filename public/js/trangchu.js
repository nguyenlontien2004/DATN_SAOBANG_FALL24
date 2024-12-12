$(document).ready(function () {
    console.log(idrap);
    getMovieScreenings(idrap,currDate)
    $('.chooseDate').on('click', function () {
        let date = $(this).attr('data-date')
        if (currDate == date) return;
        currDate = date
        $('.chooseDate').map(function () {
            $(this).removeClass('active-date')
        })
        $(this).addClass('active-date')
        getMovieScreenings(idrap,currDate)
    })
    $('.danhsachrap').on('click', function () {
        let id = $(this).attr('data-idrap')
        if (idrap == id) return
        idrap = id
        $('.danhsachrap').map(function () {
            $(this).removeClass('rap-active')
        })
        $(this).addClass('rap-active')        
        getMovieScreenings(idrap,currDate)
    })
    function getMovieScreenings(id,ngay) {
        $('.loading-suat').show()
        $('.suatchieuphim').html('')
        $('.thongtindiachirap').html('')
        $.ajax({
            url: `${urlApi}/${id}/${ngay}`,
            method: 'get',
            success: function (data) {
                if (data.status == 200) {
                    const html = htmllistphim(data.data.phim)
                    const htmlRap = htmlTTrap(data.data.rap)
                    $('.suatchieuphim').html(html);
                    $('.thongtindiachirap').html(htmlRap)
                }
                $('.loading-suat').hide()
            },
            error: function (error) {
                console.log(error);
                $('.loading-suat').hide()
            }
        })
    }
    function htmllistphim(data) {
        let html = ''
        $.each(data, function (_,item) {
            console.log(item);

            html += `<div class="cart-movie mb-2">
         <div class="row mt-3 mb-3 ms-1 mr-1">
            <div class="col-2 col-sm-2">
                <a class="" href="${linkWeb}thanh-vien/chitietphim/${item.id}">
                    <img class="radius7px" width="95px" src="${urlLink+'/'+item.anh_phim}" style="border-radius: 5px;">
                </a>
            </div>
            <div class="col" style="margin-left: -14px;">
                <h2 class="mb-1" style="color:#12263f;font-weight: 500;">${item.ten_phim}</h2>
                <div>
                    <label style="color:#12263f;font-weight: 500;font-size: 13.5px;">Suất chiếu</label>
                    <div class="d-flex flex-wrap">`
             $.each(item.suat_chieus,function(_,val){
                let link = linkWeb+'dat-ve/'+val.id+'/'+currDate.split('-').reverse().join('-');
                html+=`<a href="${!val.suat_chieu_trong_ngay ? link : ''}" class="${val.suat_chieu_trong_ngay ? 'disabled' : ''}">
                <div class="btn-somtime mr-1">${val.gio_bat_dau}~${val.gio_ket_thuc}</div>
                 </a>`
             })
                html+=`</div>
                </div>
             </div>
           </div>
      </div>`
        })
        return html;///${val.id}/${currDate.split('-').reverse().join('-')}
    }
    function htmlTTrap(rap){
        let html = `
             <div class="alert d-flex align-items-center mt-2"
                        style="background-color: #edf2f9;color: #283e59;padding:15px 20px;" role="alert">
                        <div>
                            <p class="ms-2">${rap.ten_rap}</p>
                            <span class="ms-2">${rap.dia_diem}</span>
                        </div>
                    </div>
        `
        return html
    }
})