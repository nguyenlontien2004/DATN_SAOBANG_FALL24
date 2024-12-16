<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DanhGia;
use App\Models\Phim;

class DanhgiaController extends Controller
{
    public function index(Request $request)
    {
        $phim = Phim::query()->withCount('danhGias')->get();
        //dd($phim->toArray());
        return view('admin.danhgia.index',compact('phim'));
    }
    public function chitietdanhgiaphim($id){
        $phim = Phim::query()->with([
            'danhGias',
            'theloaiphims',
            'daoDiens',
            'dienViens'
        ])->find($id);
        return view('admin.danhgia.chitietdanhgia',compact('phim'));
    }
    public function xoadanhgia($id){
        $danhgia = DanhGia::query()->find($id);
        $danhgia->delete();
       return back()->with('success','Xoá đánh giá này thành công');
    }
}
