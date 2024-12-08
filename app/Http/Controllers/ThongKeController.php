<?php

namespace App\Http\Controllers;

use App\Models\Phim;
use Illuminate\Http\Request;

class ThongKeController extends Controller
{
    public function thongKeVeBanRaTheoPhim()
    {
        $phimVes = Phim::with([
            'suatChieus.ves'
        ])->get();

        return view('admin.thongke.vebanra', compact('phimVes'));
    }

    public function thongTongDoanhThu()
    {
        $phimVes = Phim::with([
            'suatChieus.ves'
        ])->get();

        return view('admin.thongke.vebanra', compact('phimVes'));
    }
}
