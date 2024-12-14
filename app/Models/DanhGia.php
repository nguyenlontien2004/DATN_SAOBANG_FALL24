<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhGia extends Model
{
    use HasFactory;
    protected $table = 'danh_gias';
    protected $fillable = [
        'nguoi_dung_id',
        'phim_id',
        'diem_danh_gia',
        'noi_dung',
        'ngay_danh_gia',
    ];
    public function phim()
    {
        return $this->belongsTo(Phim::class);
    }
    public function nguoiDung()
    {
        return $this->belongsTo(NguoiDung::class);
    }
}
