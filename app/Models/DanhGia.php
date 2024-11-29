<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhGia extends Model
{
    use HasFactory;
<<<<<<< HEAD
=======

    protected $table = 'danh_gias';

    protected $fillable = [
        'nguoi_dung_id',
        'phim_id',
        'diem_danh_gia',
        'noi_dung',
    ];
    public function phim()
    {
        return $this->belongsTo(Phim::class);
    }

    public function nguoiDung()
    {
        return $this->belongsTo(NguoiDung::class);
    }
>>>>>>> 92d27022c6f51e182da2946bed8af0793dfa03e9
}
