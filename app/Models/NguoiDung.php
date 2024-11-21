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

    protected $fillable = [
        'ho_ten',
        'email',
        'so_dien_thoai',
        'hinh_anh',
        'password',
<<<<<<< HEAD
=======
        'hinh_anh',
>>>>>>> developer
        'gioi_tinh',
        'dia_chi',
        'nam_sinh',
        'trang_thai',
    ];
<<<<<<< HEAD
    protected $hidden = ['password', 'remember_token'];
=======
>>>>>>> developer

    public function role()
    {
        return $this->belongsTo(VaiTro::class, 'id', 'ten_vai_tro');
    }

    public function checkAdmin()
    {
        if ($this->role->id == 1) {
            return true;
        }
        return false;
    }

    public function vaiTros()
    {
<<<<<<< HEAD
        return $this->belongsToMany(VaiTro::class, 'vai_tro_va_nguoi_dungs', 'nguoi_dung_id', 'vai_tro_id'); 
        // Sửa lại thứ tự cột nếu cần: 'nguoi_dung_id' -> 'vai_tro_id'
    }

    public function danhGias()
    {
        return $this->hasMany(DanhGia::class);
=======
        return $this->belongsToMany(VaiTro::class);
    }

    public function admin()
    {
        return $this->ten_vai_tro == self::TYPE_ADMIN;
    }

    public function member()
    {
        return $this->ten_vai_tro == self::TYPE_MEMBER;
>>>>>>> developer
    }
}
