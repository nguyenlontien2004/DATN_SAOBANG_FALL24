<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BinhLuanPhim extends Model
{
    use HasFactory;
    
    protected $table = 'binh_luan_phims';

    protected $fillable = [
        'nguoi_dung_id',
        'phim_id',
        'noi_dung',
    ];
    public function nguoiDung()
    {
        return $this->belongsTo(NguoiDung::class, 'nguoi_dung_id');
    }
}