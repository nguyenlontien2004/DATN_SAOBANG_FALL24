$(document).ready(function(){
    moment.locale('vi');
    const anh = $('.dataUser').attr('data-user')
    $('.loaibinhluan').on('click',function(){
        $.each($('.loaibinhluan'),function(){
            $(this).removeClass('active-comment')
        })
        $(this).addClass('active-comment')
        if($(this).attr('data-type') == 'danhgia'){
           $('.danhgia').show()
           $('.binhluan').hide()
        }else{
            $('.binhluan').show()
            $('.danhgia').hide()
        }
    })
    $('.formBinhluan').on('submit',function(e){
        e.preventDefault()
        if($('.noidungbinhluan').val() == "") return
        const noidung = $('.noidungbinhluan').val()
        const ten = $('.tennguoidung').val()
        const idnguoidung = $('.idnguoidung').val()
        const curtime = moment().fromNow();
        $('.btnsubmitComment').prop('disabled', true)

        fetchApi(noidung,idnguoidung,anh,ten,curtime)
       
        $('.noidungbinhluan').val("")
        
    })
    function fetchApi (noidung,idnguoidung,anh,ten,curtime){
        $.ajax({
            url:`${urlBinhLuan}/${idMovie}`,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method:'post',
            data:{'noidung':noidung,'idnguoidung':idnguoidung},
            success: function (data) {
                if(data.status == 200){
                    let content = htmlComment(anh,ten,curtime,noidung)
                    $('.container-binhluan').prepend(content)
                }else{
                    alert('Lỗi không thể gửi bình luận!')
                }
                $('.btnsubmitComment').prop('disabled', false)
            },
            error: function (error) {
                console.log(error);
                $('.btnsubmitComment').prop('disabled', false)
            }
        })
    }
    function htmlComment(anh,ten,curtime,noidung){
        let html = `
         <div class="d-flex mb-1" style="border-bottom: 1px solid #dadada; justify-content: flex-start;flex-direction: column;    align-items: flex-start;">
            <div class="d-flex">
                 <img src="${anh}"
                    alt="đại diện"
                    style="width: 37px; height: 37px; border-radius: 50%; object-fit: cover;"
                    alt="User" class="rounded-circle me-3" style="width: 40px; height: 40px;" />
                <div>
                    <h6 class="mb-1" style="font-weight: bold;">${ten}</h6>
                    <span class="text-muted" style="font-size: 12px;">${curtime}</span>
                </div>
            </div>
            <div>
                <p class="mb-1 ms-1 mt-1" style="font-size: 16px; color: #333;">${noidung}</p>
            </div>
        </div>
        `
        return html
    }
})
