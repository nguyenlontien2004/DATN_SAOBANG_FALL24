<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rap extends Model
{
    use HasFactory;
    protected $fillable = [
        'ten_rap',
        'dia_diem',
        'trang_thai',
    ];
  
    protected $casts = [
        'trang_thai' => 'boolean',
    ];
    public function suatChieu(){
        return $this->hasManyThrough(SuatChieu::class,PhongChieu::class);
    }
    public function phongChieus()
    {
        return $this->hasMany(PhongChieu::class, 'rap_id');
    }
    public function ves()
    {
        return $this->hasManyThrough(Ve::class, SuatChieu::class, 'phong_chieu_id', 'suat_chieu_id');
    }
}
