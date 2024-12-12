<?php

namespace App\Http\Controllers;

use App\Models\DienVien;
use Illuminate\Http\Request;

class NgheSiController extends Controller
{
    public function index($id)
    {
        $dienvien = DienVien::query()->find($id);
        //dd($dienvien->toArray());
        return view('user.thongtinnghesi', compact(['dienvien']));
    }
    public function daodien($id) {}
}
