<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnhBannerQuangCao extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'banner_quang_cao_id',
        'hinh_anh',
        'thu_tu'
    ];

    public function banner()
    {
        return $this->belongsTo(BannerQuangCao::class, 'banner_quang_cao_id');
    }
}
