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

    const TYPE_NHANVIEN = 'Nhân viên';

    protected $fillable = [
        'ho_ten',
        'email',
        'so_dien_thoai',
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

    // protected $hidden = ['password', 'remember_token'];

    public function role()
    {
        return $this->belongsTo(VaiTro::class, 'id', 'ten_vai_tro');
    }

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
}
