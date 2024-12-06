<?php

namespace App\Http\Controllers;

use App\Models\Ve;
use Carbon\Carbon;
use App\Models\Phim;
use App\Models\DanhGia;
use App\Http\Requests\StoreDanhGiaRequest;
use App\Http\Requests\UpdateDanhGiaRequest;
use App\Models\SuatChieu;

class DanhGiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $danhSachDanhGia = DanhGia::query()->get();
        // return view('user.chitietphim', compact('danhSachDanhGia'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDanhGiaRequest $request)
    {
        $userId = auth()->id(); // Lấy id người dùng hiện tại
        $phimId = $request->input('phim_id');
        // $suatChieuId = $request->input('suat_chieu_id'); // Nếu bạn muốn lọc theo suất chiếu cụ thể
        $phim = Phim::findOrFail($phimId); // Lấy phim theo ID
       $suatChieus = SuatChieu::where('phim_id', $phimId)->whereHas('ves', function ($query) use($userId) {
            $query->where('nguoi_dung_id', '=', $userId);
        })->get();

        // Đưa ra kết quả cuối cùng
        // dd($suatChieus);
        if ($suatChieus->isEmpty()) {
            return redirect()->route('chitietphim', $phimId)->with('error', 'Bạn cần mua vé trước khi đánh giá.');
        }
        // dd($suatChieus);
        $suatChieuDaKetThuc = $suatChieus->filter(function ($suatChieu) {
            // dd($suatChieu);
            $ngay = $suatChieu->ngay;
            $gioKetThuc = $suatChieu->gio_ket_thuc;
            $thoiGianKetThuc = Carbon::createFromFormat('Y-m-d H:i:s', $ngay . ' ' . substr($gioKetThuc, 11));

            return Carbon::now()->greaterThan($thoiGianKetThuc);
        });

        if ($suatChieuDaKetThuc->isEmpty()) {
            return redirect()->route('chitietphim', $phimId)->with('error', 'Bạn chỉ có thể đánh giá sau khi suất chiếu kết thúc.');
        }

        $request->validate([
            'noi_dung' => 'required|string',
            'diem_danh_gia' => 'required|integer|min:1|max:5',
        ]);

        DanhGia::create([
            'phim_id' => $phimId,
            'nguoi_dung_id' => $userId,
            'noi_dung' => $request->input('noi_dung'),
            'diem_danh_gia' => $request->input('diem_danh_gia'),
        ]);
        return redirect()->route('chitietphim', $phimId)->with('success', 'Đánh giá của bạn đã được gửi!');
    }

    /**
     * Display the specified resource.
     */
    public function show(DanhGia $danhGia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DanhGia $danhGia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDanhGiaRequest $request, DanhGia $danhGia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DanhGia $danhGia)
    {
        //
    }
}
