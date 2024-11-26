<?php

namespace App\Http\Controllers;

use App\Models\Phim;
use App\Models\SuatChieu;
use App\Models\PhongChieu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SuatChieuController extends Controller
{
    public function index()
    {

        $suatChieus = SuatChieu::with(['phongChieu', 'phim'])->orderBy('id', 'desc')->get();
        return view('admin.contents.suatChieus.index', compact('suatChieus'));
    }
    public function create()
    {
        $phongChieus = PhongChieu::where('trang_thai', 1)->get();
        $phims = Phim::where('trang_thai', 1)->get();

        return view('admin.contents.suatChieus.creater', compact('phongChieus', 'phims'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'phong_chieu_id' => 'required|exists:phong_chieus,id',
            'phim_id' => 'required|exists:phims,id',
            'gio_bat_dau' => 'required',
            'gio_ket_thuc' => 'required',
            'trang_thai' => 'required|boolean',
        ]);
        SuatChieu::create([
            'phong_chieu_id' => $request->phong_chieu_id,
            'phim_id' => $request->phim_id,
            'gio_ket_thuc' => $request->gio_ket_thuc,
            'gio_bat_dau' => $request->gio_bat_dau,
            'trang_thai' => $request->trang_thai,
        ]);

        return redirect()->route('suatChieu.index')->with('success', 'Thêm suất chiếu thành công!');
    }
    public function edit(SuatChieu $suatChieu)
    {
        $phongChieus = PhongChieu::where('trang_thai', 1)->get();
        $phims = Phim::where('trang_thai', 1)->get();
        return view('admin.contents.suatChieus.edit', compact('suatChieu', 'phongChieus', 'phims'));
    }

    public function update(Request $request, SuatChieu $suatChieu)
    {
        $request->validate([
            'phong_chieu_id' => 'required|exists:phong_chieus,id',
            'phim_id' => 'required|exists:phims,id',
            'gio_ket_thuc' => 'required',
            'gio_bat_dau' => 'required',
            'trang_thai' => 'required|boolean',
        ]);
        $suatChieu->update([
            'phong_chieu_id' => $request->phong_chieu_id,
            'phim_id' => $request->phim_id,
            'gio_bat_dau' => $request->gio_bat_dau,
            'gio_ket_thuc' => $request->gio_ket_thuc,
            'trang_thai' => $request->trang_thai,
        ]);
        return redirect()->route('suatChieu.index')->with('success', 'Cập nhật suất chiếu thành công!');
    }
    public function destroy(SuatChieu $suatChieu)
    {
        $suatChieu->trang_thai = 0;
        $suatChieu->save();
        return redirect()->route('suatChieu.index')->with('success', 'Thể loại đã được xóa thành công!');
    }
}
