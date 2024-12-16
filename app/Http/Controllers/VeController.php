<?php

namespace App\Http\Controllers;

use App\Models\Ve;
use App\Http\Requests\StoreVeRequest;
use App\Http\Requests\UpdateVeRequest;
use App\Models\DoAnVaChiTietVe;
use App\Models\NguoiDung;
use App\Models\SuatChieu;
use App\Models\MaGiamGia;
use App\Models\DoAn;
use App\Models\Phim;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Jobs\MailHuyVe;
use Illuminate\Http\Request;

class VeController extends Controller
{
    const PATH_VIEW = 'admin.ticket.';
    public function index(Request $request)
    {
        $curdate = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $currentTime = Carbon::now('Asia/Ho_Chi_Minh')->format('H:i');
        $phims = Phim::query()->get();

        $idPhim = isset($request->phim) ? $request->phim : null;
        $idPhongChieu = isset($request->phong_chieu) ? $request->phong_chieu : null;
        $idSuatchieu = isset($request->suat_chieu) ? $request->suat_chieu : null;

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
            ])->orderBy('created_at','desc')->get();
        if (isset($idPhim) && isset($idPhongChieu) && isset($idSuatchieu)) {
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
                ])
                ->when($idSuatchieu !== 'all', function ($query) use ($idSuatchieu) {
                    return $query->whereHas('suatChieu', function ($qr) use ($idSuatchieu) {
                        $qr->where('suat_chieus.id', $idSuatchieu);
                    });
                })
                ->when($idPhongChieu !== 'all', function ($query) use ($idPhongChieu) {
                    return $query->whereHas('suatChieu.phongChieu', function ($qr) use ($idPhongChieu) {
                        $qr->where('phong_chieus.id', $idPhongChieu);
                    });
                })
                ->when($idPhim !== 'all', function ($query) use ($idPhim) {
                    return $query->whereHas('suatChieu.phim', function ($qr) use ($idPhim) {
                        $qr->where('phims.id', $idPhim);
                    });
                })
                ->orderBy('created_at','desc')
                ->get();
        }
        //dd($litsTicket->toArray());
        return view(self::PATH_VIEW . __FUNCTION__, compact(['litsTicket', 'curdate', 'currentTime', 'phims']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $nguoidung = NguoiDung::query()->select(['id', 'ho_ten'])->get();
        $suatChieu = SuatChieu::query()
            ->select(['id', 'phong_chieu_id', 'phim_id', 'gio_bat_dau', 'gio_ket_thuc'])
            ->with('phongChieu:id,ten_phong_chieu')->get();
        $maGiamGia = MaGiamGia::query()
            ->select(['id', 'ten_ma_giam_gia', 'gia_tri_giam', 'so_luong', 'ngay_bat_dau', 'ngay_ket_thuc'])
            ->where([
                ['ngay_ket_thuc', '>=', date("Y/m/d")],
                ['so_luong', '>', 0]
            ])
            ->get();
        $doAn = DoAn::query()->select(['id', 'ten_do_an', 'gia'])->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact(['nguoidung', 'suatChieu', 'maGiamGia', 'doAn']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVeRequest $request)
    {
        //
    }
    public function huyveAdmin($id)
    {
        $ves = Ve::withTrashed()->with([
            'user',
            'suatChieu' => function ($query) {
             $query->select(
                'suat_chieus.id',
                'suat_chieus.phim_id',
                'suat_chieus.phong_chieu_id',
                DB::raw("TIME_FORMAT(suat_chieus.gio_bat_dau,'%H:%i') as gio_bat_dau"),
                DB::raw("TIME_FORMAT(suat_chieus.gio_ket_thuc,'%H:%i') as gio_ket_thuc")
            )->with('phim');
            }
        ])->find($id);
        // dd($ves->toArray());
        if ($ves->deleted_at !== null) {
            return back()->with('vedahuy', 'Vé đã được huỷ từ trước đó!');
        }
        if($ves->trang_thai == 0){
            return redirect()->back()->with('success', 'Vé đã quét không thể huỷ được');
        }

        $curDate = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $currentTime = Carbon::now('Asia/Ho_Chi_Minh')->format('H:i');
        $ve = Ve::with([
            'suatChieu' => function ($qr) {
                $qr->select([
                    'suat_chieus.id',
                    'suat_chieus.phong_chieu_id',
                    'suat_chieus.phim_id',
                    'suat_chieus.ngay',
                    'suat_chieus.trang_thai',
                    DB::raw("TIME_FORMAT(suat_chieus.gio_bat_dau,'%H:%i') as gio_bat_dau"),
                    DB::raw("TIME_FORMAT(suat_chieus.gio_ket_thuc,'%H:%i') as gio_ket_thuc")
                ]);
            }
        ])->findOrFail($id);

        $timegiobatdau = Carbon::createFromFormat('H:i', $ve->suatChieu->gio_bat_dau);
        if ($ve->ngay_ve_mo > $curDate) {
            $ve->delete();
            $this->congxukhihuyve($ve);
            MailHuyVe::dispatch($ves->user->email, $ves);
        } elseif ($ve->ngay_ve_mo == $curDate) {
            if ($timegiobatdau->diffInMinutes($currentTime) > 15) {
                $ve->delete();
                $this->congxukhihuyve($ve);
                MailHuyVe::dispatch($ves->user->email, $ves);
            } else {
                return redirect()->back()->with('cannotcancelled', 'Không thể hủy vé trước 15 phút giờ chiếu.');
            }
        }
        // $ve->delete();

        return redirect()->back()->with('success', 'Hủy vé thành công');
    }
    public function congxukhihuyve($ve)
    {
        $user = NguoiDung::query()->find($ve->nguoi_dung_id);
        $quydoixu = $ve->tong_tien / 1000;
        $user->gold = $user->gold + $quydoixu;
        $user->save();
    }

    /**
     * Display the specified resource.
     */
    public function detail($id)
    {
        $dataTicket = Ve::query()
            ->select(['id', 'nguoi_dung_id', 'ngay_ve_mo', 'ma_code_ve', 'qr_code', 'ngay_thanh_toan', 'suat_chieu_id', 'ma_giam_gia_id', 'phuong_thuc_thanh_toan', 'tong_tien', 'trang_thai'])
            ->with([
                'anhPhim',
                'maGiamGia',
                'suatChieu' => function ($query) {
                    $query->select(['id', 'phong_chieu_id', 'phim_id', DB::raw("TIME_FORMAT(gio_bat_dau,'%H:%i') as gio_bat_dau"), DB::raw("TIME_FORMAT(gio_ket_thuc,'%H:%i') as gio_ket_thuc")])->with([
                        'phongChieu' => function ($query) {
                            $query->select(['id', 'rap_id', 'ten_phong_chieu'])->with('cinema');
                        },
                        'phim:id,ten_phim,anh_phim,thoi_luong,ngay_khoi_chieu'
                    ]);
                },
                'chiTietVe' => function ($query) {
                    $query->select(['id', 've_id', 'ghe_ngoi_id'])->with([
                        'seat:id,phong_chieu_id,the_loai,so_hieu_ghe,hang_ghe,isDoubleChair',
                    ]);
                },
                'user:id,ho_ten,email,so_dien_thoai'
            ])->find($id);
        $food = DoAnVaChiTietVe::query()
            ->select(['do_an_id', 've_id', 'so_luong_do_an'])
            ->with([
                'food:id,ten_do_an,gia,hinh_anh'
            ])
            ->where('ve_id', $dataTicket->id)
            ->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact(['dataTicket', 'food']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ve $ve)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVeRequest $request, Ve $ve)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ve $ve)
    {
        //
    }
    public function checkQrCode($id)
    {
        // Tìm vé theo ID
        $ve = Ve::with(['suatChieu', 'suatChieu.phongChieu', 'suatChieu.phim'])->find($id); // Tải thông tin liên quan

        if ($ve) {
            return response()->json([
                'id' => $ve->id,
                // 'nguoi_dung_id' => $ve->nguoi_dung_id, 
                'phim' => $ve->suatChieu->phim->ten_phim,
                'phong_chieu' => $ve->suatChieu->phongChieu->ten_phong_chieu,
                'suat_chieu_id' => $ve->suat_chieu_id,
                'ngay_thanh_toan' => $ve->ngay_thanh_toan,
                'tong_tien' => $ve->tong_tien,
                'phuong_thuc_thanh_toan' => $ve->phuong_thuc_thanh_toan,

            ]);
        } else {
            return response()->json(['message' => 'Không tìm thấy thông tin vé!'], 404);
        }
    }
}
