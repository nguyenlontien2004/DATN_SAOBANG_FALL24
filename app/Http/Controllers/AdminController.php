<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthAdminRequest;
use App\Http\Requests\UpdateNguoiDungRequest;
use App\Models\NguoiDung;
use App\Models\VaiTro;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function thongTin()
    {
        return view('admin.contents.profile.admintt');
    }

    public function formEdit()
    {
        $admin = Auth::user();

        $vaitro = VaiTro::pluck('ten_vai_tro', 'id');

        // $nguoidungvt = $admin->vaiTros-?=

        return view('admin.contents.profile.edit', compact('vaitro', 'admin'));
    }

    public function editThongTin(UpdateNguoiDungRequest $request)
    {

        $dataNguoiDung = $request->only([
            'ho_ten',
            'email',
            'so_dien_thoai',
            'gioi_tinh',
            'dia_chi',
            'nam_sinh'
        ]);

        $nguoiDung = Auth::user();

        if ($request->hasFile('hinh_anh')) {

            if ($nguoiDung->hinh_anh) {
                Storage::delete($nguoiDung->hinh_anh);
            }

            $dataNguoiDung['hinh_anh'] = Storage::put('nguoidung', $request->file('hinh_anh'));
        }

        /**
         * @var NguoiDung $nguoiDung
         */

        // dd($dataNguoiDung);

        $nguoiDung->update($dataNguoiDung);

        return redirect()->route('admin.ttadmin')
            ->with('success', 'Sửa thông tin thành công');
    }
}