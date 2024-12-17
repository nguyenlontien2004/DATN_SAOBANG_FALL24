<?php

namespace App\Http\Controllers\NhanVien;

use App\Models\Ve;
use App\Models\GheNgoi;
use App\Models\ChiTietVe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VeController extends Controller
{
    public function index(){
        $curdate = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $currentTime = Carbon::now('Asia/Ho_Chi_Minh')->format('H:i');
        $litsTicket = Ve::query()
        ->withTrashed()
        ->with([
            'maGiamGia',
            'suatChieu' => function ($query) {
                $query->select(
                    'id',
                    'phong_chieu_id',
                    'phim_id',
                    'ngay',
                    DB::raw("TIME_FORMAT(gio_bat_dau,'%H:%i') as gio_bat_dau"),
                    DB::raw("TIME_FORMAT(gio_ket_thuc,'%H:%i') as gio_ket_thuc")
                )
                    ->with([
                        'phongChieu:id,rap_id,ten_phong_chieu',
                        'phim:id,ten_phim,thoi_luong,ngay_khoi_chieu'
                    ]);
            },
            'chiTietVe' => function ($query) {
                $query->select(['id', 've_id', 'ghe_ngoi_id'])->with([
                    'seat:id,phong_chieu_id,the_loai,so_hieu_ghe,hang_ghe,isDoubleChair',
                ]);
            },
            'user:id,ho_ten,email'
        ])
        ->orderBy('created_at', 'desc')
        ->paginate(8);
        //dd($litsTicket->toArray());
        return view('nhanVien.ve.' . __FUNCTION__, compact(['litsTicket', 'curdate', 'currentTime']));
    }
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

        return redirect()->route('ve.chua-thanh-toan')->with('success', 'Vé đã được lưu.');
    }

    public function danhSachVeChuaThanhToan()
    {
        $ves = Ve::with('detailTicket')->where('trang_thai', 0)->get(); // Lấy vé chưa thanh toán
        return view('nhanVien.ve.danh-sach-chua-thanh-toan', compact('ves'));
    }

    public function thanhToanVaInVe(Ve $ve)
    {
        $ve->update([
            'trang_thai' => 1, // Đã thanh toán
        ]);

        // Cập nhật trạng thái in cho chi tiết vé
        foreach ($ve->detailTicket as $chiTietVe) {
            $chiTietVe->update(['trang_thai' => 1]); // Đã in
        }

        return redirect()->route('ve.qr', $ve)->with('success', 'Thanh toán và in vé thành công.');
    }

    public function inMaQR(Ve $ve)
    {
        // Tạo URL từ route
        $url = route('ve.cap-nhat-trang-thai', ['ve' => $ve->id]);

        // Tạo đối tượng QR Code
        $qrCode = new QrCode($url); // Sử dụng QrCode trực tiếp

        // Tùy chỉnh kích thước và lề (nếu cần)
        $qrCode->setSize(200);
        $qrCode->setMargin(10);

        // Lưu ảnh QR vào thư mục public (nếu cần)
        $path = public_path('qrcodes/' . $ve->id . '.png');
        $writer = new PngWriter(); // Dùng PngWriter để lưu ảnh
        // $writer->writeFile($qrCode, $path);

        // Trả về view với đường dẫn của mã QR
        return view('nhanVien.ve.ma-qr', ['ve' => $ve, 'qrCodePath' => $path]);
    }
    public function capNhatTrangThaiVe(Request $request, Ve $ve)
    {
        $request->validate([
            'trang_thai' => 'required|in:0,1',
        ]);

        $ve->update(['trang_thai' => $request->trang_thai]);

        return redirect()->route('ve.chua-thanh-toan')->with('success', 'Trạng thái vé đã được cập nhật.');
    }

}