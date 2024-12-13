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

        $bd = null;
        $kt = null;

        if ($request->has('bat_dau') && $request->has('ket_thuc')) {

            $bd = Carbon::parse($request->bat_dau)->startOfDay();
            $kt = Carbon::parse($request->ket_thuc)->endOfDay();

            $phimVes->with('suatChieus.ves', function ($query) use ($bd, $kt) {
                $query->whereBetween('ngay_thanh_toan', [$bd, $kt]);
            });
        }

        if ($request->loc === 'nam') {

            $namHienTai = Carbon::now()->year;
            $bd = Carbon::createFromDate($namHienTai, 1, 1)->startOfDay();
            $kt = Carbon::now()->endOfDay();

            $phimVes->with('suatChieus.ves', function ($query) use ($bd, $kt) {
                $query->whereBetween('ngay_thanh_toan', [$bd, $kt]);
            });
        }

        if (in_array($request->loc, ['1', '2', '3', '4'])) {

            $quy = (int)$request->loc;
            $thangHienTai = $quy * 3 - 2;
            $quyHienTai = ceil($thangHienTai / 3);
            $bd = Carbon::createFromDate(Carbon::now()->year, $thangHienTai, 1)->startOfMonth()->startOfDay();
            $kt = Carbon::createFromDate(Carbon::now()->year, $quy * 3, 1)->endOfMonth()->endOfDay();

            $phimVes->with('suatChieus.ves', function ($query) use ($bd, $kt) {
                $query->whereBetween('ngay_thanh_toan', [$bd, $kt]);
            });
        }

        if ($request->loc === 'thang') {

            $bd = Carbon::now()->startOfMonth()->startOfDay();
            $kt = Carbon::now()->endOfMonth()->endOfDay();

            $phimVes->with('suatChieus.ves', function ($query) use ($bd, $kt) {
                $query->whereBetween('ngay_thanh_toan', [$bd, $kt]);
            });
        }

        if ($request->loc === 'tuan') {
            $bd = Carbon::now()->startOfWeek()->startOfDay();
            $kt = Carbon::now()->endOfWeek()->endOfDay();

            $phimVes->with('suatChieus.ves', function ($query) use ($bd, $kt) {
                $query->whereBetween('ngay_thanh_toan', [$bd, $kt]);
            });
        }

        $phimVes = $phimVes->get();

        return view('admin.thongke.vebanra', compact('phimVes', 'bd', 'kt'));
    }

    public function thongTongDoanhThuRap(Request $request)
    {
        $chiNhanh = Rap::with([
            'phongChieus.suatChieu.ves.detailTicket',
            'phongChieus.suatChieu.ves.doAns'
        ]);

        $bd = null;
        $kt = null;

        if ($request->has('bat_dau') && $request->has('ket_thuc')) {
            $bd = Carbon::parse($request->bat_dau)->startOfDay();
            $kt = Carbon::parse($request->ket_thuc)->endOfDay();

            $chiNhanh->with('phongChieus.suatChieu.ves', function ($query) use ($bd, $kt) {
                $query->whereBetween('ngay_thanh_toan', [$bd, $kt]);
            });
        }

        if ($request->loc === 'nam') {
            $namHienTai = Carbon::now()->year;
            $bd = Carbon::createFromDate($namHienTai, 1, 1)->startOfDay();
            $kt = Carbon::now()->endOfDay();

            $chiNhanh->with('phongChieus.suatChieu.ves', function ($query) use ($bd, $kt) {
                $query->whereBetween('ngay_thanh_toan', [$bd, $kt]);
            });
        }

        if (in_array($request->loc, ['1', '2', '3', '4'])) {
            $quy = (int)$request->loc;
            $thangBatDau = $quy * 3 - 2;
            $bd = Carbon::createFromDate(Carbon::now()->year, $thangBatDau, 1)->startOfMonth()->startOfDay();
            $kt = Carbon::createFromDate(Carbon::now()->year, $thangBatDau + 2, 1)->endOfMonth()->endOfDay();

            $chiNhanh->with('phongChieus.suatChieu.ves', function ($query) use ($bd, $kt) {
                $query->whereBetween('ngay_thanh_toan', [$bd, $kt]);
            });
        }

        if ($request->loc === 'thang') {
            $bd = Carbon::now()->startOfMonth()->startOfDay();
            $kt = Carbon::now()->endOfMonth()->endOfDay();

            $chiNhanh->with('phongChieus.suatChieu.ves', function ($query) use ($bd, $kt) {
                $query->whereBetween('ngay_thanh_toan', [$bd, $kt]);
            });
        }

        if ($request->loc === 'tuan') {
            $bd = Carbon::now()->startOfWeek()->startOfDay();
            $kt = Carbon::now()->endOfWeek()->endOfDay();

            $chiNhanh->with('phongChieus.suatChieu.ves', function ($query) use ($bd, $kt) {
                $query->whereBetween('ngay_thanh_toan', [$bd, $kt]);
            });
        }

        $chiNhanh = $chiNhanh->get();

        return view('admin.thongke.thongketong', compact('chiNhanh', 'bd', 'kt'));
    }
}
