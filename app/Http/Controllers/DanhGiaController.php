<?php

namespace App\Http\Controllers;

use App\Models\DanhGia;
use App\Models\Ve;
use App\Models\SuatChieu;
use Carbon\Carbon;
use App\Models\Phim;
use App\Http\Requests\StoreDanhGiaRequest;
use App\Http\Requests\UpdateDanhGiaRequest;
use Illuminate\Support\Facades\DB;
class DanhGiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $danhSachDanhGia = DanhGia::query()->get();
        // return view('user.chitietphim', compact('danhSachDanhGia'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function store(StoreDanhGiaRequest $request)
    {
        $userId = auth()->id(); // Lấy id người dùng hiện tại
        $phimId = $request->input('phim_id');
        // $suatChieuId = $request->input('suat_chieu_id'); // Nếu bạn muốn lọc theo suất chiếu cụ thể
        $phim = Phim::findOrFail($phimId); // Lấy phim theo ID
       $suatChieus = SuatChieu::where('phim_id', $phimId)->whereHas('ves', function ($query) use($userId) {
            $query->where('nguoi_dung_id', '=', $userId);
        })->get();

        $danhgia = DanhGia::query()->where('phim_id',$phim->id)
        ->where('nguoi_dung_id',$userId)->get();

        if(count($danhgia) >= 3){
            return back()->with('gioihandanhgia','Bạn đã hết lượt đánh giá về phim');
        }

        // Đưa ra kết quả cuối cùng
        // dd($suatChieus);
        if ($suatChieus->isEmpty()) {
            return redirect()->route('chitietphim', $phimId)->with('error', 'Bạn cần mua vé trước khi đánh giá.');
        }
        // dd($suatChieus);
        $suatChieuDaKetThuc = $suatChieus->filter(function ($suatChieu) {
            // dd($suatChieu);
            $ngay = $suatChieu->ngay;
            $gioKetThuc = $suatChieu->gio_ket_thuc;
            $thoiGianKetThuc = Carbon::createFromFormat('Y-m-d H:i:s', $ngay . ' ' . substr($gioKetThuc, 11));

            return Carbon::now()->greaterThan($thoiGianKetThuc);
        });

        if ($suatChieuDaKetThuc->isEmpty()) {
            return redirect()->route('chitietphim', $phimId)->with('error', 'Bạn chỉ có thể đánh giá sau khi suất chiếu kết thúc.');
        }

        $request->validate([
            'noi_dung' => 'required|string',
            'diem_danh_gia' => 'required|integer|min:1|max:5',
        ]);

        DanhGia::create([
            'phim_id' => $phimId,
            'nguoi_dung_id' => $userId,
            'noi_dung' => $request->input('noi_dung'),
            'diem_danh_gia' => $request->input('diem_danh_gia'),
            'ngay_danh_gia' => date('Y-m-d'),
        ]);
        return redirect()->route('chitietphim', $phimId)->with('success', 'Đánh giá của bạn đã được gửi!');
    }
  
    // public function store(StoreDanhGiaRequest $request)
    // {
    //     $userId = auth()->id();
    //     $phimId = $request->input('phim_id');
    //     //$suatChieuId = $request->input('suat_chieu_id');
      
    //     $phim = Phim::findOrFail($phimId);
    //     //$suatChieu = $phim->suatChieus()->findOrFail($suatChieuId);

    //     // $ngay = $suatChieu->ngay;
    //     // $gioKetThuc = $suatChieu->gio_ket_thuc;

    //     //$thoiGianKetThuc = Carbon::createFromFormat('Y-m-d H:i:s', $ngay . ' ' . substr($gioKetThuc, 11));
    //     $date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
    //     $ve = Ve::query()->whereHas('suatChieu',function($query)use($phimId,$date){
    //             $query->select(
    //                 'suat_chieus.id',
    //                         'suat_chieus.phim_id',
    //                         'suat_chieus.phong_chieu_id',
    //                         DB::raw("TIME_FORMAT(suat_chieus.gio_bat_dau,'%H:%i') as gio_bat_dau"),
    //                         DB::raw("TIME_FORMAT(suat_chieus.gio_ket_thuc,'%H:%i') as gio_ket_thuc")
    //             )
    //             ->where('suat_chieus.phim_id',$phimId)
    //             ->whereDate('suat_chieus.ngay','<=',$date);
    //         }
    //     )
    //     ->with('check')
    //     ->where('nguoi_dung_id', $userId)
    //     ->get();
    //     dd($ve->toArray());
    //     if (!$ve) {
    //         return redirect()->route('chitietphim', $phimId)->with('error', 'Bạn cần mua vé trước khi đánh giá.');
    //     }

    //     if (Carbon::now()->lessThan($thoiGianKetThuc)) {
    //         return redirect()->route('chitietphim', $phimId)->with('error', 'Bạn chỉ có thể đánh giá sau khi suất chiếu kết thúc.');
    //     }

    //     $request->validate([
    //         'noi_dung' => 'required|string',
    //         'diem_danh_gia' => 'required|integer|min:1|max:5',
    //     ]);

    //     DanhGia::create([
    //         'phim_id' => $phimId,
    //         'nguoi_dung_id' => $userId,
    //         'noi_dung' => $request->input('noi_dung'),
    //         'diem_danh_gia' => $request->input('diem_danh_gia'),
    //     ]);

    //     return redirect()->route('chitietphim', $phimId)->with('success', 'Đánh giá của bạn đã được gửi!');
    // }

    /**
     * Display the specified resource.
     */
    public function show(DanhGia $danhGia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DanhGia $danhGia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDanhGiaRequest $request, DanhGia $danhGia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DanhGia $danhGia)
    {
        //
    }
}
