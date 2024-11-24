<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThanhToan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nguoi_dung_id',
        've_id',
        'ngay_thanh_toan',
    ];
}
