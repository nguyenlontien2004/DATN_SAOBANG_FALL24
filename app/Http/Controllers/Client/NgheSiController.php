<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DienVien;
use App\Models\DaoDien;

class NgheSiController extends Controller
{
    public function index($id){
      $dienvien = DienVien::query()->with([
        'phims'
      ])->find($id);
      //dd($dienvien->toArray());
      return view('user.thongtinnghesi',compact(['dienvien']));
    }
    public function daodien($id){
        $daodien = DaoDien::query()->with([
            'phims'
          ])->find($id);
          //dd($daodien->toArray());
          return view('user.daodien',compact(['daodien']));
    }
}
