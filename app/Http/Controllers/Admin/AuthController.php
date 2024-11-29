<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthAdminRequest;
use App\Models\NguoiDung;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function formDanngNhap()
    {
        return view('admin.auth.auth');
    }

    public function dangNhap()
    {

        $login = request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($login)) {
            request()->session()->regenerate();

            /**
             * @var NguoiDung $user
             */

            $user = Auth::user();

            if ($user->admin()) {

                return redirect('admin/');
            }
            // else if (condition) {
            //     # code...
            // }
        }

        return back()->withErrors(
            [
                'email' => ' Email không chính xác',
                'password' => 'Mật khẩu không chính xác'
            ]
        )->withInput();
    }

    public function dangXuat()
    {

        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect()->route('admin.form');
    }

    public function loginGoogle() {}
    public function loginFacebook() {}
}
