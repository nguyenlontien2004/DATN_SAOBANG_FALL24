<?php

namespace App\Http\Controllers;

use App\Models\Rap;
use App\Models\Phim;
use App\Models\DaoDien;
use App\Models\DienVien;
use App\Models\NguoiDung;
use App\Models\SuatChieu;
use App\Models\PhongChieu;
use App\Models\TheLoaiPhim;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ve;

class SearchController extends Controller
{
    // public function search(Request $request)
    // {
    //     $query = $request->input('query');

    //     // Tìm kiếm trong bảng daoDiens và dienViens
    //     $daoDiens = DaoDien::where('ten_dao_dien', 'like', '%'.$query.'%')->get();
    //     $dienViens = DienVien::where('ten_dien_vien', 'like', '%'.$query.'%')->get();

    //     // Kết hợp kết quả từ cả hai bảng
    //     $results = $daoDiens->merge($dienViens);

    //     // Trả kết quả về dưới dạng JSON
    //     return response()->json($results);
    // }
    public function search(Request $request)
    {

        // Lấy từ khóa tìm kiếm từ request
        $query = $request->input('query');

        $daoDienResults = DaoDien::where('ten_dao_dien', 'LIKE', "%{$query}%")->get();
        $dienVienResults = DienVien::where('ten_dien_vien', 'LIKE', "%{$query}%")->get();
        $phimResults = Phim::where('ten_phim', 'LIKE', "%{$query}%")->get();
        $rapResults = Rap::where('ten_rap', 'LIKE', "%{$query}%")->get();
        $phongchieuResults = PhongChieu::where('ten_phong_chieu', 'LIKE', "%{$query}%")->get();
        $theLoaiResults = TheLoaiPhim::where('ten_the_loai', 'LIKE', "%{$query}%")->get();
        $nguoiDungResults = NguoiDung::where('ho_ten', 'LIKE', "%{$query}%")->get();
        $suatChieuResults = SuatChieu::whereHas('phim', function ($subQuery) use ($query) {
            $subQuery->where('ten_phim', 'LIKE', "%{$query}%");
        })->get();
        $veResults = Ve::whereHas('user', function ($subQuery) use ($query) {
            $subQuery->where('ho_ten', 'LIKE', "%{$query}%");
        })->get();

        // Trả về view với kết quả tìm kiếm
        return view('admin.tim-kiem', compact('veResults', 'suatChieuResults', 'nguoiDungResults', 'theLoaiResults', 'daoDienResults', 'rapResults', 'phongchieuResults', 'dienVienResults', 'phimResults', 'query'));
    }
}
