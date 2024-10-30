<script>
    $(document).ready(function () {
        let isChooseTypeSeat = false
        let seatIndex = 0
        let seatsRow = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'];
        let seatsTemp = [];
        let dataSeatRemove = []
        let classTypeSeat = ''
        let selectedSeats = { 'idSeat': [], 'sttRow': [] }
        $('.js-example-basic-seats-0').select2({
            placeholder: "Mời chọn hàng ghế",
            data: seatsRow
        });

        $('.seat-fields').on('input', '.select-seat', function () {
            const idSelect = $(this).attr('id')
            let newSeatRow = seatsRow.filter(item => {
                return $.inArray(item, $(this).val()) == -1
            })
            if (seatsTemp.length > 0 && seatsTemp.some(i => i?.id == idSelect)) {
                seatsTemp = seatsTemp.map(seat => seat.id === idSelect ? { id: idSelect, value: $(this).val().length < seat.value.length ? seat.value : $(this).val() } : seat);
            } else {
                seatsTemp = [...seatsTemp, { id: idSelect, value: $(this).val() }]
            }

            checkSeatIndex(idSelect, $(this).val(), newSeatRow)
        })
        function checkSeatIndex(idSelect, value, newSeatRow) {
            let listSeatIndex = seatsTemp.find(seat => seat.id === idSelect)
            if (idSelect == 0) {
                if (seatIndex == idSelect) {
                    if (value.length !== listSeatIndex.value.length) {
                        let addSeatRow = listSeatIndex.value.find((item => {
                            return $.inArray(item, value) == -1
                        }))
                        seatsRow = [addSeatRow, ...seatsRow]
                        let updataValueSeat = seatsTemp.find(item => item?.id == idSelect)
                        updataValueSeat.value = listSeatIndex.value.filter(item => item != addSeatRow)
                    } else {
                        seatsRow = newSeatRow
                    }
                } else {
                    addOrremoveOption(idSelect, seatIndex, value, listSeatIndex, newSeatRow, false);
                }

            } else if (idSelect == 1) {
                addOrremoveOption(idSelect, seatIndex, value, listSeatIndex, newSeatRow, true);
            } else {
                addOrremoveOption(idSelect, seatIndex, value, listSeatIndex, newSeatRow, true);
            }
        }
        function addOrremoveOption(idSelect, seatIndex, value, listSeatIndex, newSeatRow, flag = false) {

            if (value.length != listSeatIndex.value.length) {
                let addSeatRow = listSeatIndex.value.find((item => {
                    return $.inArray(item, value) == -1
                }))
                seatsRow = [addSeatRow, ...seatsRow]
                let updataValueSeat = seatsTemp.find(item => item?.id == idSelect)
                updataValueSeat.value = listSeatIndex.value.filter(item => item != addSeatRow)

                $('.seat-fields .select-seat').each(function (index) {
                    const idSelectSeatAll = $(this).attr('id')

                    if (idSelectSeatAll != idSelect) {
                        $(this).append(`<option value="${addSeatRow}"">${addSeatRow}</option>`);
                        $(this).trigger('change');
                    }
                });
            } else {
                seatsRow = newSeatRow

                $('.seat-fields .select-seat').each(function (index) {
                    const idSelectSeatAll = $(this).attr('id')

                    if (idSelectSeatAll != idSelect) {
                        $(this).find('option').each(function (index) {
                            const optionValue = $(this).val();
                            if (value[value.length - 1] == optionValue) {
                                $(this).remove()
                            }
                        })
                        $(this).find(`option[value="${value[value.length - 1]}`).remove()
                        $(this).trigger('change');
                    }
                });
            }



        }
        $('#create-input-seats').on('click', function () {

            if (seatIndex == 0) {
                if ($('.js-example-basic-seats-0').val().length <= 0) return
            } else {
                if ($('.js-example-basic-seats-' + seatIndex).val().length <= 0) return
            }
            let currentValueTypeSeat = $('.typeSeat-' + seatIndex).val()

            let newSeatRow = seatsRow.filter(item => {
                return $.inArray(item, seatIndex == 0 ? $('.js-example-basic-seats').val() : $('.js-example-basic-seats-' + seatIndex).val()) === -1
            })
            seatsRow = newSeatRow

            if (seatsRow.length <= 0 || seatIndex > 1) return

            seatIndex++

            let html = `
              <div class="row create-seats-row" id="${seatIndex}">
                                <div class="col-md-12 px-3">
                                    <div class="input-group input-group-static" style="padding: 0 12px;">
                                        <label for="exampleFormControlSelect1" style="width:100%;"
                                            class="ms-0 pt-3 pb-1">Hàng ghế</label>
                                        <select id="${seatIndex}" class="js-example-basic-seats-${seatIndex} select-seat form-control" name="seats${seatIndex}[]"
                                            multiple="multiple" style="width:100%;" required>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 d-flex">
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlSelect1">Loại ghế</label>
                                        <select class="form-select typeSeat typeSeat-${seatIndex}" name="typeSeat-${seatIndex}" id="${seatIndex}">
                                            <option value="thuong">Ghế Thường</option>
                                            <option value="vip">Ghế Vip</option>
                                            <option value="doi">Ghế Đôi</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email2">Số lượng</label>
                                        <input type="number" min="0" max="12" required class="form-control totalSeat totalSeat-${seatIndex}" name="totalSeat-${seatIndex}" id="${seatIndex}" style="padding: 4px 5px;">
                                    </div>
                                </div>
             </div> `

            $('.seat-fields').append(html);

            // checkSeatTypeOptions(seatIndex, currentValueTypeSeat)

            $('.js-example-basic-seats-' + seatIndex).select2({
                placeholder: "Mời chọn hàng ghế",
                data: newSeatRow
            });

        })

        // function checkSeatTypeOptions(seatIndex, currTypeSeat) {
        //     let typeseat = $('.typeSeat-' + seatIndex)
        //     typeseat.find('option').each(function () {
        //         for (let i = 0; i < seatIndex; i++) {
        //             if ($(this).val() == $('.typeSeat-' + i).val()) {
        //                 $(this).remove()
        //             }
        //         }

        //     })
        // }

        $('.list-row-seats').on('click', '.seat', function () {
            if ($(this).hasClass('takenSeat')) return
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
        // xoá hàng ghế
        $('.btn-remoreSeat').on('click', function () {
            if (dataSeatRemove.length <= 0) {
                $.notify({
                    icon: 'icon-bell',
                    message: 'Bạn chưa chọn ghế cần xoá?',
                }, {
                    type: 'danger',
                    placement: {
                        from: "top",
                        align: "right"
                    },
                    time: 1000,
                });
                return
            }
            $('.loading').show()
            $.ajax({
                url: "{{ route('admin.deleteGhengoi') }}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: JSON.stringify(dataSeatRemove),
                success: function (data) {
                    if (data.status === 200) {
                        $.notify({
                            icon: 'icon-bell',
                            title: 'Xoá thành công',
                            message: '',
                        }, {
                            type: 'success',
                            placement: {
                                from: "top",
                                align: "right"
                            },
                            time: 1000,
                        });
                    }
                    dataSeatRemove = []
                    $('.loading').hide()
                    showSeat()
                },
                error: function (error) {
                    console.log('lỗi', error);
                    dataSeatRemove = []
                    $('.loading').hide()
                }
            })
            showSeat()
        })

        // show modal sửa hàng ghê
        $('#editTypeSeat li').on('click', function () {
            const type = $(this).attr('data-type')
            if (classTypeSeat == type) {
                $('#staticBackdrop').modal('show')
                return
            }
            selectedSeats = { 'idSeat': [], 'sttRow': [] }
            $.ajax({
                url: `{{ url('admin/get/loai-ghe/phong-chieu/' . $phongChieu->id) }}/${type}`,
                method: 'get',
                success: function (data) {
                    if (data.status == 200) {
                        classTypeSeat = type
                        const seatsType = data.data
                        let html = ''
                        $.each(seatsType, (row, seats) => {
                            let seatRow = ` <ul class="d-flex mb-0 ps-0 flex-wrap" style="list-style: none;" data-row="${row}">`;
                            let i = 0
                            for (i; i < seats.length; i++) {
                                let seat = seats[i]
                                if (seat.isDoubleChair !== null && i + 1 < seats.length) {
                                    seatRow += `
                                       <div class="doubSeat rounded d-flex m-2 editSeat" style="width:50px;height:25px;"
                                           data-type="${seat.the_loai}">
                                           <li data-stt="${seat.so_hieu_ghe}" id="${seat.id}" class="seat-group d-flex justify-content-center align-items-center"
                                               style="width:25px;height:25px">
                                                 ${row + seat.so_hieu_ghe}
                                           </li>
                                           <li data-stt="${seats[i + 1].so_hieu_ghe}" id="${seats[i + 1].id}" class="seat-group d-flex justify-content-center align-items-center"
                                               style="width:25px;height:25px">
                                                   ${row + seats[i + 1].so_hieu_ghe}
                                           </li>
                                       </div>`
                                    i++
                                } else {
                                    seatRow += `<li id="${seat.id}" data-stt="${seat.so_hieu_ghe}" data-type="${seat.the_loai}" style="width:25px;height:25px" data-type="${seat.the_loai}" class="m-2 d-flex justify-content-center align-items-center editSeat rounded ${seat.the_loai == 'thuong' ? 'regularchair' : 'seatVip'} seat">${row + seat.so_hieu_ghe}</li>`;
                                }
                            }
                            seatRow += `</ul>`;
                            html += seatRow
                        });
                        $('.list-type-seat').html(html)
                        $('#staticBackdrop').modal('show')
                        $('.warning').html('')
                        $('.typeSeatedit').val(0)
                        $('.typeSeatedit').find('option').each((_, e) => {
                            if ($(e).val() == type) {
                                $(e).hide()
                            }
                            else {
                                $(e).show()
                            }
                        })
                    }
                },
                error: function (error) {
                    console.log('lỗi:', error);
                    $.notify({
                        icon: 'icon-bell',
                        title: 'Lỗi',
                        message: '',
                    }, {
                        type: 'error',
                        placement: {
                            from: "top",
                            align: "right"
                        },
                        time: 1000,
                    });
                }
            })
        })
        //
        $('.list-type-seat').on('click', '.editSeat', function () {
            let typeSeat = $(this).attr('data-type');
            let dataRow = $(this).closest('ul').attr('data-row')
            if (typeSeat == 'thuong') {
                $(this).toggleClass('regularchair chooseSeat')
                PushAndRemoveRow($(this).attr('id'), dataRow, $(this).attr('data-stt'))
            } else if (typeSeat == 'vip') {
                $(this).toggleClass('seatVip chooseSeat')
                PushAndRemoveRow($(this).attr('id'), dataRow, $(this).attr('data-stt'))
            } else {
                $(this).toggleClass('doubSeat chooseSeat')
                $(this).find('li').each((_, e) => {
                    PushAndRemoveRow($(e).attr('id'), dataRow, $(e).attr('data-stt'))
                })
            }
        })
        function PushAndRemoveRow(id, row, stt) {
            if (!selectedSeats['idSeat'][row] && !selectedSeats['sttRow'][row]) {
                selectedSeats['idSeat'] = { ...selectedSeats['idSeat'], [row]: [] };
                selectedSeats['sttRow'] = { ...selectedSeats['sttRow'], [row]: [] };
            }
            if (selectedSeats['idSeat'][row].some(item => item == id) && selectedSeats['sttRow'][row].some(item => item == stt)) {
                selectedSeats['idSeat'][row] = selectedSeats['idSeat'][row].filter(item => item !== id)
                selectedSeats['sttRow'][row] = selectedSeats['sttRow'][row].filter(item => item !== stt)
            } else {
                selectedSeats['idSeat'][row].push(id);
                selectedSeats['sttRow'][row].push(stt);
            }
            selectedSeats['idSeat'][row].sort((a, b) => a - b)
            selectedSeats['sttRow'][row].sort((a, b) => a - b)
        }

        // sửa ghế
        $('.btn-submitEditSeat').on('click', function () {
            let valid = true
            isEmptyObjectWithArrays(selectedSeats['idSeat'], selectedSeats['sttRow'])
            if ($('.typeSeatedit').val() == 0 || Object.entries(selectedSeats['idSeat']).length == 0) {
                $('.warning').html('Bạn hãy chọn ghế và loại ghế để thay đổi?')
                return
            }
            if ($('.typeSeatedit').val() == 'doi') {
                valid = checkTypeDouble(selectedSeats['sttRow'])
            }
            if (!valid) {
                $('.warning').html('Phải để ghế chắn hoặc hai ghế có stt cạnh nhau khi chọn đổi loại ghế đôi?')
                return
            }
            $('.warning').html('')
            $.ajax({
                url: "{{ route('admin.update', $phongChieu->id) }}",
                method: 'post',
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: JSON.stringify({ 'seat': selectedSeats, 'type': $('.typeSeatedit').val() }),
                success: function (data) {
                    if (data.status == 200) {
                        $.notify({
                            icon: 'icon-bell',
                            title: 'Cập nhật thành công',
                            message: '',
                        }, {
                            type: 'success',
                            placement: {
                                from: "top",
                                align: "right"
                            },
                            time: 1000,
                        });
                        showSeat()
                    } else {
                        $.notify({
                            icon: 'icon-bell',
                            title: 'Cập nhật thất bại',
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
                    console.log(error);
                    $.notify({
                        icon: 'icon-bell',
                        title: 'Cập nhật thất bại',
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
            selectedSeats = { 'idSeat': [], 'sttRow': [] }
            classTypeSeat = ''
            $('#staticBackdrop').modal('hide')
        })
        function checkTypeDouble(objectTypeSeat) {
            let flag = true
            $.each(objectTypeSeat, function (index, stt) {
                if (stt.length % 2 !== 0) {
                    flag = false
                    return
                }
                for (let i = 0; i < stt.length; i++) {
                    if (+stt[i] + 1 != +stt[i + 1]) {
                        flag = false
                    }
                    i++
                }
            })
            return flag
        }
        function isEmptyObjectWithArrays(objIdSeat, objectSttRow) {
            Object.keys(objIdSeat).forEach(key => {
                if (Array.isArray(objIdSeat[key]) && objIdSeat[key].length === 0) {
                    delete objIdSeat[key];  // Xóa các trường có mảng rỗng
                }
            });
            Object.keys(objectSttRow).forEach(key => {
                if (Array.isArray(objectSttRow[key]) && objectSttRow[key].length === 0) {
                    delete objectSttRow[key];  // Xóa các trường có mảng rỗng
                }
            });
        }
        // hiển thị danh sách ghế
        showSeat()
        async function showSeat() {
            await $.ajax({
                url: "{{ route('admin.showSeats', $phongChieu->id) }}",
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
                                    seatRow += `<div class="seat-group-parent ${seat.isBooked >= 1 && nextSeat.isBooked >= 1  ? 'takenSeat' : ''} doubSeat seat" data-type="${seat.the_loai}">
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


        // thêm hàng ghế
        $('#form-create-seats').on('submit', function (e) {
            e.preventDefault()
            let seatData = [];
            let valid = true;
            $('.seat-fields .create-seats-row').each(function () {
                let rowSeats = $(this).find('.select-seat').val()
                let typeSeat = $(this).find('.typeSeat').val()
                let totalSeat = $(this).find('.totalSeat').val()
                if (typeSeat == 'doi' && +totalSeat % 2 !== 0) {
                    valid = false
                    alert('Loại ghế là ghế đôi lên số lượng ghế thêm vào hàng không được lẻ!')
                    return
                }
                seatData.push({
                    row: rowSeats,
                    type: typeSeat,
                    total: totalSeat
                })
            })
            if (!valid) return
            $('.seat-fields .select-seat').each(function (index) {
                const idSelectSeatAll = $(this).attr('id')
                $(this).val(null).trigger("change");
                if (idSelectSeatAll != 0) {
                    $(this).closest('.create-seats-row').remove()
                }

            });
            $(this)[0].reset();
            $('.loading').show()
            seatIndex = 0;
            seatsTemp = [];
            seatsRow = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'];
            let newOptions = seatsRow.map(seat => `<option value="${seat}">${seat}</option>`).join('');
            $('.js-example-basic-seats-0').html(newOptions)
            $.ajax({
                url: "{{ route('admin.storeGhe', $phongChieu->id) }}",
                method: 'post',
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: JSON.stringify(seatData),
                success: function (data) {
                    if (data.status == 200) {
                        $.notify({
                            icon: 'icon-bell',
                            title: 'Thành công',
                            message: 'Đã thêm các ghế vào các hàng thành công.',
                        }, {
                            type: 'success',
                            placement: {
                                from: "top",
                                align: "right"
                            },
                            time: 1000,
                        });
                        showSeat()
                    }
                },
                error: function (error) {
                    $.notify({
                        icon: 'icon-bell',
                        title: 'Không thành công',
                        message: 'Thêm vào các hàng ghế không thành công.',
                    }, {
                        type: 'danger',
                        placement: {
                            from: "top",
                            align: "right"
                        },
                        time: 1000,
                    });
                    console.log('lỗi:' + error);
                }
            })
            $('.loading').hide()
            $('.btn-close').click()
        })
    })
</script>