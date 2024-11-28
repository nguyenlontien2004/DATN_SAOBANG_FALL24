<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rap extends Model
{
    use HasFactory;
    protected $fillable = [
        'ten_rap',
        'dia_diem',
        'trang_thai',
    ];
  
    protected $casts = [
        'trang_thai' => 'boolean',
    ];
}
