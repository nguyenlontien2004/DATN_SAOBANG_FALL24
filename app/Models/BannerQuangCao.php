<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BannerQuangCao extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'vi_tri',
        'mo_ta',
        'trang_thai'
    ];

    public function anhBanners()
    {
        return $this->hasOne(AnhBannerQuangCao::class, 'banner_quang_cao_id');
    }
}
