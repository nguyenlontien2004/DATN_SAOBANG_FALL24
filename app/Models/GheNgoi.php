<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GheNgoi extends Model
{
    use HasFactory;
    const TYPE_SEAT_OFTEN = 'thuong';
    const TYPE_SEAT_VIP = 'vip';
    const TYPE_SEAT_DOUBLE = 'doi';
    protected $fillable = [
        'phong_chieu_id',
        'hang_ghe',
        'the_loai',
        'so_hieu_ghe',
        'isDoubleChair',
        'trang_thai',
    ];
    protected $casts = [
        'trang_thai' => 'boolean',
    ];
}
