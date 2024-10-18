<script>
    $(document).ready(function () {
        let isChooseTypeSeat = false
        let seatIndex = 0
        let seatsRow = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'];
        let seatsTemp = [];
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
                    $('.loading').hide()
                    if (data.status == 200) {
                        $('.btn-close').click()
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
                    }
                },
                error: function (error) {
                    $.notify({
                        icon: 'icon-bell',
                        title: 'Không thành công',
                        message: 'Thêm vào các hàng ghế không thành công.',
                    }, {
                        type: 'error',
                        placement: {
                            from: "top",
                            align: "right"
                        },
                        time: 1000,
                    });
                    console.log('lỗi:' + error);
                }
            })
        })

    })
</script>