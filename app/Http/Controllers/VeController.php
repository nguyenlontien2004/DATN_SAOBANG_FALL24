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

class VeController extends Controller
{
    const PATH_VIEW = 'admin.ticket.';
    public function index()
    {
        $litsTicket = Ve::query()
            ->select(['id', 'nguoi_dung_id', 'ngay_thanh_toan', 'suat_chieu_id', 'ma_giam_gia_id', 'phuong_thuc_thanh_toan', 'tong_tien', 'trang_thai'])
            ->with([
                'maGiamGia',
                'suatChieu' => function ($query) {
                    $query->select(['id', 'phong_chieu_id', 'phim_id', 'gio_bat_dau'])->with([
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
        return view(self::PATH_VIEW . __FUNCTION__, compact(['litsTicket']));
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

    /**
     * Display the specified resource.
     */
    public function detail($id)
    {
        $dataTicket = Ve::query()
            ->select(['id', 'nguoi_dung_id', 'ngay_thanh_toan', 'suat_chieu_id', 'ma_giam_gia_id', 'phuong_thuc_thanh_toan', 'tong_tien', 'trang_thai'])
            ->with([
                'anhPhim',
                'maGiamGia',
                'suatChieu' => function ($query) {
                    $query->select(['id', 'phong_chieu_id', 'phim_id', 'gio_bat_dau'])->with([
                        'phongChieu' => function ($query) {
                            $query->select(['id', 'rap_id', 'ten_phong_chieu'])->with('cinema');
                        },
                        'phim:id,ten_phim,thoi_luong,ngay_khoi_chieu'
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
}
