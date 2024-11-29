<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DanhMucBaiVietTinTuc extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ten_danh_muc'
    ];

    public function baiViets()
    {
        return $this->hasOne(BaiVietTinTuc::class, 'danh_muc_bai_viet_tin_tuc_id');
    }
}