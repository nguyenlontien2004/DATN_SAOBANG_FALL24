<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class NguoiDung extends Authenticatable
{
    use HasFactory, SoftDeletes, Notifiable;

    protected $fillable = [
        'ho_ten',
        'email',
        'so_dien_thoai',
        'hinh_anh',
        'password',
        'gioi_tinh',
        'dia_chi',
        'nam_sinh',
        'trang_thai',
    ];
    protected $hidden = ['password', 'remember_token'];

    public function role()
    {
        return $this->belongsTo(VaiTro::class, 'id');
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
        return $this->belongsToMany(VaiTro::class, 'vai_tro_va_nguoi_dungs', 'nguoi_dung_id', 'vai_tro_id'); 
        // Sửa lại thứ tự cột nếu cần: 'nguoi_dung_id' -> 'vai_tro_id'
    }

}
