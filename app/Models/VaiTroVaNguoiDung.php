<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaiTroVaNguoiDung extends Model
{
    use HasFactory;
    protected $fillable = [
        'nguoi_dung_id',
        'vai_tro_id',
    ];
    public function user(){
        return $this->belongsTo(NguoiDung::class,'nguoi_dung_id');
    }
    public function role(){
        return $this->belongsTo(VaiTro::class,'vai_tro_id');
    }
}
