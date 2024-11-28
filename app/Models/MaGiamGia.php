<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaGiamGia extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ten_ma_giam_gia',
        'ma_giam_gia',
        'so_luong',
        'mo_ta',
        'ngay_bat_dau',
        'ngay_ket_thuc',
        'gia_tri_giam',
        'trang_thai'
    ];
}
