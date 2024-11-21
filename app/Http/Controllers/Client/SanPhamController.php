<?php

namespace App\Http\Controllers\Client;

use Carbon\Carbon;
use App\Models\Phim;
use App\Models\DanhGia;
use App\Models\TheLoaiPhim;
use App\Models\BinhLuanPhim;
use Illuminate\Http\Request;
use App\Models\PhimVaTheLoai;
use PhpParser\Node\Expr\FuncCall;
use App\Http\Controllers\Controller;
use App\Models\Ve;
use Illuminate\Support\Facades\Auth;

class SanPhamController extends Controller
{
    public function SanPhamHome()
    {
        $title = "Trang chủ";
        $phimDangChieu = Phim::where('ngay_khoi_chieu', '<=', Carbon::now())
            ->where('ngay_ket_thuc', '>=', Carbon::now())
            ->get();
            $danhSachPhim = Phim::query()->paginate(1);
        return view('user.trangchu', compact('title', 'phimDangChieu','danhSachPhim'));
    }
    public function ChiTietPhim(string $id)
    {
        $title = "Chi tiết phim";
        $chiTietPhim = Phim::findOrFail($id);
        $chiTietPhim->increment('luot_xem_phim');
        $danhGiaPhim = DanhGia::findOrFail($id);
        $phimDangChieu = Phim::where('ngay_khoi_chieu', '<=', Carbon::now())
            ->where('ngay_ket_thuc', '>=', Carbon::now())
            ->get();
            $userId = null;
            if(Auth::check()){
                $userId = Auth::user()->id;
            }
            // if (Auth::check()) {
            //     $daMuaVe = Ve::query()
            //         ->where('nguoi_dung_id', Auth::id())
            //         ->whereHas('suatChieu', function ($query) use ($id) {
            //             $query->where('phim_id', $id);
            //         })
            //         ->exists();
            // }
        return view('user.chitietphim', compact('title', 'chiTietPhim', 'phimDangChieu', 'userId', 'danhGiaPhim'));
    }
    public function TimKiemPhim(Request $request)
    {
        $title = "Kết quả tìm kiếm";
        $timkiem = $request->input('timkiem');
        if ($timkiem) {
            $ketqua1 = Phim::where('ten_phim', 'LIKE', '%' . $timkiem . '%')
            ->get();
            $ketqua2 = TheLoaiPhim::where('ten_the_loai', 'LIKE', '%' .$timkiem. '%')
            ->get();
        } else {
            $ketqua = collect();
        }
        return view('user.timkiem', compact('title','timkiem', 'ketqua1', 'ketqua2'));
    }
    public function DanhSachPhim(){
        $title = "Danh sách phim";
        $danhSachPhim = Phim::query()->paginate(1);
        return view('user.danhsachphim', compact('title', 'danhSachPhim'));
    }
    public function PhimDangChieu(){
        $title = "Phim đang chiếu";
        $phimDangChieu = Phim::query()->paginate(1);
        return view('user.phimdangchieu', compact('title', 'phimDangChieu'));
    }
    public function DatVe(){
        $title = "Đặt vé";
        return view('user.datve', compact('title'));
    }
}
