<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhimVaTheLoai extends Model
{
    use HasFactory;
    protected $table = 'phim_va_the_loais';
    protected $fillable = ['phim_id', 'the_loai_phim_id'];
}
