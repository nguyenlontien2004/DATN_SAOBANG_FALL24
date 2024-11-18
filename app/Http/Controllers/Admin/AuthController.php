<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthAdminRequest;
use App\Models\NguoiDung;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.auth.auth');
    }
    public function postLogin(AuthAdminRequest $request)
    {
        $login = NguoiDung::query()
            ->select(['id', 'ho_ten', 'email', 'so_dien_thoai', 'anh_dai_dien'])
            ->with('role:id,ten_vai_tro')
            ->where([
                ['email', '=', $request->email],
                ['password', '=', $request->password]
            ]);
        //dd($login->get()->toArray());

        if ($login->exists()) {
            $infoLogin = $login->first();
            if ($infoLogin->checkAdmin()) {
                session(['auth' => $infoLogin]);
                return redirect('admin/');
            }
            return abort(403, 'Bạn không có thẩm quyền vào trang này');
        }
        return back()->with('error', 'Email hoặc mật khẩu không hợp lệ!');
    }
    public function loginGoogle() {}
    public function loginFacebook() {}
}