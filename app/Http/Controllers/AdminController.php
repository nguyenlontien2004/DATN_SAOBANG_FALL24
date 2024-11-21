<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function thongTin()
    {
        return view('admin.contents.nguoidung.admintt');
    }
}