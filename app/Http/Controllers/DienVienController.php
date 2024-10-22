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
        $dienViens = DienVien::all();
        return view('admin.contents.dienViens.index', compact('dienViens'));
    }
    public function create()
    {
        return view('admin.contents.dienViens.creater');
    }
    public function store(Request $request)
    {
        $request->validate([
            'ten_dien_vien' => 'required|string|max:255',
            'anh_dien_vien' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nam_sinh' => 'required|date',
            'quoc_tich' => 'required|string|max:255',
            'gioi_tinh' => 'required|string',
            'trang_thai' => 'required|boolean',
            'tieu_su' => 'nullable|string', 
        ]);

        $path = $request->file('anh_dien_vien')->store('dien_vien', 'public');

        DienVien::create([
            'ten_dien_vien' => $request->ten_dien_vien,
            'anh_dien_vien' => $path, // Lưu đường dẫn ảnh
            'nam_sinh' => $request->nam_sinh,
            'quoc_tich' => $request->quoc_tich,
            'gioi_tinh' => $request->gioi_tinh,
            'trang_thai' => $request->trang_thai,
            'tieu_su' => $request->tieu_su,
        ]);
        return redirect()->route('dienVien.index')->with('success', 'Thêm mới Diễn viên thành công!');
    }
    public function edit(DienVien $dienVien)
    {
        return view('admin.contents.dienViens.edit', compact('dienVien'));
    }
    public function update(Request $request, DienVien $dienVien)
    {
        $request->validate([
            'ten_dien_vien' => 'required|string|max:255',
            'anh_dien_vien' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'nam_sinh' => 'required|date',
            'quoc_tich' => 'required|string|max:255',
            'gioi_tinh' => 'required|string',
            'trang_thai' => 'required|boolean',
            'tieu_su' => 'nullable|string',
        ]);
    
        if ($request->hasFile('anh_dien_vien')) {
            $path = $request->file('anh_dien_vien')->store('dien_vien', 'public');
            $dienVien->anh_dien_vien = $path; 
        }
        $dienVien->ten_dien_vien = $request->ten_dien_vien;
        $dienVien->nam_sinh = $request->nam_sinh;
        $dienVien->quoc_tich = $request->quoc_tich;
        $dienVien->gioi_tinh = $request->gioi_tinh;
        $dienVien->trang_thai = $request->trang_thai;
        $dienVien->tieu_su = $request->tieu_su; 
        $dienVien->save(); 
    
        return redirect()->route('dienVien.index')->with('success', 'Cập nhật Diễn Viên thành công!');
    }
    public function destroy(DienVien $dienVien)
    {
        if ($dienVien->anh_dien_vien) {
            Storage::disk('public')->delete($dienVien->anh_dien_vien);
        }
        $dienVien->delete();
        return redirect()->route('dienVien.index')->with('success', 'Diễn Viên đã được xóa thành công.');
    }
}
