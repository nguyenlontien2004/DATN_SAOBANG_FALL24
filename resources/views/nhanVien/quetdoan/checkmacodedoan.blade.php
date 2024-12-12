@extends('nhanVien.index')

@section('content')
<style>
    .customghe {
        list-style: none;
        margin: 2px;
        text-align: center;
        padding: 6px 5.5px;
        border-radius: 5px;
    }
</style>
<div>
    <div class="ms-4 mt-3">
        <a href="{{ route('nhanvien.quetdoan') }}"> Quét QR đồ ăn</a>
        <span class="px-2">/</span>
        <a href="">Kiểm tra đồ ăn qua mã vé</a>
    </div>
</div>
<div>

    <h1 class="text-center my-4">Kiểm tra đồ ăn theo mã code</h1>

    <div class="card mx-auto" style="max-width: 600px;">
        <div class="card-body text-center">
            <form action="">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Mã code vé</label>
                    <input type="text" class="form-control macode" name="macode" id="exampleInputEmail1"
                        aria-describedby="emailHelp">
                    @error('macode')
                        <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btnsubmitmacode btn-primary">Submit</button>
            </form>
            </p>
        </div>
    </div>

</div>
<div class="modal fade container-seat" style="width:100%;max-width: 100%;" id="ticketModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog seat-selection" role="document">
        <div class="modal-content seats-wrapper-parent">
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.btnsubmitmacode').on('click', function (e) {
            e.preventDefault()
            let macode = $('.macode').val();
            if(macode == ""){
                $.notify({
                    icon: 'icon-bell',
                    message: 'Trường kiểm tra mã code vé không được để trống!',
                }, {
                    type: 'warning',
                    placement: {
                        from: "top",
                        align: "right"
                    },
                    time: 1000,
                });
                return
            }
            $.ajax({
                url:"{{ route('nhanvien.kiemtradoanpost') }}",
                method:'POST',
                data:{'macode':macode},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(data){
                    console.log(data);
                    showModal(data);
                },
                error:function(error){
                    $.notify({
                    icon: 'icon-bell',
                    message: error.responseJSON.msg,
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
        const showModal = (data) => {
        let modalContent = `
        <div class="modal-header">
            <h5 class="modal-title">Thông tin vé</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body seats-wrapper-row">
            <p class="mb-0">Người sở hữu:${data.data.nguoi_dung}</p>
            <p class="mb-0">Email:${data.data.email}</p>
            <div class="d-flex align-items-center">Ghế: 
            <div class="seats-map" >
            <div class="row-wrapper list-row-seats d-flex" >`
        $.each(data.data.ghe,function(loai,value){
        //   modalContent += ``
           let i = 0
            for (i; i < value.length; i++) {
                if (value[i].isDoubleChair !== null && i + 1 < value.length) {
                    let nextSeat = value[i + 1]; 
                    modalContent += `<div class="seat-group-parent  doubSeat seat">
                                           <li  class="seat-group">${value[i].hang_ghe}${value[i].so_hieu_ghe}</li>
                                           <li class="seat-group">${value[i].hang_ghe}${nextSeat.so_hieu_ghe}</li>
                                       </div>`;
                    i++;
                }else{
                    modalContent += `<li class="customghe ${value[i].the_loai == 'thuong' ? 'regularchair' : 'seatVip'}">${value[i].hang_ghe}${value[i].so_hieu_ghe}</li>`;
                }             
            }
          //modalContent += `</p>`
        })
        modalContent+=`</div></div></div>
            <p>Suất chiếu: ${data.data.thoigiansuatchieu}</p>
            <p>Ngày vé mở xem: ${data.data.ngay_ve_mo}</p>
            <p>Ngày thanh toán: ${data.data.ngay_thanh_toan}</p>
            <p>Tổng tiền: ${data.data.tong_tien}đ</p>
            <p>Phương thức thanh toán: ${data.data.phuong_thuc_thanh_toan}</p>
            <p class="${ data.satatus == 200 ? 'text-success':'text-danger' }">${data.message}</p>
        </div>
       
    `;
        const modal = document.getElementById("ticketModal");
        modal.querySelector('.modal-content').innerHTML = modalContent;
        $(modal).modal('show');

        // document.getElementById("printTicketButton").addEventListener("click", () => {
        //     window.print();
        // });
    };
    })
</script>

@endsection