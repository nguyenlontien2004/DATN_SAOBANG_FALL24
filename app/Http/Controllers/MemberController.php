<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoiMatKhauRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\NguoiDung;

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
}
