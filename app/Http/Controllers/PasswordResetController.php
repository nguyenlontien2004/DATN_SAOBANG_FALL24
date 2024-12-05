<?php

namespace App\Http\Controllers;

use App\Models\NguoiDung;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PasswordResetController extends Controller
{
    public function formForgotPass()
    {
        return view('user.auth.forgotpass');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:nguoi_dungs,email',
        ]);

        $lengh = 64;

        $token = Str::random($lengh);

        DB::table('password_reset_tokens')->insert(
            [
                'email' => $request->email,
                'token' => $token,
                'created_at' => now(),
            ]
        );

        $link = route('reset.pass', ['token' => $token]);

        Mail::send('user.mail.resetpass', ['link' => $link], function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Reset Pass');
        });

        return back()->with('message', 'link đã được gửi tới bạn');
    }

    public function formResetPass($token)
    {

        $passwordReset = DB::table('password_reset_tokens')->where('token', $token)->first();

        if (!$passwordReset) {
            return redirect()->route('forgot.password')->withErrors(['error' => 'Token không hợp lệ hoặc đã hết hạn']);
        }
        return view('user.auth.resetpass', ['token' => $token]);
    }

    public function resetPass(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'email' => 'required|email|exists:nguoi_dungs,email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required',
        ]);

        $reset = DB::table('password_reset_tokens')->where([
            
            ['email', $request->email],
            ['token', $request->token],
            
        ])->first();

        if (!$reset) {
            return back()->withErrors(['email' => 'Token không hợp lệ']);
        }

        // Cập nhật mật khẩu cho user
        NguoiDung::where('email', $request->email)->update([
            'password' => Hash::make($request->password),
        ]);

        // Xóa token sau khi đã reset mật khẩu thành công
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('dangnhap')->with('message', 'Đặt lại mật khẩu thành công. Mời đăng nhập');
    }
}