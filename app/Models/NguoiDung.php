<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class NguoiDung extends Authenticatable
{
    use HasFactory, SoftDeletes;

    const TYPE_ADMIN = 'admin';

    const TYPE_MEMBER = 'member';

    protected $fillable = [
        'ho_ten',
        'email',
        'so_dien_thoai',
        'hinh_anh',
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

    public function admin()
    {
        return $this->ten_vai_tro == self::TYPE_ADMIN;
    }

    public function member()
    {
        return $this->ten_vai_tro == self::TYPE_MEMBER;
    }
}
