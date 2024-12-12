$(document).ready(function () {
    let dataSeatRemove = []
    let dataidRemove = []
    let dataHang = []
    let dataFood = []
    let tonggia = 0
    let tongFood = 0
    let tongVe = 0
    let page = 0

    
    let countdownInterval;
    let timeve = 0;
    
    checksuatchieu()
    
   function checksuatchieu(){
    let countdownTime = 7 * 60; // 10 phút (giây)
    const idsuat = id
    const getidsuat = localStorage.getItem('idsuatchieu')
    const expiryTime = localStorage.getItem('timeve')

    if (getidsuat == null) {        
      localStorage.setItem('idsuatchieu', id)
      localStorage.setItem('timeve', countdownTime);
      timeve = countdownTime
    } else {
      if (getidsuat == idsuat) {
          localStorage.setItem('timeve', expiryTime);
          timeve = expiryTime
      } else {
        localStorage.setItem('idsuatchieu', idsuat)
        localStorage.setItem('timeve', countdownTime);
        timeve = countdownTime
      }
    }
   
   }

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
                dataidRemove = dataSeatRemove
                dataSeatRemove = []
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
        document.getElementById('timer').innerText = `${minutes}:${secs < 10 ? '0' + secs : secs}`;
    }




    //============================================= 
    $('.list-row-seats').on('click', '.seats', function () {
        if ($(this).hasClass('takenSeat') || $(this).hasClass('unavailabledrop')) return
        let typeSeat = $(this).attr('data-type');
        if (typeSeat == 'thuong') {
            $(this).toggleClass('regularchair chooseSeat')
            checkExitsIdSeat($(this).attr('id'), false, $(this).attr('id'), $(this).attr('data-type'))
            checkExitsHang($(this).attr('data-hang'), $(this).attr('id'))
        } else if (typeSeat == 'vip') {
            $(this).toggleClass('seatVip chooseSeat')
            checkExitsIdSeat($(this).attr('id'), false, $(this).attr('id'), $(this).attr('data-type'))
            checkExitsHang($(this).attr('data-hang'), $(this).attr('id'))
        } else {
            let arrayIdDouble = []
            $(this).toggleClass('doubSeat chooseSeat')
            $(this).find('li').each((_, e) => {
                arrayIdDouble.push($(e).attr('id'))
                checkExitsHang($(e).attr('data-hang'), $(e).attr('id'))
            })
            checkExitsIdSeat(arrayIdDouble, true, arrayIdDouble.join('-'), $(this).attr('data-type'))
        }
        // console.log(dataSeatRemove);
        // console.log(dataHang);
        tinhToanve()
        postData()

    })
    function tinhToanve() {
        let reduceHang = dataHang.map(item => item.hang).join(' ')
        if (dataHang.length > 0) {
            $('.so-hieu-hang-ghe').html(reduceHang)
            $('.action-next').removeClass('disabled')
        } else {
            $('.so-hieu-hang-ghe').html('...')
            $('.action-next').addClass('disabled')
        }
        tongVe = dataSeatRemove.reduce((sum, seat) => {
            if (seat.type == 'thuong') {
                return sum + Number(gia)
            } else if (seat.type == 'vip') {
                return sum + Number(gia) + 10000
            } else {
                return sum + Number(gia) * 2 + 15000
            }
        }, 0)
        tonggia = tongVe + tongFood
        $('.total').html(tonggia.toLocaleString('vi-VN'))
    }

    function postData() {
        $.ajax({
            url: `${urlaApiGhe}/${id}/${ngay}`,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { 'data': dataSeatRemove, 'idRemove': dataidRemove },
            success: function (data) {
                console.log(data);
            },
            error: function (error) {
                console.log(error);
            }
        })
        dataidRemove = []
    }
    function checkExitsIdSeat(id, isDouble = false, idCheck, type) {
        if (!dataSeatRemove.some(item => item.idCheck == idCheck)) {
            dataSeatRemove.push({ 'id': id, 'isDouble': isDouble, 'idCheck': idCheck, 'type': type })
        } else {
            dataidRemove = dataSeatRemove.filter(item => item.idCheck == idCheck);
            dataSeatRemove = dataSeatRemove.filter(item => item.idCheck !== idCheck)
        }
    }
    function checkExitsHang(hang, id) {
        if (!dataHang.some(item => item.id == id)) {
            dataHang.push({ 'id': id, 'hang': hang })
        } else {
            dataHang = dataHang.filter(item => item.id !== id)
        }
    }
    $('.btn-next-foof').on('click', function () {
        $('.choose-seat').hide()
        $('.choose-food').show()
        $('.action-pre').removeClass('disabled')
        $('.wrapper-content').each(function () {
            $(this).removeClass('text-danger')
        })
        $('.chonDoAn').addClass('text-danger')
        if (page == 1) {
            // console.log('hàng ghế:', dataHang);
            // console.log('Đồ ăn:', dataFood);
            // console.log('Tổng:' + tonggia);
            if(kiemtrahansuatchieu == false){
                alert('Suất chiếu này đã hết hạn mời bạn chọn các suất chiếu khác!')
                return;
            }
            fetApiredirect_url()
        }
        page = 1
    })
    function fetApiredirect_url() {
        dataFood = dataFood.filter(item => item.soluong > 0)
        $('.loading-chuyen-trang').show()
        $.ajax({
            url: `${urlaApiThanhToan}/${id}/${ngay}`,
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: JSON.stringify({ 'idSuatChieu': id, 'ngayvemo': ngay, 'hangghe': dataHang, 'doan': dataFood, 'tong': tonggia }),
            success: function (data) {
                if (data.status == 200) {
                    window.location.href = data.redirect_url
                }
                $('.loading-chuyen-trang').hide()
            },
            error: function (error) {
                $('.loading-chuyen-trang').hide()
                console.log('lỗi trong quá trình thanh toán', error);
            }
        })
    }
    $('.action-pre').on('click', function () {
        $('.choose-seat').show()
        $('.choose-food').hide()
        $('.action-pre').addClass('disabled')
        $('.wrapper-content').each(function () {
            $(this).removeClass('text-danger')
        })
        $('.chonghe').addClass('text-danger')
        page = 0
    })
    $('.plus').on('click', function () {
        const id = $(this).attr('id')
        var currenValue = parseInt($(`.quanlity-${id}`).val())
        var gia = $(`.quanlity-${id}`).attr('data-gia')
        $(`.quanlity-${id}`).val(currenValue + 1)
        checkExitsFood(id, currenValue + 1, gia)
        tongDoan()
    })
    $('.minus').on('click', function () {
        const id = $(this).attr('id')
        var currenValue = parseInt($(`.quanlity-${id}`).val())
        var gia = $(`.quanlity-${id}`).attr('data-gia')
        if (currenValue == 0) return
        $(`.quanlity-${id}`).val(currenValue - 1)
        checkExitsFood(id, currenValue - 1, gia)
        tongDoan()
    })
    function checkExitsFood(id, soluong, gia) {
        if (!dataFood.some(item => item.idFood == id)) {
            dataFood.push({ 'idFood': +id, 'soluong': soluong, 'gia': +gia })
        } else {
            dataFood.find(item => item.idFood == id).soluong = soluong
            //dataFood = dataFood.filter(item => item.soluong !== 0)
        }
    }
    function tongDoan() {
        tongFood = dataFood.reduce((sum, food) => {
            return sum + (food.soluong * food.gia)
        }, 0)
        tonggia = tongVe + tongFood
        $('.total').html(tonggia.toLocaleString('vi-VN'))
    }
})
