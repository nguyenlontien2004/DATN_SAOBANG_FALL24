<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rap;

class ThongKeDoanhThuRapController extends Controller
{
    public function thongkedoanhtheorap()
    {
        $rapThongke = Rap::query()->with([
            'ves'
        ])->get();
        //dd($rapThongke->toArray());
        return view('admin.thongke.doanhthutheorap', compact(['rapThongke']));
    }
    public function doanhthutheophong($idRap)
    {
        $phongChieu = Rap::query()->with([
            'phongChieus'=>function($query){
                $query->with('ves');
            }
        ])->find($idRap);
        //dd($phongChieu->toArray());
        return view('admin.thongke.doanhthutheophong',compact('phongChieu'));
    }
}
