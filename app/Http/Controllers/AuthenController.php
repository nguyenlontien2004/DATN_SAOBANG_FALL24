<?php

namespace App\Http\Controllers;

use App\Models\Rap;
use App\Models\VaiTro;
use App\Models\NguoiDung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenController extends Controller
{
    public function formDangKy()
    {
        $title = "Đăng ký";
        $rap = Rap::all();
        return view('user.auth.dangky', compact('title', 'rap'));
    }

    public function dangKy()
    {
        $data = request()->validate([
            'ho_ten' => 'required',
            'nam_sinh' => 'required',

            'so_dien_thoai' => 'required',
            'email' => 'required|email|unique:nguoi_dungs',
            'password' => 'required|confirmed',
        ]);

        $data['password'] = bcrypt($data['password']);
        // dd($data);
        $nguoidung = NguoiDung::query()->create($data);

        $member = VaiTro::firstOrCreate(['ten_vai_tro' => 'member']);

        $nguoidung->vaiTros()->attach($member->id);

        Auth::login($nguoidung);

        request()->session()->regenerate();

        return redirect()->route('trangchu.member');
    }

    public function formDangNhap()
    {
        $title = "Đăng nhập";
        $rap = Rap::all();
        return view('user.auth.dangnhap', compact('title', 'rap'));
    }

    public function dangNhap()
    {
        $nguoidung = request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($nguoidung)) {

            request()->session()->regenerate();
            $user = Auth::user();

            // if ($user->admin()) {
            //    return redirect()->route('')
            // }
            return redirect()->route('trangchu.member');
        }

        return back()->withErrors([
            'email' => 'Email không chính xác',
            'password' => ' Mật khẩu không chính xác'
        ])->withInput();
    }

    public function dangXuat()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect()->route('trangchu.member');
    }
}