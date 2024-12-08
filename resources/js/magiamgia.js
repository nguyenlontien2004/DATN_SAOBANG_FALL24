import './bootstrap';

window.Echo.Channel('broadcast-magiamgia')
.listen('MaGiamGiaEvent',(event)=>{
    console.log(event);
    alert(`Bạn có một voucher mới: ${event.ma_giam_gia}`);
})