<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\NguoiDung;

class CheckNhanVienRole
{
    /**
     * Handle an incoming request.
     *
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra người dùng đã đăng nhập hay chưa
        if (!Auth::check()) {
            return redirect()->route('nhanvien.form')->withErrors(['error' => 'Bạn phải đăng nhập trước!']);
        }

        // Kiểm tra vai trò nhân viên
        // $nhanVien = Auth::user();
        //         /**
        //  * @var NguoiDung $nhanVien
        //  */
        // if (!$nhanVien->nhanVien()) { // Kiểm tra quyền 'nhanvien'
        //     Auth::logout(); // Đăng xuất nếu không đúng role
        //     return redirect()->route('nhanvien.form')->withErrors(['error' => 'Bạn không có quyền truy cập trang này!']);
        // }

        // Nếu hợp lệ, tiếp tục xử lý request
        return $next($request);
    }
}
