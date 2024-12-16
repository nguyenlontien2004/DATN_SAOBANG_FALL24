<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DoAn extends Model
{
    use HasFactory,SoftDeletes;
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
        return $this->belongsToMany(Ve::class, 'doan_ve', 'doan_id', 've_id')
            ->withPivot('so_luong');
    }
    public function doanvave()
    {
        return $this->hasMany(DoAnVaChiTietVe::class, 'do_an_id');
    }
}
