<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phim extends Model
{
    use HasFactory;

    protected $fillable = [
        'ten_phim',
        'mo_ta',
        'thoi_luong',
        'luot_xem_phim',
        'ngay_khoi_chieu',
        'ngay_ket_thuc',
        'trailer',
        'ngon_ngu',
        'do_tuoi',
        'gia_phim',
        'trang_thai',
    ];

    public function daoDiens()
    {
        return $this->belongsToMany(DaoDien::class, 'phim_va_dao_diens', 'phim_id', 'dao_dien_id');
    }

    public function dienViens()
    {
        return $this->belongsToMany(DienVien::class, 'phim_va_dien_viens', 'phim_id', 'dien_vien_id');
    }

    public function theloaiphims()
    {
        return $this->belongsToMany(TheLoaiPhim::class, 'phim_va_the_loais', 'phim_id', 'the_loai_phim_id'); // Sửa bảng pivot
    }

    public function suatChieus()
    {
        return $this->hasMany(SuatChieu::class, 'phim_id');
    }


    public function binhLuans()
    {
        return $this->hasMany(BinhLuanPhim::class, 'phim_id');
    }

    public function danhGias()
    {
        return $this->hasMany(DanhGia::class);
    }
}
