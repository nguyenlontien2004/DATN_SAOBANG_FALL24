<?php

namespace App\Http\Controllers\NhanVien;

use App\Models\Ve;
use App\Models\GheNgoi;
use App\Models\ChiTietVe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VeController extends Controller
{
    public function index(){
        $curdate = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $currentTime = Carbon::now('Asia/Ho_Chi_Minh')->format('H:i');
        $litsTicket = Ve::query()
        ->withTrashed()
        ->with([
            'maGiamGia',
            'suatChieu' => function ($query) {
                $query->select(
                    'id',
                    'phong_chieu_id',
                    'phim_id',
                    'ngay',
                    DB::raw("TIME_FORMAT(gio_bat_dau,'%H:%i') as gio_bat_dau"),
                    DB::raw("TIME_FORMAT(gio_ket_thuc,'%H:%i') as gio_ket_thuc")
                )
                    ->with([
                        'phongChieu:id,rap_id,ten_phong_chieu',
                        'phim:id,ten_phim,thoi_luong,ngay_khoi_chieu'
                    ]);
            },
            'chiTietVe' => function ($query) {
                $query->select(['id', 've_id', 'ghe_ngoi_id'])->with([
                    'seat:id,phong_chieu_id,the_loai,so_hieu_ghe,hang_ghe,isDoubleChair',
                ]);
            },
            'user:id,ho_ten,email'
        ])->get();
        //dd($litsTicket->toArray());
        return view('nhanvien.ve.' . __FUNCTION__, compact(['litsTicket', 'curdate', 'currentTime']));
    }

}