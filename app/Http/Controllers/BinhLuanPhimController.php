<?php

namespace App\Http\Controllers;

use App\Models\BinhLuanPhim;
use App\Http\Requests\StoreBinhLuanPhimRequest;
use App\Http\Requests\UpdateBinhLuanPhimRequest;
use Illuminate\Http\Request;
use App\Models\NguoiDung;
use App\Events\RealtimeComment;
use Carbon\Carbon;

class BinhLuanPhimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $idPhim)
    {
        // dd($request->all(),$idPhim);

        $idNguoidung = $request->idnguoidung;
        $nguoidung = NguoiDung::query()->find($idNguoidung);
        $date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $checkBinhLuan = BinhLuanPhim::query()
            ->where('phim_id', $idPhim)
            ->where('nguoi_dung_id', $nguoidung->id)
            ->whereDate('ngay_binh_luan', $date)
            ->get();

        if (count($checkBinhLuan) >= 5) {
            return response()->json([
                'msg' => 'Bạn đã đạt đến giới hạn bình luận trong ngày. Vui lòng góp ý vào ngày mai.',
                'status' => 403
            ], 200);
        }

        $binhluan = BinhLuanPhim::query()->create([
            'nguoi_dung_id' => $idNguoidung,
            'phim_id' => $idPhim,
            'noi_dung' => htmlspecialchars($request->noidung, ENT_QUOTES, 'UTF-8'),
            'ngay_binh_luan' => $date
        ]);

        $ngaybinhluan = $binhluan->created_at->locale('vi')->diffForHumans();
        // dd($nguoidung->toArray());
        broadcast(new RealtimeComment(
            $nguoidung->ho_ten,
            $idPhim,
            htmlspecialchars($request->noidung, ENT_QUOTES, 'UTF-8'),
            asset('storage/' . $nguoidung->anh_dai_dien),
            $ngaybinhluan,
            $request->idnguoidung
        ))->toOthers();

        return response()->json([
            'msg' => 'success',
            'status' => 200
        ], 200);
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
    public function store(StoreBinhLuanPhimRequest $request)
    {
        if ($request->isMethod('POST')) {
            $params = $request->except('_token');
            // dd($params);
            BinhLuanPhim::query()->create($params);
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(BinhLuanPhim $binhLuanPhim)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BinhLuanPhim $binhLuanPhim)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBinhLuanPhimRequest $request, BinhLuanPhim $binhLuanPhim)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BinhLuanPhim $binhLuanPhim)
    {
        //
    }
}
