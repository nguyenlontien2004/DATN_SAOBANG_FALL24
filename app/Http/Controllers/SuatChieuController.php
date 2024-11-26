<?php

namespace App\Http\Controllers;

use App\Models\Phim;
use App\Models\SuatChieu;
use App\Models\PhongChieu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSuatChieuRequest;
use App\Http\Requests\UpdateSuatChieuRequest;

class SuatChieuController extends Controller
{
    public function index(Request $request)
{
    $query = SuatChieu::with(['phongChieu', 'phim']);
    if ($request->filled('phim_id')) {
        $query->where('phim_id', $request->phim_id);
    }
    if ($request->filled('phong_chieu_id')) {
        $query->where('phong_chieu_id', $request->phong_chieu_id);
    }

    $suatChieus = $query->orderBy('id', 'desc')->get();

    $phims = Phim::where('trang_thai', 1)->get();
    $phongChieus = PhongChieu::where('trang_thai', 1)->get();
    return view('admin.contents.suatChieus.index', compact('suatChieus', 'phims', 'phongChieus'));
}

    public function create()
    {
        $phongChieus = PhongChieu::where('trang_thai', 1)->get();
        $phims = Phim::where('trang_thai', 1)->get();

        return view('admin.contents.suatChieus.creater', compact('phongChieus', 'phims'));
    }
    public function store(StoreSuatChieuRequest $request)
    {
        SuatChieu::create([
            'phong_chieu_id' => $request->phong_chieu_id,
            'phim_id' => $request->phim_id,
            'gio_ket_thuc' => $request->gio_ket_thuc,
            'gio_bat_dau' => $request->gio_bat_dau,
        ]);

        return redirect()->route('suatChieu.index')->with('success', 'Thêm suất chiếu thành công!');
    }
    public function edit(SuatChieu $suatChieu)
    {
        $phongChieus = PhongChieu::where('trang_thai', 1)->get();
        $phims = Phim::where('trang_thai', 1)->get();
        return view('admin.contents.suatChieus.edit', compact('suatChieu', 'phongChieus', 'phims'));
    }

    public function update(UpdateSuatChieuRequest $request, SuatChieu $suatChieu)
    {
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
