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
            $theLoaiPhims = TheLoaiPhim::where('id', $query)
            ->orWhere('ten_the_loai', 'LIKE', '%' . $query . '%')
            ->paginate(5); 
        } else {
            $theLoaiPhims = TheLoaiPhim::orderBy('id', 'desc')->paginate(5); 
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
        'deleted_at' => null,
       
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
    
    public function listSoftDelete()
    {
        $theLoaiPhims = TheLoaiPhim::onlyTrashed()->paginate(5);
        return view('admin.contents.theLoaiPhims.listSoftDelete', compact('theLoaiPhims'));
    }
    public function softDelete($id)
    {
        $theLoaiPhim = TheLoaiPhim::findOrFail($id);
        $theLoaiPhim->delete();
        return redirect()->route('theLoaiPhim.index')->with('success', 'Xóa mềm thành công!');
    }

    // Khôi phục
    public function restore($id)
    {
        $theLoaiPhim = TheLoaiPhim::onlyTrashed()->findOrFail($id);
        $theLoaiPhim->restore();

        return redirect()->route('theLoaiPhim.listSoftDelete')->with('success', 'Khôi phục thành công!');
    }
    public function forceDelete($id)
    {
        $theLoaiPhim = TheLoaiPhim::onlyTrashed()->findOrFail($id);
        $theLoaiPhim->forceDelete();

        return redirect()->route('theLoaiPhim.listSoftDelete')->with('success', 'Xóa vĩnh viễn thành công!');
    }
    
}
