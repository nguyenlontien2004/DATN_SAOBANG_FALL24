<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\SuatChieu;
use App\Models\Rap;
use App\Models\Phim;
use App\Models\MaGiamGia;
use App\Events\RealtimeSeat;

class DatVeController extends Controller
{
    public function laySuatChieuTheoNgay($id, $date)
    {
        $formattedDate = \Carbon\Carbon::createFromFormat('d-m-Y', $date . '-' . date('Y'))->format('Y-m-d');
        $rapvaSuatchieu = Rap::query()
            ->select(['id', 'ten_rap', 'dia_diem'])
            ->with([
                'suatChieu' => function ($query) use ($formattedDate, $id) {
                    $query->select('suat_chieus.id', 'suat_chieus.phong_chieu_id', DB::raw("TIME_FORMAT(suat_chieus.gio_bat_dau,'%H:%i') as gio_bat_dau"), DB::raw("TIME_FORMAT(suat_chieus.gio_ket_thuc,'%H:%i') as gio_ket_thuc"))
                        ->whereDate('ngay', $formattedDate)
                        ->where('phim_id', $id)->orderBy('gio_bat_dau');
                }
            ])->get();
        $rapvaSuatchieu = $this->checkSuatchieucuangayhientai($rapvaSuatchieu, $formattedDate);

        return response()->json([
            'status' => 200,
            'msg' => 'success',
            'data' => $rapvaSuatchieu
        ], 200);
    }
    public function checkSuatchieucuangayhientai($rapvaSuatchieu, $getDateUrl)
    {
        $array = [];
        $date = \Carbon\Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $currentTime = \Carbon\Carbon::now('Asia/Ho_Chi_Minh')->format('H:i');
        foreach ($rapvaSuatchieu as $value) {
            $arraySc = [];
            foreach ($value->suatChieu as $val) {
                $check = true;
                if ($date == $getDateUrl) {
                    //$val->gio_ket_thuc > $currentTime && 
                    $gioBatDau = \Carbon\Carbon::createFromFormat('H:i', $val->gio_bat_dau);
                    $gioBatDauTru15Phut = $gioBatDau->subMinutes(15)->format('H:i');
                    //dd($gioBatDauTru15Phut , $currentTime); 
                    if ($gioBatDauTru15Phut >= $currentTime) {
                        $check = false;
                    } else {
                        $check = true;
                    }
                } else if ($getDateUrl > $date) {
                    $check = false;
                }
                //$date == $getDateUrl  && $val->gio_ket_thuc < $currentTime && $val->gio_bat_dau > $currentTime ? false : true
                $arraySc[] = [
                    'id' => $val->id,
                    'phong_chieu_id' => $val->phong_chieu_id,
                    'gio_bat_dau' => $val->gio_bat_dau,
                    'gio_ket_thuc' => $val->gio_ket_thuc,
                    'suat_chieu_trong_ngay' => $check
                ];
            }
            $array[] = [
                'id' => $value->id,
                'ten_rap' => $value->ten_rap,
                'dia_diem' => $value->dia_diem,
                'suatChieu' => $arraySc,
            ];
        }
        return $array;
    }
    public function idghe(Request $request, $id, $ngay)
    {
        $dataSeat = $request->data;
        $idRemove = $request->idRemove;
        broadcast(new RealtimeSeat($id, $ngay, $dataSeat, $idRemove))->toOthers();
        return response()->json([
            'msg' => 'success'
        ]);
    }
    public function chuyenquatrangthanhtoan(Request $request, $id, $ngay)
    {
        session(['thong-tin-dat' => $request->all()]);
        // session()->forget('thong-tin-ve');
        return response()->json([
            'message' => 'Data saved!',
            'status' => 200,
            'redirect_url' => asset('thanh-toan/' . $id . '/' . $ngay),
        ], 200);
    }
    public function magiamgia(Request $request)
    {
        $magiamgia = MaGiamGia::query()->select('id', 'gia_tri_giam', 'so_luong')
            ->whereDate('ngay_ket_thuc', '>=', date('Y-m-d'))
            ->where('so_luong', '>', 0)
            ->where('ma_giam_gia', $request->macode);
        if ($magiamgia->exists()) {
            $code = $magiamgia->first();
            return response()->json([
                'data' => $code,
                'msg' => 'Áp dụng thành công mã'
            ]);
        } else {
            return response()->json([
                'msg' => 'Mã không tồn tại hoặc đã hết hạn!'
            ]);
        }
    }
}
