<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaiVietTinTuc extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'danh_muc_bai_viet_tin_tuc_id',
        'tieu_de',
        'noi_dung',
        'tom_tat',
        'hinh_anh',
        'luot_xem',
        'ngay_dang',
        'trang_thai'
    ];

    public function danhMuc()
    {
        return $this->belongsTo(DanhMucBaiVietTinTuc::class, 'danh_muc_bai_viet_tin_tuc_id');
    }
}
