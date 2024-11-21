<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\SuatChieu;
use App\Models\PhongChieu;
use App\Models\DoAn;
use App\Http\Resources\SeatsRowResource;
use App\Models\GheNgoi;
use Carbon\Carbon;

class DatVeController extends Controller
{
    function datve($id, $date)
    {
        $formattedDate = Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d');
        $suatchieu = SuatChieu::query()
            ->select('id', 'phong_chieu_id', 'phim_id', DB::raw("TIME_FORMAT(gio_bat_dau,'%H:%i') as gio_bat_dau"), DB::raw("TIME_FORMAT(gio_ket_thuc,'%H:%i') as gio_ket_thuc"))
            ->with([
                'phim:id,ten_phim,gia',
                'phongChieu:id,ten_phong_chieu,rap_id',
                'rap'
            ])
            ->find($id);
        //dd($suatchieu->toArray());
        $ghePhongChieu = PhongChieu::query()
            ->select(['id'])
            ->with([
                'ghe_ngoi' => function ($query) use ($formattedDate, $id) {
                    $query->select(['ghe_ngois.id', 'ghe_ngois.phong_chieu_id', 'ghe_ngois.hang_ghe', 'ghe_ngois.the_loai', 'ghe_ngois.so_hieu_ghe', 'ghe_ngois.isDoubleChair', 'ghe_ngois.trang_thai'])
                        ->withCount([
                            'chitietve' => function ($q) use ($formattedDate, $id) {
                                $q->join('ves', 'chi_tiet_ves.ve_id', '=', 'ves.id')
                                    ->whereDate('ngay-ve-mo', '=', $formattedDate)
                                    ->where('suat_chieu_id', $id);
                            }
                        ])
                        ->orderBy('hang_ghe')
                        ->orderBy('so_hieu_ghe');
                }
            ])
            ->find($suatchieu->phongChieu->id);
        //dd($ghePhongChieu->ghe_ngoi->groupBy('hang_ghe')->toArray());
        $hangghe = new SeatsRowResource($ghePhongChieu->ghe_ngoi->groupBy('hang_ghe'));
        //dd($hangghe->toArray(request()));
        $doAn = DoAn::query()->get();
        //dd($doAn->toArray());
        return view('user.vedat', compact(['suatchieu', 'id', 'date', 'hangghe', 'doAn']));
    }
    public function thanhToan()
    {
        //dd(session('thong-tin-dat'));
        $listIdGhe = session('thong-tin-dat')['hangghe'];
        return view('user.thanhtoan');
    }
}
