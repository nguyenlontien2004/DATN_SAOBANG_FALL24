<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthAdminRequest;
use App\Models\NguoiDung;
use App\Models\VaiTro;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function thongTin()
    {
        return view('admin.contents.profile.admintt');
    }

    public function formEdit()
    {
        $admin =  Auth::user();
        $vaitro = VaiTro::pluck('ten_vai_tro', 'id');
        $nguoidungvt = $admin->vaiTros->pluck('id')->toArray();

        return view('admin.contents.profile.edit', compact('admin', 'vaitro', 'nguoidungvt'));
    }

    public function editThongTin(AuthAdminRequest $request)
    {
        $nguoiDung  =  Auth::user();

        $nguoidung = $request->only(['ho_ten', 'email', 'so_dien_thoai', 'gioi_tinh', 'dia_chi', 'nam_sinh']);

        if ($request->hasFile('hinh_anh')) {
            $hinhanh = $request->file('hinh_anh')->store('uploads/nguoidung', 'public');
        } else {
            $hinhanh = $nguoiDung->hinh_anh;
        }

        $nguoidung['hinh_anh'] = $hinhanh;

        /**
         * @var NguoiDung $nguoiDung
         */

        $nguoiDung->update($nguoidung);

        return redirect()->route('tt.admin')
            ->with('success', 'Sửa người dùng thành công');
    }
}
