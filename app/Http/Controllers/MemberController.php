<?php

namespace App\Http\Controllers;

use App\Models\Ve;
use App\Models\NguoiDung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\DoiMatKhauRequest;

class MemberController extends Controller
{
    public function trangChu()
    {
        return view('user.trangchu');
    }

    public function formDoiMatKhau()
    {
        return view('user.doimatkhau');
    }

    public function doiMatKhau(DoiMatKhauRequest $doiMatKhauRequest)
    {
        $nguoidung = Auth::user();

        if (!Hash::check($doiMatKhauRequest->mat_khau_cu, $nguoidung->password)) {
            return back()->withErrors(['mat_khau_cu' => 'Mật khẩu cũ không chính xác']);
        }

        $nguoidung->password = bcrypt($doiMatKhauRequest->mat_khau_moi);

        /**
         * @var NguoiDung $nguoidung
         */

        $nguoidung->save();

        return redirect()->route('doimatkhau')->with('success', 'Đổi mật khẩu thành công');
    }


    public function thongTin()
    {
        $nguoidung = Auth::user();

        return view('user.thongtintaikhoan', compact('nguoidung'));
    }


    public function formCapNhatThongTin()
    {
        $nguoidung = Auth::user();

        return view('user.profile.capnhatthongtin', compact('nguoidung'));
    }

    public function capNhatThongTin(Request $request)
    {
        $user = Auth::user();

        if ($request->hasFile('anh_dai_dien')) {
            $imagePath = $request->file('anh_dai_dien')->store('profile_images', 'public');
            $user->anh_dai_dien = $imagePath;
        }

        $user->ho_ten = $request->input('ho_ten');

        /**
         * @var Use $user
         */

        $user->save();

        return redirect()->back()->with('success', 'Cập nhật thông tin thành công');
    }
    public function lichSuDatVe()
    {
        // Lấy danh sách vé đặt của user hiện tại
        $userId = Auth::id(); // Lấy ID user hiện tại
        $lichSuDatVe = Ve::where('nguoi_dung_id', $userId)->paginate(10); // Phân trang 10 vé mỗi trang
        return view('user.lichsuvedat', compact('lichSuDatVe'));
    }
    public function huyVe(Request $request, string $id){
        if($request->isMethod('DELETE')){
            $ve = Ve::findOrFail($id);
            $ve->delete();
        }
        return redirect()->back()->with('success', 'Hủy vé thành công');

    }
    // public function lichSuDatVe(string $id){
    //     $title = "Lịch sử đặt vé";
    //     $lichSuDatVe = Ve::findOrFail($id);
    //     return view('user.lichsuvedat', compact('title', 'lichSuDatVe'));
    // }

    // public function doiMatKhau(Request $request)
    // {
    //     $request->validate([
    //         'old_password' => 'required',
    //         'new_password' => 'required',
    //         'renew_password' => 'required|same:new_password',

    //     ]);

    //     $user = Auth::user();
    //     if (!Hash::check($request->old_password, $user->password)) {
    //         return back()->withErrors(
    //             [
    //                 'old_password' => 'Mật khẩu hiện tại không đúng.',
    //             ]
    //         );
    //     }
    //     $user->password = Hash::make($request->new_password);

    //     /**
    //      * @var Use $user
    //      */

    //     $user->save();

    //     return redirect()->back()->with('success', 'Đổi mật khẩu thành công');
    // }
}
