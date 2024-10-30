<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VaiTro extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ten_vai_tro',
    ];

    public function nguoiDungs()
    {
        return $this->belongsToMany(VaiTro::class, 'vai_tro_va_nguoi_dungs', 'nguoi_dung_id', 'vai_tro_id');
    }
}
