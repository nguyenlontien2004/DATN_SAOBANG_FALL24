<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rap;
use App\Models\Phim;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RapController extends Controller
{
    public function index()
    {
        $rap = Rap::query()->withCount('phongChieus')->get();
        return view('user.rapphim', compact(['rap']));
    }
    public function chitietrap($id)
    {
        $rap = Rap::query()->withCount('phongChieus')->findOrFail($id);
        $idRap = $id;
        // dd($rap->toArray());
        $listday = collect();
        for ($i = 0; $i < 6; $i++) {
            $date = Carbon::now('Asia/Ho_Chi_Minh')->addDays($i);
            $dayName = $this->getCustomDayName($date->locale('vi')->dayName);

            $listday->push([
                'date' => $date->format('d-m'),
                'day' => $dayName,
                'ngaychuan' => $date->format('Y-m-d')
            ]);
        }
        return view('user.chitietrap', compact(['listday', 'rap', 'idRap']));
    }
    public function suatphimtheorap($id, $ngay)
    {
        try {
            $phim = Phim::query()
                ->select('id', 'ten_phim', 'do_tuoi', 'anh_phim', 'ngay_khoi_chieu', 'ngay_ket_thuc', 'trailer')
                ->with([
                    'suatChieus' => function ($query) use ($id) {
                        //->with(['phongChieu.rap'])
                        $query->select(
                            'suat_chieus.id',
                            'suat_chieus.phim_id',
                            'suat_chieus.phong_chieu_id',
                            DB::raw("TIME_FORMAT(suat_chieus.gio_bat_dau,'%H:%i') as gio_bat_dau"),
                            DB::raw("TIME_FORMAT(suat_chieus.gio_ket_thuc,'%H:%i') as gio_ket_thuc")
                        )
                            ->whereHas('phongChieu.rap', function ($qr) use ($id) {
                            $qr->where('id', $id);
                        });
                    }
                ])
                ->whereDate('ngay_ket_thuc', '>=', $ngay)
                ->get();
            return response()->json([
                'data' => $phim,
                'status' => 200,
                'msg' => 'success',
            ], 200);
        } catch (\Exception $th) {
            return response()->json([
                'data' => $th,
                'status' => 500,
                'msg' => 'error',
            ], 500);
        }
    }
    function getCustomDayName($dayName)
    {
        switch ($dayName) {
            case 'thứ hai':
                return 'Th 2';
            case 'thứ ba':
                return 'Th 3';
            case 'thứ tư':
                return 'Th 4';
            case 'thứ năm':
                return 'Th 5';
            case 'thứ sáu':
                return 'Th 6';
            case 'thứ bảy':
                return 'Th 7';
            case 'chủ nhật':
                return 'CN';
            default:
                return $dayName;
        }
    }
}
