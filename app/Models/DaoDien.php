<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaoDien extends Model
{
    use HasFactory;
    protected $fillable = [
        'ten_dao_dien',
        'nam_sinh',
        'gioi_tinh',
        'quoc_tich',
        'anh_dao_dien',
        'tieu_su',
        'trang_thai',
    ];
    public function phims()
    {
        return $this->belongsToMany(Phim::class, 'phim_va_dao_diens', 'dao_dien_id', 'phim_id');
    }
}
