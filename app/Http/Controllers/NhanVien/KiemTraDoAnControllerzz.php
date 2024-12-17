<?php

namespace App\Http\Controllers\NhanVien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Ve;
use App\Models\DoAnVaChiTietVe;
use Illuminate\Support\Facades\DB;
class KiemTraDoAnControllerzz extends Controller
{
    public function quetdoan()
    {
        return view('nhanVien.quetdoan.quetdoan');
    }
    public function checkmacodedoan()
    {
        return view('nhanVien.quetdoan.checkmacodedoan');
    }
    public function kiemtradoantheomacode(Request $request)
    {
        $curdate = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $currentTime = Carbon::now('Asia/Ho_Chi_Minh')->format('H:i');
        $ve = Ve::query()
            ->withTrashed()
            ->with([
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
                'chiTietVe' => function ($qr) {
                    $qr->with([
                        'seat' => function ($q) {
                            $q->orderBy('hang_ghe')
                                ->orderBy('so_hieu_ghe');
                        }
                    ]);
                },
                'user'
            ])->where('ma_code_ve', $request->macode)->first(); // Tải thông tin liên quan


        if ($ve) {
            $gioBatDau = Carbon::createFromFormat('H:i', $ve->suatChieu->gio_bat_dau);
            $gioBatDauTru15Phut = $gioBatDau->subMinutes(15)->format('H:i');
            // if ($ve->trang_thai == 0) {
            //     return $this->responve($ve,'Vé đã được quét rồi',409);
            // }
            if ($ve->deleted_at !== null) {
                return response()->json([
                    'message' => 'Vé này của bạn đã huỷ!',
                    'status' => 404
                ], 404);
            }
            if (count($ve->doAns) <= 0) {
                return response()->json([
                    'message' => 'Vé của bạn không có mua đồ ăn!'
                ], 404);
            }
            if ($curdate == $ve->ngay_ve_mo) {
                $gioketthuc = Carbon::createFromFormat('H:i', $ve->suatChieu->gio_ket_thuc);
                if ($currentTime > $ve->suatChieu->gio_ket_thuc) {
                    return $this->respondoan($ve, 'Vé xem phim của bạn đã kết thúc!', 409);
                }
                if ($currentTime < $gioBatDauTru15Phut) {
                    return $this->respondoan($ve, 'Bạn đến quá sớm! Vui lòng quay lại trong khoảng 15 phút trước giờ chiếu phim.!', 409);
                }
                $doanvave = DoAnVaChiTietVe::query()
                    ->where('do_an_id', $ve->doAns[0]->id)
                    ->where('ve_id', $ve->id)->first();
                //dd($doanvave->toArray());
                if ($doanvave->trang_thai == 0) {
                    return $this->respondoan($ve, 'Vé đồ ăn này đã được lấy.', 200);
                }
                foreach ($ve->doAns as $key => $value) {
                    $doanvave = DoAnVaChiTietVe::query()
                        ->where('do_an_id', $value->id)
                        ->where('ve_id', $ve->id)->update([
                                'trang_thai' => 0
                            ]);
                    // dd($doanvave->toArray());
                }
                return $this->respondoan($ve, 'Quét đồ ăn thành công', 200);

            } elseif ($curdate < $ve->ngay_ve_mo) {
                return $this->respondoan($ve, 'Vé đồ ăn của bạn chưa đến ngày mở xem bạn hãy đến đúng ngày để quét vé', 409);
            } else {
                return $this->respondoan($ve, 'Vé đồ ăn đã hết hạn', 409);
            }
        } else {
            return response()->json(['message' => 'Không tìm thấy thông tin vé đồ ăn này!'], 404);
        }

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
                'rap' => $ve->suatChieu->phongChieu->rap->ten_rap,
                'thoigiansuatchieu' => $ve->suatChieu->gio_bat_dau . '~' . $ve->suatChieu->gio_ket_thuc . ' (' . $ve->suatChieu->ngay . ')',
                'ngay_ve_mo' => $ve->ngay_ve_mo,
                'do_ans' => $ve->doAns,
            ]
        ], 200);
    }
}
