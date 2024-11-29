<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NguoiDung extends Model
{
    use HasFactory, SoftDeletes;

<<<<<<< HEAD
=======
    const TYPE_ADMIN = 'admin';

    const TYPE_MEMBER = 'member';

>>>>>>> 92d27022c6f51e182da2946bed8af0793dfa03e9
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
<<<<<<< HEAD
  
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
=======

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
>>>>>>> 92d27022c6f51e182da2946bed8af0793dfa03e9
    }
}
