<?php

namespace App\Http\Controllers\NhanVien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Phim;
use App\Models\BinhLuanPhim;

class NvBinhLuanController extends Controller
{
    public function index(Request $request)
    {
        $phim = Phim::query()->withCount('binhLuans')->get();
        //dd($phim->toArray());
        return view('nhanVien.binhluan.index', compact('phim'));
    }
    public function chitietbinhluanphim($id)
    {
        $phim = Phim::query()
            ->with([
                'binhLuans',
                'daoDiens',
                'dienViens',
            ])
            ->find($id);
        return view('nhanVien.binhluan.chitietbinhluan', compact('phim'));
    }
    public function xoabinhluan($id){
       $binhluan = BinhLuanPhim::query()->find($id);
       $binhluan->delete();
       return back()->with('success','Xoá bình luận thành công');
    }
}
