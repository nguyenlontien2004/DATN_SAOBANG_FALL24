<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuatChieu extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [ 
        'gio_bat_dau',
        'gio_ket_thuc',
        'date',
        'trang_thai',
        'phong_chieu_id',
        'phim_id',
        'deleted_at'
    ];protected $dates = ['deleted_at'];

    public function phongChieu()
    {
        return $this->belongsTo(PhongChieu::class, 'phong_chieu_id');
    }

    public function phim()
    {
        return $this->belongsTo(Phim::class, 'phim_id');
    }

    public function screeningRoom()
    {
        return $this->belongsTo(PhongChieu::class, 'phong_chieu_id');
    }

    public function movie()
    {
        return $this->belongsTo(Phim::class, 'phim_id');
    }
    public function ve()
{
    return $this->hasMany(Ve::class, 'suat_chieu_id');
}

}
