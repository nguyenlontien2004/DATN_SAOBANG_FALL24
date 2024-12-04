<?php

namespace App\Http\Controllers\Client;

use App\Models\Ve;
use Carbon\Carbon;
use App\Models\Rap;
use App\Models\Phim;
use App\Models\DanhGia;
use App\Models\TheLoaiPhim;
use App\Models\BinhLuanPhim;
use Illuminate\Http\Request;
use App\Models\PhimVaTheLoai;
use PhpParser\Node\Expr\FuncCall;
use App\Http\Controllers\Controller;
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
            $rap = Rap::all();
        return view('user.trangchu', compact('title', 'phimDangChieu','danhSachPhim', 'rap'));
    }
    public function ChiTietPhim(string $id)
    {
        $rap = Rap::all();
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
        return view('user.chitietphim', compact('title', 'chiTietPhim', 'rap', 'phimDangChieu', 'userId', 'danhGiaPhim'));
    }
    public function TimKiemPhim(Request $request)
    {
        $title = "Kết quả tìm kiếm";
        $rap = Rap::all();
        $timkiem = $request->input('timkiem');
        if ($timkiem) {
            $ketqua1 = Phim::where('ten_phim', 'LIKE', '%' . $timkiem . '%')
            ->get();
            $ketqua2 = TheLoaiPhim::where('ten_the_loai', 'LIKE', '%' .$timkiem. '%')
            ->get();
        } else {
            $ketqua = collect();
        }
        return view('user.timkiem', compact('title', 'rap', 'timkiem', 'ketqua1', 'ketqua2'));
    }
    public function DanhSachPhim(){
        $rap = Rap::all();
        $title = "Danh sách phim";
        $danhSachPhim = Phim::query()->paginate(1);
        return view('user.danhsachphim', compact('title', 'rap', 'danhSachPhim'));
    }
    public function PhimDangChieu(){
        $title = "Phim đang chiếu";
        $rap = Rap::all();
        $phimDangChieu = Phim::query()->paginate(1);
        return view('user.phimdangchieu', compact('title', 'rap', 'phimDangChieu'));
    }
    public function DatVe(){
        $title = "Đặt vé";
        return view('user.datve', compact('title'));
    }
}
