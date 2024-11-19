<?php

namespace App\Http\Controllers;

use App\Models\NguoiDung;
use App\Models\VaiTro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenController extends Controller
{
    public function formDangKy()
    {
        return view('user.auth.dangky');
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

        return redirect()->back();
    }

    public function formDangNhap()
    {

        return view('user.dangnhap');
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

            return redirect()->route('/');
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

        return redirect()->route('/');
    }
}