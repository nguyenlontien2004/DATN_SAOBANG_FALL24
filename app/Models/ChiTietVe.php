<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietVe extends Model
{
    use HasFactory;
    protected $fillable = [
        've_id',
        'ghe_ngoi_id',
        'so_luong_ghe_ngoi',
        'trang_thai',
    ];
    public function seat()
    {
        return $this->belongsTo(GheNgoi::class, 'ghe_ngoi_id');
    }
    public function food()
    {
        return $this->belongsToMany(DoAn::class, 'do_an_va_chi_tiet_ves','chi_tiet_ve_id','do_an_id');
    }
}
