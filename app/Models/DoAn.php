<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoAn extends Model
{
    use HasFactory;

    protected $fillable = [
        'ten_do_an',
        'gia',
        'hinh_anh',
        'mo_ta',
        'luot_mua',
        'trang_thai'
    ];

    public function ves()
    {
        return $this->belongsToMany(Ve::class, 'do_an_va_chi_tiet_ves', 'do_an_id', 've_id');
    }
}
