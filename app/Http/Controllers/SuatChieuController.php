<?php

namespace App\Http\Controllers;

use App\Models\Ve;
use App\Models\Phim;
use App\Models\SuatChieu;
use App\Models\PhongChieu;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSuatChieuRequest;
use App\Http\Requests\UpdateSuatChieuRequest;

class SuatChieuController extends Controller
{
    public function getPhimDates(Request $request, $phim_id)
    {
        $phim = Phim::find($phim_id);
        if ($phim) {
            $ngay_khoi_chieu = \Carbon\Carbon::parse($phim->ngay_khoi_chieu);
            $ngay_ket_thuc = \Carbon\Carbon::parse($phim->ngay_ket_thuc);
            $dates = [];
            while ($ngay_khoi_chieu->lte($ngay_ket_thuc)) {
                $dates[] = $ngay_khoi_chieu->format('Y-m-d');
                $ngay_khoi_chieu->addDay();
            }
            return response()->json($dates);
        }
        return response()->json(['error' => 'Phim không tồn tại'], 404);
    }
    public function index(Request $request)
    {
        $loc = SuatChieu::with(['phongChieu', 'phim']);
        if ($request->filled('phim_id')) {
            $loc->where('phim_id', $request->phim_id);
        }
        if ($request->filled('phong_chieu_id')) {
            $loc->where('phong_chieu_id', $request->phong_chieu_id);
        }

        $suatChieus = $loc->orderBy('id', 'desc')->get();

        $phims = Phim::where('trang_thai', 1)->get();
        $phongChieus = PhongChieu::where('trang_thai', 1)->get();
        return view('admin.contents.suatChieus.index', compact('suatChieus', 'phims', 'phongChieus'));
    }
    public function show($id)
    {
        // Lấy thông tin về suất chiếu và phim liên quan
        // $phongChieus = PhongChieu::where('trang_thai', 1)->get();
        // $suatChieu = SuatChieu::with('phim') // Quan hệ với bảng Phim
        //                        ->where('id', $id)
        //                        ->first();

        // // Nếu không tìm thấy suất chiếu
        // if (!$suatChieu) {
        //     return redirect()->back()->with('error', 'Không tìm thấy suất chiếu.');
        // }

        // // Lấy phim thông qua quan hệ đã định nghĩa
        // $phim = $suatChieu->phim;

        // return view('admin.contents.suatChieus.show', compact('phongChieus', 'suatChieu', 'phim'));
        // Lấy thông tin về suất chiếu và phim liên quan
        $suatChieu = SuatChieu::with('phim', 'phongChieu') // Quan hệ với bảng Phim và PhongChieu
            ->where('id', $id)
            ->first();

        // Nếu không tìm thấy suất chiếu
        if (!$suatChieu) {
            return redirect()->back()->with('error', 'Không tìm thấy suất chiếu.');
        }

        // Lấy phim thông qua quan hệ đã định nghĩa
        $phim = $suatChieu->phim;
        $phongChieu = $suatChieu->phongChieu; // Phòng chiếu của suất chiếu hiện tại

        return view('admin.contents.suatChieus.show', compact('suatChieu', 'phim', 'phongChieu'));
    }

    public function create()
    {
        $phongChieus = PhongChieu::where('trang_thai', 1)->get();
        $phims = Phim::where('trang_thai', 1)->get();

        return view('admin.contents.suatChieus.creater', compact('phongChieus', 'phims'));
    }
    public function store(StoreSuatChieuRequest $request)
    {
        $phim = Phim::findOrFail($request->phim_id);
        $thoiLuong = $phim->thoi_luong;
        $ngay = $request->date;
        $timestamp_bat_dau = Carbon::createFromFormat('Y-m-d H:i', $ngay . ' ' . $request->gio_bat_dau);
        $timestamp_ket_thuc = $timestamp_bat_dau->copy()->addMinutes($thoiLuong);
        SuatChieu::create([
            'phong_chieu_id' => $request->phong_chieu_id,
            'phim_id' => $request->phim_id,
            'gio_bat_dau' => $timestamp_bat_dau,
            'gio_ket_thuc' => $timestamp_ket_thuc,
            'date' => $ngay,
        ]);
        return redirect()->route('suatChieu.index')->with('success', 'Thêm suất chiếu thành công!');
    }


    public function edit(SuatChieu $suatChieu)
    {
        $veDaBan = Ve::where('suat_chieu_id', $suatChieu->id)->where('ngay_ve_mo', $suatChieu->ngay)->exists();
        if ($veDaBan) {
            return redirect()->route('suatChieu.index')->with('error', 'Không thể cập nhật suất chiếu vì đã có vé được bán cho suất chiếu này.');
        }
        $phongChieus = PhongChieu::where('trang_thai', 1)->get();
        $phims = Phim::where('trang_thai', 1)->get();
        return view('admin.contents.suatChieus.edit', compact('suatChieu', 'phongChieus', 'phims'));
    }

    public function update(UpdateSuatChieuRequest $request, SuatChieu $suatChieu)
    {
        $phim = Phim::findOrFail($request->phim_id);
        $thoiLuong = $phim->thoi_luong;
        $ngay = $request->date;
        $timestamp_bat_dau = Carbon::createFromFormat('Y-m-d H:i', $ngay . ' ' . $request->gio_bat_dau);
        $timestamp_ket_thuc = $timestamp_bat_dau->copy()->addMinutes($thoiLuong);
        $suatChieu->update([
            'phong_chieu_id' => $request->phong_chieu_id,
            'phim_id' => $request->phim_id,
            'gio_bat_dau' => $timestamp_bat_dau,
            'gio_ket_thuc' => $timestamp_ket_thuc,
            'date' => $ngay,
        ]);
        return redirect()->route('suatChieu.index')->with('success', 'Cập nhật suất chiếu thành công!');
    }



    // public function destroy(SuatChieu $suatChieu)
    // {
    //     $suatChieu->trang_thai = 0;
    //     $suatChieu->save();
    //     return redirect()->route('suatChieu.index')->with('success', 'Thể loại đã được xóa thành công!');
    // }
    public function listSoftDelete()
    {
        $suatChieus = SuatChieu::onlyTrashed()->with(['phim', 'phongChieu.rap'])->paginate(5);
        return view('admin.contents.suatChieus.listSoftDelete', compact('suatChieus'));
    }
    public function softDelete($id)
    {
        $suatChieu = SuatChieu::findOrFail($id);
        $suatChieu->delete();
        return redirect()->route('suatChieu.index')->with('success', 'Xóa mềm thành công!');
    }
    
    // Khôi phục
    public function restore($id)
    {
        $suatChieu = SuatChieu::onlyTrashed()->findOrFail($id);
        $suatChieu->restore();
        return redirect()->route('suatchieu.listSoftDelete')->with('success', 'Khôi phục thành công!');
    }
    
    public function forceDelete($id)
    {
        $suatChieu = SuatChieu::onlyTrashed()->findOrFail($id);
        $suatChieu->forceDelete();
        return redirect()->route('suatchieu.listSoftDelete')->with('success', 'Xóa vĩnh viễn thành công!');
    }
    
}
