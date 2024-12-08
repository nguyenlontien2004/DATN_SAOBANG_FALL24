<?php

namespace App\Models;

use App\Models\Phim;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DienVien extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'ten_dien_vien',
        'nam_sinh',
        'gioi_tinh',
        'quoc_tich',
        'anh_dien_vien',
        'tieu_su',
        'trang_thai',
        'deleted_at',
    ];
    protected $dates = ['deleted_at']; 
    public function phims()
    {
        return $this->belongsToMany(Phim::class, 'phim_va_dien_viens', 'dien_vien_id', 'phim_id');
    }
}
