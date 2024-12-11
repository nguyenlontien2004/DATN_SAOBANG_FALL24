<?php

namespace App\Http\Controllers\NhanVien;

use App\Models\Ve;
use App\Models\GheNgoi;
use App\Models\ChiTietVe;
use Endroid\QrCode\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Endroid\QrCode\Writer\PngWriter;


class VeController extends Controller
{
    public function hienThiFormMuaVe()
    {
        $gheNgois = GheNgoi::where('trang_thai', 0)->get(); // Lấy ghế chưa được đặt
        return view('nhanvien.ve.mua', compact('gheNgois'));
    }

    public function luuVe(Request $request)
    {
        $request->validate([
            'nguoi_dung_id' => 'required|exists:nguoi_dungs,id',
            'ngay_thanh_toan' => 'required|date',
            'ghe_ngoi_ids' => 'required|array',
            'ghe_ngoi_ids.*' => 'exists:ghe_ngois,id',
        ]);

        $ve = Ve::create([
            'nguoi_dung_id' => $request->nguoi_dung_id,
            'ngay_thanh_toan' => $request->ngay_thanh_toan,
            'trang_thai' => 0, // Chưa thanh toán
        ]);

        foreach ($request->ghe_ngoi_ids as $ghe_ngoi_id) {
            ChiTietVe::create([
                've_id' => $ve->id,
                'ghe_ngoi_id' => $ghe_ngoi_id,
                'so_luong_ghe_ngoi' => 1,
                'trang_thai' => 0, // Chưa in
            ]);
        }

        return redirect()->route('ve.danh-sach-ve')->with('success', 'Vé đã được lưu.');
    }

    public function danhSachVe()
    {
        $ves = Ve::with('detailTicket')->where('trang_thai', 0)->get(); // Lấy vé chưa thanh toán
        return view('nhanvien.ve.danh-sach-ve', compact('ves'));
    }


    public function capNhatTrangThaiVe(Request $request, Ve $ve)
    {
        $request->validate([
            'trang_thai' => 'required|in:0,1',
        ]);

        $ve->update(['trang_thai' => $request->trang_thai]);

        return redirect()->route('ve.chua-thanh-toan')->with('success', 'Trạng thái vé đã được cập nhật.');
    }

    public function checkQrCode($id)
{
    try {
        // Tìm vé theo ID
        $ve = Ve::with(['showtime', 'showtime.screeningRoom', 'showtime.movie'])->find($id);

        if ($ve) {
            return response()->json([
                'id' => $ve->id,
                'phim' => $ve->showtime?->movie?->ten_phim ?? 'Không xác định',
                'phong_chieu' => $ve->showtime?->screeningRoom?->ten_phong_chieu ?? 'Không xác định',
                'suat_chieu_id' => $ve->suat_chieu_id,
                'ngay_thanh_toan' => $ve->ngay_thanh_toan,
                'tong_tien' => $ve->tong_tien,
                'phuong_thuc_thanh_toan' => $ve->phuong_thuc_thanh_toan,
            ]);
        } else {
            Log::warning("Không tìm thấy vé với ID: $id");
            return response()->json(['message' => 'Không tìm thấy thông tin vé!'], 404);
        }
    } catch (\Exception $e) {
        Log::error("Lỗi khi truy vấn vé: " . $e->getMessage());
        return response()->json(['message' => 'Lỗi hệ thống. Vui lòng thử lại sau!'], 500);
    }
}

}
