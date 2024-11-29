<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhimVaDaoDien extends Model
{
    use HasFactory;
    protected $table = 'phim_va_dao_diens';
    protected $fillable = ['phim_id', 'dao_dien_id'];
}
