<?php

namespace App\Http\Controllers\NhanVien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DanhGia;
use App\Models\Phim;

class NvDanhGiaController extends Controller
{
    public function index(Request $request)
    {
        $phim = Phim::query()->withCount('danhGias')->get();
        //dd($phim->toArray());
        return view('nhanVien.danhgia.index',compact('phim'));
    }
    public function chitietdanhgiaphim($id){
        $phim = Phim::query()->with([
            'danhGias',
            'theloaiphims',
            'daoDiens',
            'dienViens'
        ])->find($id);
        return view('nhanVien.danhgia.chitietdanhgia',compact('phim'));
    }
    public function xoadanhgia($id){
        $danhgia = DanhGia::query()->find($id);
        $danhgia->delete();
       return back()->with('success','Xoá đánh giá này thành công');
    }
}
