<!DOCTYPE html>
<html>

<head>
    <title>Huỷ vé vì vài lý do</title>
</head>
@php
    use Carbon\Carbon;
@endphp
<body>
    <h3>Chào bạn {{ $ves->user->ho_ten }}!</h3>
    <p>Vé phim: <strong>{{ $ves->suatChieu->phim->ten_phim }}</strong> có suất chiếu vào ngày <strong>{{ $ves->ngay_ve_mo }} / 
    {{ Carbon::parse($ves->suatChieu->gio_bat_dau)->format('H:i') .'~'. Carbon::parse($ves->suatChieu->gio_ket_thuc)->format('H:i') }}</strong> 
    của bạn đã bị huỷ vì một vài lý do chúng tôi sẽ đổi
         số tiền <strong>{{ number_format($ves->tong_tien,0,',','.').'VNĐ' }} </strong>
       từ vé bạn mua thành xu
        với mệnh giá 1xu = 1.000vnđ và bạn có thể dùng xu đó để mua các phim bạn mà ưng ý.
    </p>
    <p>Chúng tôi rất trận trọng xin lỗi vì sự bất tiền này.</p>
</body>

</html>
