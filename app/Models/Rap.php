<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rap extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'ten_rap',
        'dia_diem',
        'deleted_at',
        'trang_thai',
    ];
    protected $dates = ['deleted_at'];
  
    protected $casts = [
        'trang_thai' => 'boolean',
    ];
}
