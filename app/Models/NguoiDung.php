<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NguoiDung extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ho_ten',
        'email',
        'so_dien_thoai',
        'hinh_anh',
        'mat_khau',
        'gioi_tinh',
        'dia_chi',
        'nam_sinh',
        'trang_thai'
    ];
  
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

    public function vaiTros() // Chuyển phương thức này vào bên trong lớp
    {
        return $this->belongsToMany(VaiTro::class, 'vai_tro_va_nguoi_dungs', 'vai_tro_id', 'nguoi_dung_id');
    }
}
