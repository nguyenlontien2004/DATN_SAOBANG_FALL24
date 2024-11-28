<?php

namespace App\Http\Controllers;

use App\Models\TheLoaiPhim;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\StoreTheLoaiPhimRequest;
use App\Http\Requests\UpdateTheLoaiPhimRequest;

class TheLoaiPhimController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query('query');

        // Nếu có query, lọc theo id, ngược lại lấy tất cả
        if ($query) {
            $theLoaiPhims = TheLoaiPhim::where('id', $query)->get(); 
        } else {
            $theLoaiPhims = TheLoaiPhim::orderBy('id', 'desc')->get(); 
        }
       
        return view('admin.contents.theLoaiPhims.index', compact('theLoaiPhims'));
    }
    public function create()
    {
        return view('admin.contents.theLoaiPhims.creater');
    }
    public function store(StoreTheLoaiPhimRequest $request)
{
    TheLoaiPhim::create([
        'ten_the_loai' => $request->ten_the_loai,
    ]);

    return redirect()->route('theLoaiPhim.index')->with('success', 'Thể loại đã được thêm thành công!');
}

    public function edit(TheLoaiPhim $theLoaiPhim)
    {
        return view('admin.contents.theLoaiPhims.edit',compact('theLoaiPhim'));
    }

    public function update(UpdateTheLoaiPhimRequest $request, TheLoaiPhim $theLoaiPhim)
    {
        $theLoaiPhim->update([
            'ten_the_loai' => $request->ten_the_loai,
            'trang_thai' => $request->trang_thai,
        ]);
    
        return redirect()->route('theLoaiPhim.index')->with('success', 'Thể loại đã được cập nhật thành công!');
    }
    
    public function destroy(TheLoaiPhim $theLoaiPhim)
    {
        $theLoaiPhim->trang_thai = 0;
        $theLoaiPhim->save(); 
        return redirect()->route('theLoaiPhim.index')->with('success', 'Thể loại đã được xóa thành công!');
    }
    
}
