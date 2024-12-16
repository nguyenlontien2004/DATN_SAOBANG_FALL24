<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class NguoiDung extends Authenticatable
{
    use HasFactory, SoftDeletes, Notifiable;

    const TYPE_ADMIN = 'admin';

    const TYPE_MEMBER = 'member';

    const TYPE_NHANVIEN = 'nhanvien'; 

    protected $fillable = [
        'ho_ten',
        'email',
        'so_dien_thoai',
        'anh_dai_dien',
        'password',
        'hinh_anh',
        'gioi_tinh',
        'dia_chi',
        'nam_sinh',
        'ngay_dang_ky',
        'huy_ve',
        'gold',
        'trang_thai'
    ];

    protected $hidden = ['password', 'remember_token'];

    public function role()
    {
        return $this->belongsTo(VaiTro::class, 'id', 'ten_vai_tro');
    }
    // public function vaiTro()
    // {
    //     return $this->belongsToMany(VaiTro::class,'nguoi_dung_vai_tro', 'nguoi_dung_id', 'vai_tro_id');
    // }

    public function checkAdmin()
    {
        if ($this->role?->id == 1) {
            return true;
        }
        return false;
    }

    public function vaiTros()
    {
        return $this->belongsToMany(VaiTro::class);
    }

    public function danhGias()
    {
        return $this->hasMany(DanhGia::class);
    }

    public function admin()
    {
        return $this->vaiTros()->where('ten_vai_tro', self::TYPE_ADMIN)->exists();
    }

    public function member()
    {
        return $this->vaiTros()->where('ten_vai_tro', self::TYPE_MEMBER)->exists();
    }

    public function nhanVien()
    {
        return $this->vaiTros()->where('ten_vai_tro', self::TYPE_NHANVIEN)->exists();
    }
    public function ves()
    {
        return $this->hasMany(Ve::class, 'nguoi_dung_id');
    }
}
