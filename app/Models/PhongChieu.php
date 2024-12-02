<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhongChieu extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'ten_phong_chieu',
        'rap_id',
        'gio_chieu',
        'trang_thai',
    ];
    protected $casts = [
        'trang_thai' => 'boolean',
    ];
    public function rap()
    {
        return $this->belongsTo(Rap::class);
    }
    public function gheNgois()
    {
        return $this->hasMany(GheNgoi::class, 'phong_chieu_id');
    }
    public function cinema()
    {
        return $this->belongsTo(Rap::class, 'rap_id');
    }
}