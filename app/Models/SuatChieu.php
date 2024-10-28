<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuatChieu extends Model
{
    use HasFactory;
    public function screeningRoom()
    {
        return $this->belongsTo(PhongChieu::class, 'phong_chieu_id');
    }
    public function movie()
    {
        return $this->belongsTo(Phim::class, 'phim_id');
    }
}
