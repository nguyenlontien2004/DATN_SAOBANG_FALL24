<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phim;
use App\Models\Rap;
use Carbon\Carbon;
class ThongKeController extends Controller
{
    public function thongKeVeBanRaTheoPhim(Request $request)
    {
        $phimVes = Phim::with([
            'suatChieus.ves.detailTicket',
            'suatChieus.ves.doAns'
        ]);

        $bd = null;
        $kt = null;

        if ($request->has('bat_dau') && $request->has('ket_thuc')) {

            $bd = Carbon::parse($request->bat_dau);
            $kt = Carbon::parse($request->ket_thuc);


            $phimVes->with('suatChieus.ves', function ($query) use ($bd, $kt) {
            //     $query->whereDate('ves.ngay_thanh_toan','>=',$bd)
            // ->whereDate('ves.ngay_thanh_toan','<=',$kt);
                $query->whereBetween('ves.ngay_thanh_toan', [$bd, $kt]);
            });
        }
        //dd($phimVes->get()->toArray());

        if ($request->loc === 'nam') {

            $namHienTai = Carbon::now()->year;
            $bd = Carbon::createFromDate($namHienTai, 1, 1)->startOfDay();
            $kt = Carbon::now()->endOfDay();

            $phimVes->whereHas('suatChieus.ves', function ($query) use ($bd, $kt) {
                $query->whereBetween('ngay_thanh_toan', [$bd, $kt]);
            });
        }

        if (in_array($request->loc, ['1', '2', '3', '4'])) {

            $quy = (int)$request->loc;
            $thangHienTai = $quy * 3 - 2;
            $quyHienTai = ceil($thangHienTai / 3);
            $bd = Carbon::createFromDate(Carbon::now()->year, $thangHienTai, 1)->startOfMonth()->startOfDay();
            $kt = Carbon::createFromDate(Carbon::now()->year, $quy * 3, 1)->endOfMonth()->endOfDay();

            $phimVes->whereHas('suatChieus.ves', function ($query) use ($bd, $kt) {
                $query->whereBetween('ngay_thanh_toan', [$bd, $kt]);
            });
        }

        if ($request->loc === 'thang') {

            $bd = Carbon::now()->startOfMonth()->startOfDay();
            $kt = Carbon::now()->endOfMonth()->endOfDay();

            $phimVes->whereHas('suatChieus.ves', function ($query) use ($bd, $kt) {
                $query->whereBetween('ngay_thanh_toan', [$bd, $kt]);
            });
        }

        $phimVes = $phimVes->get();

        //dd($phimVes->toArray());

        return view('admin.thongke.vebanra', compact('phimVes', 'bd', 'kt'));
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
