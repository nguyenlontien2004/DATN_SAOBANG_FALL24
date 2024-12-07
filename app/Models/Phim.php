<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Phim extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'ten_phim',
        'mo_ta',
        'anh_phim',
        'thoi_luong',
        'luot_xem_phim',
        'trailer',
        'ngon_ngu',
        'do_tuoi',
        'gia_phim',
        'trang_thai',
        'deleted_at',
    ];
    protected $dates = ['deleted_at']; 
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
}
