<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DienVien extends Model
{
    use HasFactory;
    protected $fillable = [
        'ten_dien_vien',
        'nam_sinh',
        'gioi_tinh',
        'quoc_tich',
        'anh_dien_vien',
        'tieu_su',
        'trang_thai',
    ];
    public function phims()
    {
        return $this->belongsToMany(Phim::class, 'phim_va_dien_viens', 'dien_vien_id', 'phim_id');
    }
}
