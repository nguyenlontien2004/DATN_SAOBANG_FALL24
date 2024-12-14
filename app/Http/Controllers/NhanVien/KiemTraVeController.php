<?php

namespace App\Http\Controllers\NhanVien;

use App\Http\Controllers\Controller;
use App\Models\DoAnVaChiTietVe;
use Illuminate\Http\Request;
use App\Models\Ve;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class KiemTraVeController extends Controller
{
    public function quetve()
    {
        return view('nhanVien.quetve.quetve');
    }
    public function viewcheckmacodeve(){

        return view('nhanVien.quetve.checkmacodeve');
    }
    public function checkmacodeve(Request $request){
        $request->validate([
            'macode' => 'required',
        ]);
        $curdate = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $currentTime = Carbon::now('Asia/Ho_Chi_Minh')->format('H:i');
        $ve = Ve::with([
            'suatChieu' => function ($query) {
                $query->select(
                    'id',
                    'phong_chieu_id',
                    'ngay',
                    'gia',
                    'phim_id',
                    DB::raw("TIME_FORMAT(gio_bat_dau,'%H:%i') as gio_bat_dau"),
                    DB::raw("TIME_FORMAT(gio_ket_thuc,'%H:%i') as gio_ket_thuc")
                );

            },
            'suatChieu.phongChieu.rap',
            'suatChieu.phim',
            'chiTietVe'=>function($qr){
                $qr->with([
                    'seat'=>function($q){
                       $q ->orderBy('hang_ghe')
                       ->orderBy('so_hieu_ghe');
                    }
                ]);
            },
            'user'
        ])->where('ma_code_ve',$request->macode)->first(); // Tải thông tin liên quan
        if(!$ve){
            return response()->json([
            'msg'=>'Mã code này không tồn tại!',
            ],404);
        }
        if ($ve) {
            if ($ve->trang_thai == 0) {
                return $this->responve($ve,'Vé đã được quét rồi',409);
            }
            if ($curdate == $ve->ngay_ve_mo) {
                $gioketthuc = Carbon::createFromFormat('H:i', $ve->suatChieu->gio_ket_thuc);
                if ($currentTime > $gioketthuc) {
                    return $this->responve($ve,'Vé xem phim của bạn đã kết thúc!',409);
                }
                $ve->trang_thai = 0;
                $ve->save();
                return $this->responve($ve,'Quét vé thành công',200);

            } elseif ($curdate < $ve->ngay_ve_mo) {
                return $this->responve($ve,'Vé của bạn chưa đến ngày mở xem bạn hãy đến đúng ngày để quét vé',409);
            } else {
                return $this->responve($ve, 'Vé đã hết hạn', 409);
            }
        } else {
            return response()->json(['message' => 'Không tìm thấy thông tin vé!'], 404);
        }
    }
    public function laydoan($id){
        $curdate = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $currentTime = Carbon::now('Asia/Ho_Chi_Minh')->format('H:i');
        $ve = Ve::with([
            'suatChieu' => function ($query) {
                $query->select(
                    'id',
                    'phong_chieu_id',
                    'ngay',
                    'gia',
                    'phim_id',
                    DB::raw("TIME_FORMAT(gio_bat_dau,'%H:%i') as gio_bat_dau"),
                    DB::raw("TIME_FORMAT(gio_ket_thuc,'%H:%i') as gio_ket_thuc")
                );

            },
            'doAns',
            'suatChieu.phongChieu.rap',
            'suatChieu.phim',
            'chiTietVe'=>function($qr){
                $qr->with([
                    'seat'=>function($q){
                       $q ->orderBy('hang_ghe')
                       ->orderBy('so_hieu_ghe');
                    }
                ]);
            },
            'user'
        ])->find($id); // Tải thông tin liên quan
        //dd($ve->toArray());

        if ($ve) {
            // if ($ve->trang_thai == 0) {
            //     return $this->responve($ve,'Vé đã được quét rồi',409);
            // }
            if(empty($ve->doAns)){
                return response()->json([
                    'msg'=>'Vé của bạn không có mua đồ ăn!'
                ],404);
            }
            if ($curdate == $ve->ngay_ve_mo) {
                $gioketthuc = Carbon::createFromFormat('H:i', $ve->suatChieu->gio_ket_thuc);
                if ($currentTime > $gioketthuc) {
                    return $this->respondoan($ve,'Vé xem phim của bạn đã kết thúc!',409);
                }
                $doanvave = DoAnVaChiTietVe::query()
                   ->where('do_an_id',$ve->doAns[0]->id)
                   ->where('ve_id',$ve->id)->first();
                //dd($doanvave->toArray());
                if($doanvave->trang_thai == 0){
                    return $this->respondoan($ve,'Vé đồ ăn này đã được lấy.',200);
                }
                foreach ($ve->doAns as $key => $value) {
                   $doanvave = DoAnVaChiTietVe::query()
                   ->where('do_an_id',$value->id)
                   ->where('ve_id',$ve->id)->update([
                    'trang_thai'=> 0
                   ]);
                   // dd($doanvave->toArray());
                }
                return $this->respondoan($ve,'Quét đồ ăn thành công',200);

            } elseif ($curdate < $ve->ngay_ve_mo) {
                return $this->respondoan($ve,'Vé đồ ăn của bạn chưa đến ngày mở xem bạn hãy đến đúng ngày để quét vé',409);
            } else {
                return $this->respondoan($ve, 'Vé đồ ăn đã hết hạn', 409);
            }
        } else {
            return response()->json(['message' => 'Không tìm thấy thông tin vé đồ ăn này!'], 404);
        }
    }
    public function checkQrCode(Request $request,$id)
    {
        if(isset($request->doan)){
           return $this->laydoan($id);
        }
        $curdate = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $currentTime = Carbon::now('Asia/Ho_Chi_Minh')->format('H:i');
        $ve = Ve::with([
            'suatChieu' => function ($query) {
                $query->select(
                    'id',
                    'phong_chieu_id',
                    'ngay',
                    'gia',
                    'phim_id',
                    DB::raw("TIME_FORMAT(gio_bat_dau,'%H:%i') as gio_bat_dau"),
                    DB::raw("TIME_FORMAT(gio_ket_thuc,'%H:%i') as gio_ket_thuc")
                );

            },
            'doAns',
            'suatChieu.phongChieu.rap',
            'suatChieu.phim',
            'chiTietVe'=>function($qr){
                $qr->with([
                    'seat'=>function($q){
                       $q ->orderBy('hang_ghe')
                       ->orderBy('so_hieu_ghe');
                    }
                ]);
            },
            'user'
        ])->find($id); // Tải thông tin liên quan
        //dd($ve->chiTietVe->pluck('seat')->groupBy('the_loai')->toArray());

        if ($ve) {
            if ($ve->trang_thai == 0) {
                return $this->responve($ve,'Vé đã được quét rồi',409);
            }
            if ($curdate == $ve->ngay_ve_mo) {
                $gioketthuc = Carbon::createFromFormat('H:i', $ve->suatChieu->gio_ket_thuc);
                if ($currentTime > $gioketthuc) {
                    return $this->responve($ve,'Vé xem phim của bạn đã kết thúc!',409);
                }
                $ve->trang_thai = 0;
                $ve->save();
                return $this->responve($ve,'Quét vé thành công',200);

            } elseif ($curdate < $ve->ngay_ve_mo) {
                return $this->responve($ve,'Vé của bạn chưa đến ngày mở xem bạn hãy đến đúng ngày để quét vé',409);
            } else {
                return $this->responve($ve, 'Vé đã hết hạn', 409);
            }
        } else {
            return response()->json(['message' => 'Không tìm thấy thông tin vé!'], 404);
        }
    }
    public function responve($ve, $message, $statuscode)
    {
        $ghe = $ve->chiTietVe->pluck('seat')->groupBy('the_loai');
        return response()->json([
            'message' => $message,
            'satatus' => $statuscode,
            'data' => [
                'id' => $ve->id,
                'nguoi_dung' => $ve->user->ho_ten,
                'email' => $ve->user->email,
                'phim' => $ve->suatChieu->phim->ten_phim,
                'phong_chieu' => $ve->suatChieu->phongChieu->ten_phong_chieu,
                'rap'=>$ve->suatChieu->phongChieu->rap->ten_rap,
                'thoigiansuatchieu'=>$ve->suatChieu->gio_bat_dau.'~'.$ve->suatChieu->gio_ket_thuc.' ('.$ve->suatChieu->ngay.')',
                'ghe'=>$ghe,
                'ngay_ve_mo'=>$ve->ngay_ve_mo,
                'ngay_thanh_toan' => $ve->ngay_thanh_toan,
                'tong_tien' => number_format($ve->tong_tien,0,',','.'),
                'phuong_thuc_thanh_toan' => $ve->phuong_thuc_thanh_toan,
            ]
        ],200);
    }
    public function respondoan($ve, $message, $statuscode)
    {
        return response()->json([
            'message' => $message,
            'satatus' => $statuscode,
            'data' => [
                'nguoi_dung' => $ve->user->ho_ten,
                'email' => $ve->user->email,
                'phong_chieu' => $ve->suatChieu->phongChieu->ten_phong_chieu,
                'rap'=>$ve->suatChieu->phongChieu->rap->ten_rap,
                'thoigiansuatchieu'=>$ve->suatChieu->gio_bat_dau.'~'.$ve->suatChieu->gio_ket_thuc.' ('.$ve->suatChieu->ngay.')',
                'ngay_ve_mo'=>$ve->ngay_ve_mo,
                'do_ans'=>$ve->doAns,
            ]
        ],200);
    }
}
