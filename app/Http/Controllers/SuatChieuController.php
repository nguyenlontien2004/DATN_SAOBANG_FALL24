<?php

namespace App\Http\Controllers;

use App\Models\Phim;
use App\Models\SuatChieu;
use App\Models\PhongChieu;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

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
    public function store(Request $request)
    {

        $ngay = date('Y-m-d');
        $timestamp_bat_dau = Carbon::createFromFormat('Y-m-d H:i', $ngay . ' ' . $request->gio_bat_dau);
        $timestamp_ket_thuc = Carbon::createFromFormat('Y-m-d H:i', $ngay . ' ' . $request->gio_ket_thuc);

        $request->validate([
            'phong_chieu_id' => 'required|exists:phong_chieus,id',
            'phim_id' => 'required|exists:phims,id',
            'gio_bat_dau' => 'required',
            'gio_ket_thuc' => 'required',
            // 'trang_thai' => 'required|boolean',
        ]);

        SuatChieu::create([
            'phong_chieu_id' => $request->phong_chieu_id,
            'phim_id' => $request->phim_id,
            'gio_ket_thuc' => $timestamp_ket_thuc,
            'gio_bat_dau' => $timestamp_bat_dau,
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

        $ngay = $request->ngay;
        $timestamp_bat_dau = Carbon::createFromFormat('Y-m-d H:i', $ngay . ' ' . $request->gio_bat_dau);
        $timestamp_ket_thuc = Carbon::createFromFormat('Y-m-d H:i', $ngay . ' ' . $request->gio_ket_thuc);


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
            'gio_bat_dau' => $timestamp_bat_dau,
            'gio_ket_thuc' => $timestamp_ket_thuc,
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