<?php

namespace App\Http\Controllers;

use App\Models\Ve;
use App\Http\Requests\StoreVeRequest;
use App\Http\Requests\UpdateVeRequest;
use App\Models\DoAnVaChiTietVe;

class VeController extends Controller
{
    const PATH_VIEW = 'admin.ticket.';
    public function index()
    {
        $litsTicket = Ve::query()
            ->select(['id', 'nguoi_dung_id', 'ngay_thanh_toan', 'suat_chieu_id', 'ma_giam_gia_id','tong_tien', 'trang_thai'])
            ->with([
                'discountCode',
                'showtime' => function ($query) {
                    $query->select(['id', 'phong_chieu_id', 'phim_id', 'gio_bat_dau'])->with([
                        'screeningRoom:id,rap_id,ten_phong_chieu',
                        'movie:id,ten_phim,thoi_luong,ngay_khoi_chieu'
                    ]);
                },
                'detailTicket' => function ($query) {
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
        //
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
            ->select(['id', 'nguoi_dung_id', 'ngay_thanh_toan', 'suat_chieu_id', 'ma_giam_gia_id','tong_tien', 'trang_thai'])
            ->with([
                'discountCode',
                'showtime' => function ($query) {
                    $query->select(['id', 'phong_chieu_id', 'phim_id', 'gio_bat_dau'])->with([
                        'screeningRoom' => function ($query) {
                            $query->select(['id', 'rap_id', 'ten_phong_chieu'])->with('cinema');
                        },
                        'movie:id,ten_phim,thoi_luong,ngay_khoi_chieu'
                    ]);
                },
                'detailTicket' => function ($query) {
                    $query->select(['id', 've_id', 'ghe_ngoi_id'])->with([
                        'seat:id,phong_chieu_id,the_loai,so_hieu_ghe,hang_ghe,isDoubleChair',
                    ]);
                },
                'user:id,ho_ten,email,so_dien_thoai'
            ])->find($id);
        $food = DoAnVaChiTietVe::query()
        ->select(['do_an_id','chi_tiet_ve_id','so_luong_do_an'])
        ->with([
            'food:id,ten_do_an,gia,hinh_anh'
        ])
        ->where('chi_tiet_ve_id', $dataTicket->detailTicket[0]->id)
        ->get();
        //dd($dataTicket->detailTicket->toArray());
        return view(self::PATH_VIEW . __FUNCTION__, compact(['dataTicket','food']));
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
