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
}
