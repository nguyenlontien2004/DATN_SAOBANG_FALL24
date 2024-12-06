<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuatChieu extends Model
{
    use HasFactory;
    protected $fillable = [
        'ten_suat_chieu',  // Thay thế bằng các trường thực tế của bảng suat_chieus
        'gio_bat_dau',
        'gio_ket_thuc',
        'trang_thai',
        'phong_chieu_id',
        'phim_id',
    ];

    public function phongChieu()
    {
        return $this->belongsTo(PhongChieu::class, 'phong_chieu_id');
    }

    public function phim()
    {
        return $this->belongsTo(Phim::class, 'phim_id');
    }
    public function movie()
    {
        return $this->belongsTo(Phim::class, 'phim_id');
    }
    public function ves(){
        return $this->hasMany(Ve::class);
    }
}
