<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ve extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'so_luong_ve',
        'nguoi_dung_id',
        'ma_code_ve',
        'qr_code',
        'ngay_ve_mo',
        'suat_chieu_id',
        'ma_giam_gia_id',
        'do_an_id',
        'ngay_dat',
        'tong_tien',
        'ngay_thanh_toan',
        'tong_tien_an',
        'phuong_thuc_thanh_toan',
        'trang_thai'
    ];

    public function user()
    {
        return $this->belongsTo(NguoiDung::class, 'nguoi_dung_id');
    }

    public function chiTietVe()
    {
        return $this->hasMany(ChiTietVe::class, 've_id');
    }

    public function detailTicket()
    {
        return $this->hasMany(ChiTietVe::class, 've_id');
    }

    public function phim()
    {
        return $this->belongsTo(Phim::class);
    }

    public function showtime()
    {
        return $this->belongsTo(SuatChieu::class, 'suat_chieu_id');
    }

    public function maGiamGia()
    {
        return $this->belongsTo(MaGiamGia::class, 'ma_giam_gia_id');
    }

    public function discountCode()
    {
        return $this->belongsTo(MaGiamGia::class, 'ma_giam_gia_id');
    }

    public function suatChieu()
    {
        return $this->belongsTo(SuatChieu::class, 'suat_chieu_id');
    }

    public function gheNgoi()
    {
        return $this->belongsTo(GheNgoi::class, 'ghe_ngoi_id');
    }

    public function doAns()
    {
        return $this->belongsToMany(Doan::class, 'do_an_va_chi_tiet_ves', 've_id', 'do_an_id')
            ->withPivot('so_luong_do_an');
    }
}
