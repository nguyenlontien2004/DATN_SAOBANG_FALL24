<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Phim;
use App\Models\PhongChieu;
use App\Models\SuatChieu;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\SeatsRowResource;

class ChiTietLichChieuController extends Controller
{
    //chitietsuatchieu
    public function index(Request $request)
    {
        $curdate = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');

        $idPhim = isset($request->phim) ? $request->phim : null;
        $idPhongChieu = isset($request->phong_chieu) ? $request->phong_chieu : null;
        $idSuatchieu = isset($request->suat_chieu) ? $request->suat_chieu : null;
        //dd($idPhim, $idPhongChieu,$idSuatchieu);
        $suatchieu  = null;
        if (isset($idPhim) && isset($idPhongChieu) && isset($idSuatchieu)) {
            $suatchieu = SuatChieu::query()->select(
                'id',
                'phong_chieu_id',
                'phim_id',
                'ngay',
                DB::raw("TIME_FORMAT(gio_bat_dau,'%H:%i') as gio_bat_dau"),
                DB::raw("TIME_FORMAT(gio_ket_thuc,'%H:%i') as gio_ket_thuc")
            )
                ->with([
                    'phim:id,ten_phim',
                    'phongChieu' => function ($qr) use ($curdate) {
                        $qr->select('id', 'ten_phong_chieu','rap_id')->with([
                            'rap:id,ten_rap,dia_diem',
                            'ghe_ngoi' => function ($quer) use ($curdate) {
                                $quer->select(['ghe_ngois.id', 'ghe_ngois.phong_chieu_id', 'ghe_ngois.hang_ghe', 'ghe_ngois.the_loai', 'ghe_ngois.so_hieu_ghe', 'ghe_ngois.isDoubleChair', 'ghe_ngois.trang_thai'])
                                    ->with([
                                        'chitietve' => function ($q) use ($curdate) {
                                            $q->with('ticket:id,suat_chieu_id,ngay_ve_mo');
                                        }
                                    ])->orderBy('hang_ghe')
                                    ->orderBy('so_hieu_ghe');
                            }
                        ]);
                    }
                ])
                ->when($idPhongChieu !== 'all', function ($query) use ($idPhongChieu) {
                    return $query->where('phong_chieu_id', $idPhongChieu);
                })
                ->when($idPhim !== 'all', function ($query) use ($idPhim) {
                    return $query->where('phim_id', $idPhim);
                })
                ->whereDate('ngay', '>=', $curdate);
            $suatchieu = $idSuatchieu == 'all' ? $suatchieu->orderBy('ngay', 'asc')->get()->groupBy('ngay') : 
            $suatchieu->where('id', $idSuatchieu)->orderBy('ngay', 'asc')->get()->groupBy('ngay');
           
            $suatchieu->transform(function ($itemsByNgay) {
                return $itemsByNgay->map(function ($suatChieu) {   
                    $groupedGheNgoi = $suatChieu->phongChieu->ghe_ngoi->groupBy('hang_ghe');
                    $suatChieu->phongChieu->grouped_ghe_ngoi = $groupedGheNgoi;   
                    // $groupedGheNgoi = new SeatsRowResource($suatChieu->phongChieu->grouped_ghe_ngoi);
                    // $suatChieu->phongChieu->grouped_ghe_ngoi = $groupedGheNgoi;
                    return $suatChieu;
                });
            });
        }

        $phims = Phim::query()->get();
        return view('admin.chitietsuatchieu.index', compact(['phims','suatchieu']));
    }
    public function phongchieutheophim($id)
    {
        $curdate = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');

        $phongchieu = PhongChieu::query()
            ->select('id', 'rap_id', 'ten_phong_chieu')
            ->with(['rap'])
            ->withCount([
                'suatChieu' => function ($query) use ($id, $curdate) {
                    $query
                        ->whereDate('ngay', '>=', $curdate)
                        ->where('phim_id', $id);//
                }
            ])

            ->having('suat_chieu_count', '>', 0)
            ->get();

        return response()->json([
            'status' => 200,
            'data' => $phongchieu
        ], 200);
    }
    public function suatchieutheophongvaphim($idphim, $idphongchieu)
    {
        $curdate = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $suatchieu = SuatChieu::query()
            ->select(
                'id',
                'phong_chieu_id',
                'phim_id',
                DB::raw("DATE_FORMAT(ngay, '%d-%m-%Y') as ngay"),
                'gio_bat_dau',
                'gio_ket_thuc',
                DB::raw("TIME_FORMAT(gio_bat_dau,'%H:%i') as gio_bat_dau"),
                DB::raw("TIME_FORMAT(gio_ket_thuc,'%H:%i') as gio_ket_thuc")
            )
            ->with([
                'phongChieu' => function ($query) {
                    $query->select('id', 'rap_id')
                        ->with('rap:id,ten_rap');
                },
                // 'phongChieu',
                'phim:id,ten_phim'
            ])
            ->where('phim_id', $idphim)
            ->whereDate('ngay', '>=', $curdate)
            ->where('phong_chieu_id', $idphongchieu)
            ->get();
        // dd($idphim, $idphongchieu, $suatchieu->toArray());
        return response()->json([
            'status' => 200,
            'data' => $suatchieu
        ], 200);
    }
}

           // $groupedGheNgoi = $suatChieu->phongChieu->ghe_ngoi->groupBy('hang_ghe');
                    //$suatChieu->phongChieu->setRelation('ghe_ngoi', $groupedGheNgoi);
                    //$suatChieu->phongChieu->ghe_ngoi = $groupedGheNgoi;

            // ->with([
            //     'suatChieu'=>function($query)use($id,$curdate){
            //         $query
            //         ->whereDate('ngay','>=',$curdate)
            //         //->whereRaw("TIME_FORMAT(gio_bat_dau, '%H:%i') < TIME_FORMAT(CURTIME(), '%H:%i')")
            //         ->where('phim_id',$id);//->whereDate('ngay','>=',$curdate)
            //     }
            // ])
