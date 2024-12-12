<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SuatChieu extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'ten_suat_chieu',  // Thay thế bằng các trường thực tế của bảng suat_chieus
        'ngay',
        'gio_bat_dau',
        'gio_ket_thuc',
        'trang_thai',
        'phong_chieu_id',
        'phim_id',
        'gia'
    ];

    public function phongChieu()
    {
        return $this->belongsTo(PhongChieu::class, 'phong_chieu_id');
    }

    public function phim()
    {
        return $this->belongsTo(Phim::class, 'phim_id');
    }
    public function rap(){
        return $this->hasOneThrough(Rap::class,PhongChieu::class,'id','id','phong_chieu_id');
    }
    public function ves(){
        return $this->hasMany(Ve::class);
    }
}
