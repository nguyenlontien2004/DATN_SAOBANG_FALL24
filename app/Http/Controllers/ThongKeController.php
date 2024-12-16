<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phim;
use App\Models\Rap;
use App\Models\TheLoaiPhim;
use App\Models\DoAn;
use App\Models\NguoiDung;
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

            $quy = (int) $request->loc;
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

            $phimVes->whereHas('suatChieus.ves', function ($query) use ($bd, $kt) {
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

        //dd($phimVes->toArray());

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
            $quy = (int) $request->loc;
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
    public function thongkedoanhthudoan(Request $request)
    {
       $doan = DoAn::query();
        $bd = null;
        $kt = null;
        if ($request->has('bat_dau') && $request->has('ket_thuc')) {
            $bd = Carbon::parse($request->bat_dau)->startOfDay();
            $kt = Carbon::parse($request->ket_thuc)->endOfDay();

            $doan->with('doanvave.ve', function ($query) use ($bd, $kt) {
                $query->whereBetween('ngay_thanh_toan', [$bd, $kt]);
            });
        }
        
        if ($request->loc === 'nam') {
            $namHienTai = Carbon::now()->year;
            $bd = Carbon::createFromDate($namHienTai, 1, 1)->startOfDay();
            $kt = Carbon::now()->endOfDay();

            $doan->with('doanvave.ve', function ($query) use ($bd, $kt) {
                $query->whereBetween('ngay_thanh_toan', [$bd, $kt]);
            });
        }
        if (in_array($request->loc, ['1', '2', '3', '4'])) {
            $quy = (int) $request->loc;
            $thangBatDau = $quy * 3 - 2;
            $bd = Carbon::createFromDate(Carbon::now()->year, $thangBatDau, 1)->startOfMonth()->startOfDay();
            $kt = Carbon::createFromDate(Carbon::now()->year, $thangBatDau + 2, 1)->endOfMonth()->endOfDay();

            $doan->with('doanvave.ve', function ($query) use ($bd, $kt) {
                $query->whereBetween('ngay_thanh_toan', [$bd, $kt]);
            });
        }

        if ($request->loc === 'thang') {
            $bd = Carbon::now()->startOfMonth()->startOfDay();
            $kt = Carbon::now()->endOfMonth()->endOfDay();

            $doan->with('doanvave.ve', function ($query) use ($bd, $kt) {
                $query->whereBetween('ngay_thanh_toan', [$bd, $kt]);
            });
        }
        if ($request->loc === 'tuan') {
            $bd = Carbon::now()->startOfWeek()->startOfDay();
            $kt = Carbon::now()->endOfWeek()->endOfDay();

            $doan->with('doanvave.ve', function ($query) use ($bd, $kt) {
                $query->whereBetween('ngay_thanh_toan', [$bd, $kt]);
            });
        }
        $doan = $doan->get();
        //dd($doan->toArray());
        return view('admin.thongke.doanhthudoan', compact( 'doan','bd', 'kt'));
    }
    public function thongKeTheLoai(Request $request)
    {

        $theLoai = TheLoaiPhim::query();

        $bd = null;
        $kt = null;


        if ($request->has('bat_dau') && $request->has('ket_thuc')) {
            $bd = Carbon::parse($request->bat_dau)->startOfDay();
            $kt = Carbon::parse($request->ket_thuc)->endOfDay();

            $theLoai->with('phims.suatChieus.ves', function ($query) use ($bd, $kt) {
                $query->whereBetween('ngay_thanh_toan', [$bd, $kt]);
            });
        }

        if ($request->loc === 'nam') {
            $namHienTai = Carbon::now()->year;
            $bd = Carbon::createFromDate($namHienTai, 1, 1)->startOfDay();
            $kt = Carbon::now()->endOfDay();

            $theLoai->with('phims.suatChieus.ves', function ($query) use ($bd, $kt) {
                $query->whereBetween('ngay_thanh_toan', [$bd, $kt]);
            });
        }

        if (in_array($request->loc, ['1', '2', '3', '4'])) {
            $quy = (int)$request->loc;
            $thangBatDau = $quy * 3 - 2;
            $bd = Carbon::createFromDate(Carbon::now()->year, $thangBatDau, 1)->startOfMonth()->startOfDay();
            $kt = Carbon::createFromDate(Carbon::now()->year, $thangBatDau + 2, 1)->endOfMonth()->endOfDay();

            $theLoai->with('phims.suatChieus.ves', function ($query) use ($bd, $kt) {
                $query->whereBetween('ngay_thanh_toan', [$bd, $kt]);
            });
        }

        if ($request->loc === 'thang') {
            $bd = Carbon::now()->startOfMonth()->startOfDay();
            $kt = Carbon::now()->endOfMonth()->endOfDay();
            $theLoai->with('phims.suatChieus.ves', function ($query) use ($bd, $kt) {
                $query->whereBetween('ngay_thanh_toan', [$bd, $kt]);
            });
        }

        if ($request->loc === 'tuan') {
            $bd = Carbon::now()->startOfWeek()->startOfDay();
            $kt = Carbon::now()->endOfWeek()->endOfDay();

            $theLoai->with('phims.suatChieus.ves', function ($query) use ($bd, $kt) {
                $query->whereBetween('ngay_thanh_toan', [$bd, $kt]);
            });
        }

        $theLoai = $theLoai->get();

        return view('admin.thongke.thongketheloai', compact('theLoai', 'bd', 'kt'));
    }
    public function thongKeNguoiMuaVe(Request $request)
    {
        $nguoiMua = NguoiDung::query();

        $bd = null;
        $kt = null;

        if ($request->has('bat_dau') && $request->has('ket_thuc')) {
            $bd = Carbon::parse($request->bat_dau)->startOfDay();
            $kt = Carbon::parse($request->ket_thuc)->endOfDay();

            $nguoiMua->with('ves', function ($query) use ($bd, $kt) {
                $query->whereBetween('ngay_thanh_toan', [$bd, $kt]);
            });
        }

        if ($request->loc === 'nam') {
            $namHienTai = Carbon::now()->year;
            $bd = Carbon::createFromDate($namHienTai, 1, 1)->startOfDay();
            $kt = Carbon::now()->endOfDay();

            $nguoiMua->with('ves', function ($query) use ($bd, $kt) {
                $query->whereBetween('ngay_thanh_toan', [$bd, $kt]);
            });
        }

        if (in_array($request->loc, ['1', '2', '3', '4'])) {
            $quy = (int)$request->loc;
            $thangBatDau = $quy * 3 - 2;
            $bd = Carbon::createFromDate(Carbon::now()->year, $thangBatDau, 1)->startOfMonth()->startOfDay();
            $kt = Carbon::createFromDate(Carbon::now()->year, $thangBatDau + 2, 1)->endOfMonth()->endOfDay();

            $nguoiMua->with('ves', function ($query) use ($bd, $kt) {
                $query->whereBetween('ngay_thanh_toan', [$bd, $kt]);
            });
        }

        if ($request->loc === 'thang') {
            $bd = Carbon::now()->startOfMonth()->startOfDay();
            $kt = Carbon::now()->endOfMonth()->endOfDay();
            $nguoiMua->with('ves', function ($query) use ($bd, $kt) {
                $query->whereBetween('ngay_thanh_toan', [$bd, $kt]);
            });
        }

        if ($request->loc === 'tuan') {
            $bd = Carbon::now()->startOfWeek()->startOfDay();
            $kt = Carbon::now()->endOfWeek()->endOfDay();

            $nguoiMua->with('ves', function ($query) use ($bd, $kt) {
                $query->whereBetween('ngay_thanh_toan', [$bd, $kt]);
            });
        }
   
        $nguoiMua = $nguoiMua->withCount([
            'ves' => function ($query)  use ($bd, $kt) {

                if ($bd && $kt) {
                    $query->whereBetween('ngay_thanh_toan', [$bd, $kt]);
                }
            }
        ])->orderByDesc('ves_count')
            ->get();
    
        return view('admin.thongke.nguoimuave', compact('nguoiMua', 'bd', 'kt'));
    }

}
