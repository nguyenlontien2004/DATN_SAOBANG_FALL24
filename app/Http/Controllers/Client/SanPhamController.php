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
        return view('user.trangchu', compact('title', 'phimDangChieu', 'danhSachPhim'));
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
        if (Auth::check()) {
            $userId = Auth::user()->id;
        }
        $listday = collect();
        for ($i = 0; $i < 6; $i++) {
            $date = Carbon::now('Asia/Ho_Chi_Minh')->addDays($i);
            $dayName = $this->getCustomDayName($date->locale('vi')->dayName);

            $listday->push([
                'date' => $date->format('d-m'),
                'day' => $dayName
            ]);
        }
        return view('user.chitietphim', compact('title', 'chiTietPhim', 'phimDangChieu', 'userId', 'danhSachDanhGia', 'listday'));

    }

    public function TimKiemPhim(Request $request)
    {
        $title = "Kết quả tìm kiếm";
        $timkiem = $request->input('timkiem');
        if ($timkiem) {
            $ketqua1 = Phim::where('ten_phim', 'LIKE', '%' . $timkiem . '%')
                ->get();
            $ketqua2 = TheLoaiPhim::where('ten_the_loai', 'LIKE', '%' . $timkiem . '%')
                ->get();
        } else {
            $ketqua = collect();
        }
        return view('user.timkiem', compact('title', 'timkiem', 'ketqua1', 'ketqua2'));
    }

    public function DanhSachPhim()
    {
        $title = "Danh sách phim";
        $danhSachPhim = Phim::query()->paginate(1);
        return view('user.danhsachphim', compact('title', 'danhSachPhim'));
    }

    public function PhimDangChieu()
    {
        $title = "Phim đang chiếu";
        $phimDangChieu = Phim::query()->paginate(1);
        return view('user.phimdangchieu', compact('title', 'phimDangChieu'));
    }

    public function DatVe()
    {
        $title = "Đặt vé";
        return view('user.datve', compact('title'));
    }
    function getCustomDayName($dayName)
    {
        switch ($dayName) {
            case 'thứ hai':
                return 'Th 2';
            case 'thứ ba':
                return 'Th 3';
            case 'thứ tư':
                return 'Th 4';
            case 'thứ năm':
                return 'Th 5';
            case 'thứ sáu':
                return 'Th 6';
            case 'thứ bảy':
                return 'Th 7';
            case 'chủ nhật':
                return 'CN';
            default:
                return $dayName;
        }
    }
}

