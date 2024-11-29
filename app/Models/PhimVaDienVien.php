<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhimVaDienVien extends Model
{
    use HasFactory;
    protected $table = 'phim_va_dien_viens';
    protected $fillable = ['phim_id', 'dien_vien_id','vai_tro_dien_vien'];
}
