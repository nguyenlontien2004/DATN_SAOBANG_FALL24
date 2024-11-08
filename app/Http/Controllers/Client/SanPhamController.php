<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Phim;
use App\Models\PhimVaTheLoai;
use App\Models\TheLoaiPhim;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PhpParser\Node\Expr\FuncCall;

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
        $phimDangChieu = Phim::where('ngay_khoi_chieu', '<=', Carbon::now())
            ->where('ngay_ket_thuc', '>=', Carbon::now())
            ->get();
        return view('user.chitietphim', compact('title', 'chiTietPhim', 'phimDangChieu'));
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
