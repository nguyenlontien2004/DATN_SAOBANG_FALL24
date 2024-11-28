<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\AnhBannerQuangCao;

class BannerImageController extends Controller
{
    public function banner()
    {

        $banner = AnhBannerQuangCao::with('banner')
            ->orderBy('thu_tu')->get();

        return view('user.trangchu', compact('banner'));
    }
}
