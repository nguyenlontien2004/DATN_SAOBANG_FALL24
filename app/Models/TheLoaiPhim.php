<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TheLoaiPhim extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'ten_the_loai',
        'deleted_at',
        'trang_thai',
    ];
    protected $dates = ['deleted_at'];
    public function phims()
    {
        return $this->belongsToMany(Phim::class, 'phim_va_the_loais', 'the_loai_phim_id', 'phim_id');
    }
}
