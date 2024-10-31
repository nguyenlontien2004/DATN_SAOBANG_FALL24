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
            'trang_thai' => $request->trang_thai,
            'tieu_su' => $request->tieu_su,
        ]);

        return redirect()->route('dienVien.index')->with('success', 'Thêm mới Diễn viên thành công!');
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
        $dienVien->trang_thai = 0;
        $dienVien->save();
        return redirect()->route('dienVien.index')->with('success', 'Diễn Viên đã được xóa thành công.');
    }
}
