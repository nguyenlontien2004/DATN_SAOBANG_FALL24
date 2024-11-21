import './bootstrap';
$(document).ready(function () {
    Echo.channel(`seat.${id}.${ngay}`)
        .listen('RealtimeSeat', (e) => {
            if (e.idRemove !== null) {
                e.idRemove.map(function (value) {
                    $(`#${value.idCheck}`).removeClass('takenSeat')
                })
            }
            if (e.dataSeat !== null) {
                e.dataSeat.map(function (value) {
                    $(`#${value.idCheck}`).addClass('takenSeat')
                })
            }
        });
})