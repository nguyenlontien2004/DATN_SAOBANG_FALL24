<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NguoiDung extends Authenticatable
{
    use HasFactory, SoftDeletes;

    const TYPE_ADMIN = 'admin';

    const TYPE_MEMBER = 'member';

    protected $fillable = [
        'ho_ten',
        'email',
        'so_dien_thoai',
        'password',
        'hinh_anh',
        'gioi_tinh',
        'dia_chi',
        'nam_sinh',
        'trang_thai'
    ];

    public function vaiTros()
    {
        return $this->belongsToMany(VaiTro::class);
    }

    public function danhGia()
    {
        return $this->hasMany(DanhGia::class);
    }

    public function admin()
    {
        return $this->vaiTros()->where('ten_vai_tro', self::TYPE_ADMIN)->exists();
    }

    public function member()
    {
        return  $this->vaiTros()->where('ten_vai_tro', self::TYPE_MEMBER)->exists();
    }
}
