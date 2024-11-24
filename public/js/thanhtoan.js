$(document).ready(function () {
    let dataidRemove = [];
    let countdownTime = 5 * 60; // 5 phút
    //{ 'data': dataSeatRemove, 'idRemove': dataidRemove }
    $.each($('.dataghechon'), function () {
        dataidRemove.push({ 'idCheck': $(this).attr('id'), 'type': $(this).attr('data-type') });
    })

    const timer = setInterval(() => {
        const minutes = Math.floor(countdownTime / 60);
        const seconds = countdownTime % 60;

        $('.demthoigian').html(`0${minutes}:${seconds < 10 ? '0' : ''}${seconds}`)

        if (countdownTime < 0) {
            clearInterval(timer);
            alert("Hết thời gian giữ vé!");
            postData()
            window.location.replace('/')
        }
        countdownTime--;
        if (countdownTime < 0) {
            $('.demthoigian').html(`00:00`)
        }
    }, 1000);

    function postData() {
        $.ajax({
            url: `${urlaApiGhe}/${id}/${ngay}`,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { 'data': [], 'idRemove': dataidRemove },
            success: function (data) {
               
            },
            error: function (error) {
                console.log(error);
            }
        })
    }

    $('.thanhtoanquavi').on('click', function () {
        $(this).find('.viOline').prop('checked', true)
        $.each($('.thanhtoanquavi'), function () {
            $(this).removeClass('activeThanhToan')
        })
        $(this).addClass('activeThanhToan')
    })
    $('.btn-magiamgia').on('click', function () {
        let macode = $('.inputtextmagiamgia').val()

        if (macode == "" || $('.magiamgia').val() !== "") return
        $.ajax({
            url: `${urlApiMaGiamGia}`,
            method: 'POST',
            data: { 'macode': macode },
            success: function (data) {
                if (data?.data) {
                    let giagiam = +tongGia * (1 - Number(data.data.gia_tri_giam) / 100)
                    giagiam = Math.floor(giagiam / 1000) * 1000
                    $('.magiamgia').val(data.data.id)
                    $('.tongtien').val(giagiam)
                    $('.inputtextmagiamgia').prop('disabled', true)
                    $('.btn-magiamgia').prop('disabled', true)
                    $('.tonggiave').html(giagiam.toLocaleString('vi-VN'))
                    alert(data.msg)
                } else {
                    $('.inputtextmagiamgia').val("")
                    alert(data.msg)
                }
            },
            error: function (error) {
                console.log(error);
            }
        })
    })
})