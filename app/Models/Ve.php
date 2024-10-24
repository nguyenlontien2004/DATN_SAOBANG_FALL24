<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ve extends Model
{
    use HasFactory;
    protected $fillable = [
        'nguoi_dung_id',
        'ngay_thanh_toan',
        'suat_chieu_id',
        'ma_giam_gia_id',
        'ngay_thanh_toan',
        'trang_thai',
    ];
    public function user()
    {
        return $this->belongsTo(NguoiDung::class, 'nguoi_dung_id');
    }
    public function detailTicket()
    {
        return $this->hasMany(ChiTietVe::class, 've_id');
    }
    public function showtime()
    {
        return $this->belongsTo(SuatChieu::class, 'suat_chieu_id');
    }
    public function discountCode()
    {
        return $this->belongsTo(MaGiamGia::class, 'ma_giam_gia_id');
    }
}
