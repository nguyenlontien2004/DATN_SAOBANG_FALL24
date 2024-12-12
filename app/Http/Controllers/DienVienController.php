<?php

namespace App\Http\Controllers;

use App\Models\DienVien;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreDienVienRequest;
use App\Http\Requests\UpdateDienVienRequest;

class DienVienController extends Controller
{
    public function index()
    {
        $dienViens = DienVien::orderBy('id', 'desc')->get();
        return view('admin.contents.dienViens.index', compact('dienViens'));
    }
    public function show($id)
    {
        $dienViens = DienVien::findOrFail($id);
        return view('admin.contents.dienViens.show', compact('dienViens'));
    }
    public function create()
    {
        return view('admin.contents.dienViens.creater');
    }
    public function store(StoreDienVienRequest $request)
    {
        $path = $request->file('anh_dien_vien')->store('dien_vien', 'public');
        DienVien::create([
            'ten_dien_vien' => $request->ten_dien_vien,
            'anh_dien_vien' => $path,
            'nam_sinh' => $request->nam_sinh,
            'quoc_tich' => $request->quoc_tich,
            'gioi_tinh' => $request->gioi_tinh,
            'tieu_su' => $request->tieu_su,
        ]);

        return redirect()->route('dienVien.index')->with('success', 'Thêm mới Diễn viên thành công!');
    }
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $path = $request->file('upload')->storeAs('dien_vien', $fileName, 'public');
            $url = Storage::url($path);
            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }
    public function edit(DienVien $dienVien)
    {
        return view('admin.contents.dienViens.edit', compact('dienVien'));
    }
    public function update(UpdateDienVienRequest $request, DienVien $dienVien)
    {

        if ($request->hasFile('anh_dien_vien')) {
            $path = $request->file('anh_dien_vien')->store('dien_vien', 'public');
            $dienVien->anh_dien_vien = $path;
        }
        $dienVien->update([
            'ten_dien_vien' => $request->ten_dien_vien,
            'nam_sinh' => $request->nam_sinh,
            'quoc_tich' => $request->quoc_tich,
            'gioi_tinh' => $request->gioi_tinh,
            'trang_thai' => $request->trang_thai,
            'tieu_su' => $request->tieu_su,
        ]);

        return redirect()->route('dienVien.index')->with('success', 'Cập nhật Diễn Viên thành công!');
    }
    public function listSoftDelete()
    {
        $dienViens = DienVien::onlyTrashed()->paginate(5);
        return view('admin.contents.dienViens.listSoftDelete', compact('dienViens'));
    }
    public function softDelete($id)
    {
        $dienVien = DienVien::findOrFail($id);
        $dienVien->delete();
        return redirect()->route('dienVien.index')->with('success', 'Xóa mềm thành công!');
    }

    // Khôi phục
    public function restore($id)
    {
        $dienVien = DienVien::onlyTrashed()->findOrFail($id);
        $dienVien->restore();

        return redirect()->route('dienVien.listSoftDelete')->with('success', 'Khôi phục thành công!');
    }
    public function destroy(DienVien $dienVien)
    {
        $dienVien->trang_thai = 0;
        $dienVien->save();
        return redirect()->route('dienVien.index')->with('success', 'Diễn Viên đã được xóa thành công.');
    }
}
