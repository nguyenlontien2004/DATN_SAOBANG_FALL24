<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TheLoaiPhim extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'ten_the_loai',
        'trang_thai',
    ];
    public function phims()
    {
        return $this->belongsToMany(Phim::class, 'phim_va_the_loais', 'the_loai_phim_id', 'phim_id');
    }
}
