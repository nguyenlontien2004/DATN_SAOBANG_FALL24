<?php

namespace App\Http\Controllers\NhanVien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NguoiDung;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ThongTinController extends Controller
{
    public function show()
    {
        $user = Auth::user(); // Lấy thông tin người dùng đang đăng nhập
        return view('nhanVien.thongTinCaNhan.index', compact('user'));
    }
    public function edit(string $id)
    {

        $thongTin = NguoiDung::findOrFail($id);
        return view('nhanVien.thongTinCaNhan.edit', compact('thongTin'));
    }
    public function update(Request $request, string $id)
    {
        if ($request->isMethod('PUT')) {
            //dd($request->all());
            $params = $request->except('_token', '_method');

            $thongTin = NguoiDung::findOrFail($id);

            if ($request->hasFile('anh_dai_dien')) {
                // Xóa ảnh cũ nếu có
                if ($thongTin->anh_dai_dien && Storage::disk('public')->exists($thongTin->anh_dai_dien)) {
                    Storage::disk('public')->delete($thongTin->anh_dai_dien);
                }
                //dd($request->input('anh_dai_dien'));
                // Lưu ảnh mới
                $filepath = $request->file('anh_dai_dien')->store('profile_images', 'public');
               // $filepath = $request->file('anh_dai_dien')->store('uploads/thongtincanhans', 'public');
            } else {
                // Giữ lại đường dẫn ảnh cũ nếu không có ảnh mới được tải lên
                $filepath = $thongTin->anh_dai_dien;
            }

            // Cập nhật đường dẫn hình ảnh vào $params
            $params['anh_dai_dien'] = $filepath;

            // Cập nhật thông tin sản phẩm
            $thongTin->update($params);

            return redirect()->route('profile.show')->with('success', 'Cập nhật dữ liệu thành công');
        }
    }
}
