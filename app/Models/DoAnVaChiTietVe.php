<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoAnVaChiTietVe extends Model
{
    use HasFactory;
    public function detailTicket()
    {
        return $this->belongsTo(ChiTietVe::class, 'chi_tiet_ve_id');
    }
    public function food()
    {
        return $this->belongsTo(DoAn::class, 'do_an_id');
    }
}
