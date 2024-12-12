<?php

namespace App\Http\Controllers\NhanVien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NguoiDung;
use Illuminate\Support\Facades\Auth;

class NhanVienController extends Controller
{
    public function formDangNhap()
    {
        return view('nhanVien.auth.auth'); // Giao diện đăng nhập của nhân viên
    }
    public function dangNhap(Request $request)
    {
        // Validate dữ liệu đầu vào
        $login = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
    
        // Thực hiện đăng nhập
        if (Auth::attempt($login)) {
            $request->session()->regenerate();
    
            /**
             * @var NguoiDung $user
             */
            $user = Auth::user();
    
            // Kiểm tra quyền nhân viên
            if ($user->nhanVien()) {
                return redirect('nhanvien/')->with('success', 'Đăng nhập thành công!');
            }
    
            // Nếu không phải nhân viên, đăng xuất và thông báo lỗi
            Auth::logout();
            return redirect()->route('nhanvien.form')->withErrors([
                'error' => 'Bạn không có quyền truy cập với vai trò này.',
            ]);
        }
    
        // Nếu thông tin không chính xác
        return back()->withErrors([
            'error' => 'Email hoặc mật khẩu không chính xác.',
        ])->withInput();
    }
    public function dangXuat(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('nhanvien.form');
    }


}
