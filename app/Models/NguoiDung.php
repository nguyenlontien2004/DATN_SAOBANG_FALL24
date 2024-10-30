<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NguoiDung extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ho_ten',
        'email',
        'so_dien_thoai',
        'hinh_anh',
        'mat_khau',
        'gioi_tinh',
        'dia_chi',
        'nam_sinh',
        'ngay_dang_ky',
        'huy_ve',
        'gold',
        'trang_thai'
    ];
    public function role()
    {
        return $this->belongsTo(VaiTro::class, 'id');
    }
    public function checkAdmin()
    {
        if ($this->role->id == 1) {
            return true;
        }
        return false;
    }
}