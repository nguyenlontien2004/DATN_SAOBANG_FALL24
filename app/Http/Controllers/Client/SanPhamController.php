<?php

namespace App\Http\Controllers\Client;

use Carbon\Carbon;
use App\Models\Phim;
use App\Models\DanhGia;
use App\Models\TheLoaiPhim;
use App\Models\BinhLuanPhim;
use App\Models\BaiVietTinTuc;
use Illuminate\Http\Request;
use App\Models\PhimVaTheLoai;
use PhpParser\Node\Expr\FuncCall;
use App\Http\Controllers\Controller;
use App\Models\Ve;
use App\Models\Rap;
use App\Models\AnhBannerQuangCao;
use App\Models\BannerQuangCao;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SanPhamController extends Controller
{
    public function SanPhamHome()
    {
        $title = "Trang chủ";
        $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $phimDangChieu = Phim::whereRelation('suatChieus', 'ngay', '>=', $today)->limit(8)
            ->get();
        //dd($phimDangChieu->toArray());
        $danhSachPhim = Phim::query()->paginate(1);
        $bannerDau = BannerQuangCao::with([
            'anhBanners' => function ($query) {
                $query->orderBy('thu_tu');
            }
        ])
            ->where('vi_tri', 'header')
            ->get();
        $bannerGiua = BannerQuangCao::with([
            'anhBanners' => function ($query) {
                $query->orderBy('thu_tu');
            }
        ])
            ->where('vi_tri', 'giữa')
            ->first();
        // sds
        $listday = collect();
        for ($i = 0; $i < 6; $i++) {
            $date = Carbon::now('Asia/Ho_Chi_Minh')->addDays($i);
            $dayName = $this->getCustomDayName($date->locale('vi')->dayName);

            $listday->push([
                'date' => $date->format('d-m'),
                'day' => $dayName,
                'ngaychuan' => $date->format('Y-m-d')
            ]);
        }
        $danhsachrap = Rap::query()
        ->get();

        $phimSapChieu = Phim::where('ngay_khoi_chieu', '>', Carbon::now())
            ->limit(8)->get();
         $BaiVietTinTuc = BaiVietTinTuc::query()->orderBy('ngay_dang','desc')->limit(4)->get();
         //dd($BaiVietTinTuc->toArray());

        return view('user.trangchu', compact('title','danhsachrap','listday', 'phimDangChieu', 'danhSachPhim', 'bannerDau', 'bannerGiua','phimSapChieu','BaiVietTinTuc'));
    }
    public function ChiTietPhim(string $id)
    {
        $title = "Chi tiết phim";
        $chiTietPhim = Phim::findOrFail($id);
        $chiTietPhim->increment('luot_xem_phim');
        $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        //$danhGiaPhim = DanhGia::findOrFail($id);
        $danhSachDanhGia = DanhGia::query()->where('phim_id',$chiTietPhim->id)->get();
        $phimDangChieu = Phim::whereRelation('suatChieus', 'ngay', '>=', $today)
        ->get();
        $userId = null;
        if (Auth::check()) {
            $userId = Auth::user()->id;
        }
        // phần phúc thêm vào
        $listday = collect();
        for ($i = 0; $i < 6; $i++) {
            $date = Carbon::now('Asia/Ho_Chi_Minh')->addDays($i);
            $dayName = $this->getCustomDayName($date->locale('vi')->dayName);

            $listday->push([
                'date' => $date->format('d-m'),
                'day' => $dayName
            ]);
        }
        $binhluan = BinhLuanPhim::query()->with('NguoiDung')->where('phim_id', $id)->orderBy('created_at', 'desc')->get();
        return view('user.chitietphim', compact('title', 'binhluan', 'chiTietPhim', 'phimDangChieu', 'userId', 'danhSachDanhGia', 'listday'));

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
        $danhSachPhim = Phim::query()->paginate(10);
        return view('user.danhsachphim', compact('title', 'danhSachPhim'));
    }

    public function PhimDangChieu(Request $request)
    {
        $title = "Phim đang chiếu";
        $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $theloai = TheLoaiPhim::query()->get();
        //dd($theloai->toArray());
        $phimDangChieu = Phim::query()->whereRelation('suatChieus', 'ngay', '>=', $today)
        ->get();
        if($request->input('the-loai')){
            $pluckidTl = $theloai->pluck('id');
            //dd($pluckidTl);
            $idtheloai = $request->input('the-loai');
            $phimDangChieu =  Phim::query()->whereHas('theloaiphims',function($query)use($idtheloai,$pluckidTl){
                    $query->whereIn('id',$idtheloai == 'all' ? $pluckidTl : [$idtheloai]);
                }
            )
            ->whereRelation('suatChieus', 'ngay', '>=', $today)
            ->get();
        }
        return view('user.phimdangchieu', compact('title', 'phimDangChieu','theloai'));
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
    public function suatphimtheorap($id, $ngay)
    {
        try {
            $rap = Rap::select('id','ten_rap','dia_diem')->find($id);
            $phim = Phim::query()
                ->select('id', 'ten_phim', 'do_tuoi', 'anh_phim', 'ngay_khoi_chieu', 'ngay_ket_thuc', 'trailer')
                ->with([
                    'suatChieus' => function ($query) use ($id,$ngay) {
                        $query->select(
                            'suat_chieus.id',
                            'suat_chieus.phim_id',
                            'suat_chieus.phong_chieu_id',
                            DB::raw("TIME_FORMAT(suat_chieus.gio_bat_dau,'%H:%i') as gio_bat_dau"),
                            DB::raw("TIME_FORMAT(suat_chieus.gio_ket_thuc,'%H:%i') as gio_ket_thuc")
                        )
                            ->whereHas('phongChieu.rap', function ($qr) use ($id) {
                            $qr->where('id', $id);
                        })->where('ngay', $ngay)->orderBy('gio_bat_dau');
                    }
                ])
                ->whereHas('suatChieus', function ($query) use ($id) {
                    $query->whereHas('phongChieu.rap', function ($qr) use ($id) {
                        $qr->where('id', $id);
                    });
                })
                ->get();
            $phim = $this->checkSuatchieucuangayhientai($phim,$ngay);
            return response()->json([
                'data' => [
                    'rap'=>$rap,
                    'phim'=>$phim
                ],
                'status' => 200,
                'msg' => 'success',
            ], 200);
        } catch (\Exception $th) {
            return response()->json([
                'data' => $th,
                'status' => 500,
                'msg' => 'error',
            ], 500);
        }
    }
    public function checkSuatchieucuangayhientai($phim, $getDateUrl)
    {
        $array = [];
        $date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $currentTime = Carbon::now('Asia/Ho_Chi_Minh')->format('H:i');
        foreach ($phim as $value) {
            $arraySc = [];
            foreach ($value->suatChieus as $val) {
                $check = true;
                if ($date == $getDateUrl) {
                    if ($val->gio_bat_dau > $currentTime) {
                        $check = false;
                    } else {
                        $check = true;
                    }
                } else if ($getDateUrl > $date) {
                    $check = false;
                }
                //$date == $getDateUrl  && $val->gio_ket_thuc < $currentTime && $val->gio_bat_dau > $currentTime ? false : true
                $arraySc[] = [
                    'id' => $val->id,
                    'phong_chieu_id' => $val->phong_chieu_id,
                    'gio_bat_dau' => $val->gio_bat_dau,
                    'gio_ket_thuc' => $val->gio_ket_thuc,
                    'suat_chieu_trong_ngay' => $check
                ];
            }
            if (count($value->suatChieus) > 0) {
                $array[] = [
                    'id' => $value->id,
                    'ten_phim' => $value->ten_phim,
                    'do_tuoi' => $value->do_tuoi,
                    'anh_phim' => $value->anh_phim,
                    'trailer' => $value->trailer,
                    'suat_chieus' => $arraySc
                ];
            }
        }

        return $array;
    }
}

