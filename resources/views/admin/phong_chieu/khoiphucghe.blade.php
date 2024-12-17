@extends('admin.index')

@section('content')

<style>
    .select2-dropdown {
        z-index: 10000;
    }

    .takenSeat {
        z-index: 100;
    }

    .seat-group-parent {
        margin-bottom: 3px;
    }

    .empty {
        background-color: transparent;
    }

    .more-seat {
        padding-top: 10px;
    }

    .more-seat span {
        width: 25px;
        height: 25px;
        border-radius: 50%;
        border: 1px solid;
        cursor: pointer;
    }

    .icon-loading {
        position: absolute;
        width: 23px;
        height: 23px;
        border-radius: 50%;
        display: inline-block;
        border-top: 3px solid #FFF;
        border-right: 3px solid transparent;
        box-sizing: border-box;
        animation: rotation 1s linear infinite;
        top: 25%;
        left: 35%;
        transform: translate(-50%, -50%);
    }

    @keyframes rotation {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .loading {
        display: none;
        background-color: #515454;
        opacity: 0.55;
        top: 0;
        width: 100%;
        height: 100%;
        border-radius: 3px;
    }
</style>
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('admin.phongChieu') }}">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.quanLyGhecuaphong', $phongChieu->id) }}">Danh sách ghế của phòng chiếu
                        <strong>{{ $phongChieu->ten_phong_chieu }}</strong></a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Danh sách ghế ẩn</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="container-seat" style="max-width: 83rem;">
                <div class="mb-3"></div>
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <div class="seat-selection">
                            <div class="legend">
                                <div>
                                    <span class="taken"></span>
                                    <p>Ghế đã bán</p>
                                </div>
                            </div>
                            <span class="front">Màn hình</span>
                            <div class="seats-wrapper-parent">
                                <div class="seats-wrapper-row">
                                    <div class="seats-row">
                                        <div class="row-wrapper">
                                            <div class="seat-row">A</div>
                                            <div class="seat-row">B</div>
                                            <div class="seat-row">C</div>
                                            <div class="seat-row">D</div>
                                            <div class="seat-row">E</div>
                                            <div class="seat-row">F</div>
                                            <div class="seat-row">G</div>
                                            <div class="seat-row">H</div>
                                            <div class="seat-row">I</div>
                                        </div>
                                    </div>
                                    <div class="seats-map">
                                        <div class="row-wrapper list-row-seats">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12 order-sm-last">
                        <div class="container-ticket-information bg-white">
                            <div class="content-ticket-information d-flex w-full flex-wrap ">
                                <div class="ms-2 mt-1">
                                    <button class="btn btn-success btn-khoiphucghe">Khôi phục ghế</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('jsCreateSeat')
<script>
    let dataSeatRemove = []
    // hiển thị danh sách ghế
    showSeat()
    async function showSeat() {
        await $.ajax({
            url: "{{ route('admin.danhsachghean', $phongChieu->id) }}",
            method: 'get',
            success: function (data) {
                if (data.status == 200) {
                    let html = ''
                    $.each(data.data, function (row, seats) {
                        let seatRow = `<ul class="seat-row">`;
                        let i = 0;
                        if (seats.length <= 0) {
                            seatRow += `<li class="empty"></li>`;
                        }
                        while (i < seats.length) {
                            let seat = seats[i];
                            // Kiểm tra nếu là ghế đôi
                            if (seat.isDoubleChair !== null && i + 1 < seats.length) {
                                let nextSeat = seats[i + 1];  // Lấy ghế tiếp theo
                                // let idSeat = seats[i + 1];  // Lấy id ghế tiếp theo
                                // Ghép ghế đôi vào trong cùng một 
                                seatRow += `<div class="seat-group-parent ${seat.isBooked >= 1 && nextSeat.isBooked >= 1 ? 'takenSeat' : ''} doubSeat seat" data-type="${seat.the_loai}">
                                           <li id="${seat.id}" class="seat-group">${row}${seat.so_hieu_ghe}</li>
                                           <li id="${nextSeat.id}" class="seat-group">${row}${nextSeat.so_hieu_ghe}</li>
                                       </div>`;
                                i += 2; // Bỏ qua ghế tiếp theo vì đã ghép
                            } else {
                                // Ghế đơn
                                seatRow += `<li id="${seat.id}" data-type="${seat.the_loai}" class="${seat.the_loai == 'thuong' ? 'regularchair' : 'seatVip'} seat ${seat.isBooked >= 1 ? 'takenSeat' : ''}">${row}${seat.so_hieu_ghe}</li>`;
                                i++; // Xử lý ghế đơn tiếp theo
                            }
                        }
                        seatRow += `</ul>`;
                        html += seatRow
                    });
                    $('.row-wrapper.list-row-seats').html(html);
                }
            },
            error: function (error) {
                console.log('lỗi:', error);
            }
        })
    }

    $('.list-row-seats').on('click', '.seat', function () {
        // if ($(this).hasClass('takenSeat')) return
        let typeSeat = $(this).attr('data-type');
        if (typeSeat == 'thuong') {
            $(this).toggleClass('regularchair chooseSeat')
            checkExitsIdSeat($(this).attr('id'))
        } else if (typeSeat == 'vip') {
            $(this).toggleClass('seatVip chooseSeat')
            checkExitsIdSeat($(this).attr('id'))
        } else {
            $(this).toggleClass('doubSeat chooseSeat')
            $(this).find('li').each((_, e) => {
                checkExitsIdSeat($(e).attr('id'))
            })
        }
    })
    function checkExitsIdSeat(id) {
        if (!dataSeatRemove.some(item => item == id)) {
            dataSeatRemove.push(id)
        } else {
            dataSeatRemove = dataSeatRemove.filter(item => item !== id)
        }
    }
    $('.btn-khoiphucghe').on('click', function () {
        console.log(dataSeatRemove);
        $.ajax({
            url: "{{ route('admin.restoreghe') }}",
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { 'datarestore': dataSeatRemove },
            success: function (data) {
                if (data.status == 200) {
                    showSeat()
                    $.notify({
                        icon: 'icon-bell',
                        title: 'Khôi phục thành công',
                        message: '',
                    }, {
                        type: 'success',
                        placement: {
                            from: "top",
                            align: "right"
                        },
                        time: 1000,
                    });
                } else {
                    $.notify({
                        icon: 'icon-bell',
                        title: 'Khôi phục không thành công',
                        message: '',
                    }, {
                        type: 'danger',
                        placement: {
                            from: "top",
                            align: "right"
                        },
                        time: 1000,
                    });
                }
            },
            error: function (error) {
                console.log('lỗi:', error);
                $.notify({
                    icon: 'icon-bell',
                    title: 'Khôi phục không thành công ',
                    message: '',
                }, {
                    type: 'danger',
                    placement: {
                        from: "top",
                        align: "right"
                    },
                    time: 1000,
                });
            }
        })
    })

</script>
@endsection
<!-- jqueySeat -->
@endsection