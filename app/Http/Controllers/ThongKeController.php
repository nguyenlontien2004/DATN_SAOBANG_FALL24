<?php

namespace App\Http\Controllers;

use App\Models\Phim;
use App\Models\Rap;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ThongKeController extends Controller
{
    public function thongKeVeBanRaTheoPhim(Request $request)
    {
        $phimVes = Phim::with([
            'suatChieus.ves.detailTicket',
            'suatChieus.ves.doAns'
        ]);

        if ($request->has('bat_dau') && $request->has('ket_thuc')) {

            $bd = Carbon::parse($request->bat_dau);
            $kt = Carbon::parse($request->ket_thuc);

            $phimVes->whereHas('suatChieus.ves', function ($query) use ($bd, $kt) {
                $query->whereBetween('ngay_thanh_toan', [$bd, $kt]);
            });
        }

        if ($request->loc === 'nam') {

            $namHienTai = Carbon::now()->year;
            $batDauNam = Carbon::createFromDate($namHienTai, 1, 1)->startOfDay();
            $ketThucNam = Carbon::now()->endOfDay();

            $phimVes->whereHas('suatChieus.ves', function ($query) use ($batDauNam, $ketThucNam) {
                $query->whereBetween('ngay_thanh_toan', [$batDauNam, $ketThucNam]);
            });
        }

        if ($request->loc === 'quy') {

            $thangHienTai = Carbon::now()->month;
            $quyHienTai = ceil($thangHienTai / 3);
            $batDauQuy = Carbon::now()->month(($quyHienTai - 1) * 3 + 1)->startOfMonth()->startOfDay();
            $ketThucQuy = Carbon::now()->month($quyHienTai * 3)->endOfMonth()->endOfDay();

            $phimVes->whereHas('suatChieus.ves', function ($query) use ($batDauQuy, $ketThucQuy) {
                $query->whereBetween('ngay_thanh_toan', [$batDauQuy, $ketThucQuy]);
            });
        }

        if ($request->loc === 'thang') {

            $batDauThang = Carbon::now()->startOfMonth()->startOfDay();
            $ketThucThang = Carbon::now()->endOfMonth()->endOfDay();

            $phimVes->whereHas('suatChieus.ves', function ($query) use ($batDauThang, $ketThucThang) {
                $query->whereBetween('ngay_thanh_toan', [$batDauThang, $ketThucThang]);
            });
        }

        $phimVes = $phimVes->get();

        return view('admin.thongke.vebanra', compact('phimVes'));
    }

    public function thongTongDoanhThuRap()
    {
        $chiNhanh = Rap::with([
            'phongs.suatChieu.ves.detailTicket',
            'phongs.suatChieu.ves.doAns'
        ])->get();

        return view('admin.thongke.thongketong', compact('chiNhanh'));
    }
}
