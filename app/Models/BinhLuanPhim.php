<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BinhLuanPhim extends Model
{
    use HasFactory;
<<<<<<< HEAD
}
=======
    
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
>>>>>>> 92d27022c6f51e182da2946bed8af0793dfa03e9
