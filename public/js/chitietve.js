$(document).ready(function () {
  const today = new Date();
  const year = today.getFullYear();
  getMovieScreenings()
  $('.chooseDate').on('click', function () {
    let date = $(this).attr('data-date')
    if (currDate == date) return;
    currDate = date
    $('.chooseDate').map(function () {
      $(this).removeClass('active-date')
    })
    $(this).addClass('active-date')
    getMovieScreenings()
  })
  function getMovieScreenings() {
    $('.loading-suat').show()
    $('.container-booth').html('')
    $.ajax({
      url: `http://127.0.0.1:8000/api/suat-chieu/phim/${idMovie}/${currDate}`,
      method: 'get',
      success: function (data) {
        if (data.status == 200) {
          let listSuatchieuRap = data.data
          let list = listSuatchieuRap.map(function (value) {
            let html = `<div class="border-bottom p-2" style="user-select: none;">
                            <div>
                                <p><strong>${value.ten_rap}</strong></p>
                                <p>${value.dia_diem}</p>
                            </div>
                            <div class="d-flex pt-1 flex-wrap" style="cursor: pointer;">`
            value.suatChieu.map(function (va) {
              return html += `<a href="/dat-ve/${va.id}/${currDate + '-' + year}" class="${va.suat_chieu_trong_ngay ? 'disabled' : ''}"><div class="btn-somtime mr-1">${va.gio_bat_dau}~${va.gio_ket_thuc}</div></a>`
            })
            html += `</div></div>`
            return value.suatChieu.length > 0 ? html : ''
          })
          $('.loading-suat').hide()
          $('.container-booth').html(list)
        }
      },
      error: function (error) {
        console.log(error);
        $('.loading-suat').hide()
      }
    })
  }
})
