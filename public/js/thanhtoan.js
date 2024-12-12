$(document).ready(function () {
    let dataidRemove = [];
    let countdownTime = 5 * 60; // 5 phút
    //{ 'data': dataSeatRemove, 'idRemove': dataidRemove }
    let countdownInterval;
    let timeve = localStorage.getItem('timeve');

    $.each($('.dataghechon'), function () {
        dataidRemove.push({ 'idCheck': $(this).attr('id'), 'type': $(this).attr('data-type') });
    })

    checktimemua()
    function checktimemua() {
        if (timeve <= 0) {
            localStorage.removeItem('timeve');
            localStorage.removeItem('idsuatchieu');
        } else {
            initializeCountdown()
        }
    }
    function initializeCountdown() {
        clearInterval(countdownInterval);

        if (timeve <= 0) {
            alert("Hết thời gian!");
            window.location.href = '/';
            return;
        }
        // Hiển thị thời gian còn lại
        updateTimerDisplay(timeve);

        countdownInterval = setInterval(function () {
            timeve--;
            if (timeve <= 0) {
                clearInterval(countdownInterval);
                alert("Hết thời gian!");
                postData()
                localStorage.removeItem('timeve');
                localStorage.removeItem('idsuatchieu');
                window.location.href = '/';
            } else {
                localStorage.setItem('timeve', timeve);
                updateTimerDisplay(timeve);
            }
        }, 1000);
    }
    // Hiển thị thời gian còn lại lên giao diện
    function updateTimerDisplay(seconds) {
        const minutes = Math.floor(seconds / 60);
        const secs = seconds % 60;
        $('.demthoigian').html(`${minutes}:${secs < 10 ? '0' + secs : secs}`);
    }

    // =======================================================================================
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
    console.log(+tongGia-(+$('.tongtienan').val()));
    

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
                    let tongdoan = +$('.tongtienan').val();
                    let tongve =  +tongGia - tongdoan
                    let giagiam = +tongve * (1 - Number(data.data.gia_tri_giam) / 100)
                    giagiam = Math.floor(giagiam / 1000) * 1000 + tongdoan
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
    $('.btn-submitthanhtoan').on('click',function(e){
       // e.preventDefault()
        localStorage.removeItem('idsuatchieu');
        localStorage.removeItem('timeve');
    })
})