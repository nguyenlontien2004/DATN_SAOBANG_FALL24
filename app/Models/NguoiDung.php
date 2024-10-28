<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class NguoiDung extends Authenticatable
{
    use HasFactory;
    protected $table = 'nguoi_dungs';
    protected $fillable = [
        'ho_ten',
        'email',
        'so_dien_thoai',
        'anh_dai_dien',
        'mat_khau',
        'dia_chi',
        'nam_sinh',
        'ngay_dang_ky',
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
}
