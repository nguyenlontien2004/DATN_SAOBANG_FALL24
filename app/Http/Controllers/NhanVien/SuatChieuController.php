<?php

namespace App\Http\Controllers\NhanVien;

use App\Models\Phim;
use App\Models\SuatChieu;
use App\Models\PhongChieu;
use App\Models\NguoiDung;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSuatChieuRequest;
use App\Http\Requests\UpdateSuatChieuRequest;
use App\Http\Requests\NhanvienSuatchieuRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Jobs\MailHuyVe;
use App\Models\Ve;

class SuatChieuController extends Controller
{
    public function index(Request $request)
    {
        $date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $currentTime = Carbon::now('Asia/Ho_Chi_Minh')->format('H:i');
        $query = SuatChieu::select(
            'suat_chieus.id',
            'suat_chieus.phim_id',
            'suat_chieus.phong_chieu_id',
            'ngay',
            'gia',
            DB::raw("TIME_FORMAT(suat_chieus.gio_bat_dau,'%H:%i') as gio_bat_dau"),
            DB::raw("TIME_FORMAT(suat_chieus.gio_ket_thuc,'%H:%i') as gio_ket_thuc")
        )->with(['phongChieu', 'phim']);
        if ($request->filled('phim_id')) {
            $query->where('phim_id', $request->phim_id);
        }
        if ($request->filled('phong_chieu_id')) {
            $query->where('phong_chieu_id', $request->phong_chieu_id);
        }

        $suatChieus = $query->orderBy('ngay', 'desc')->get();
         
        //dd($suatChieus->toArray());

        $phims = Phim::where('trang_thai', 1)->get();
        $phongChieus = PhongChieu::where('trang_thai', 1)->get();
        return view('nhanvien.suatchieu.index', compact('suatChieus', 'phims', 'phongChieus', 'date', 'currentTime'));
    }

    public function huysuatchieu($id)
    {
        try {
            $date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
            $currentTime = Carbon::now('Asia/Ho_Chi_Minh')->format('H:i');
            $check = true;
            $suatchieu = SuatChieu::query()->select(
                'suat_chieus.id',
                'suat_chieus.phim_id',
                'suat_chieus.phong_chieu_id',
                'ngay',
                'gia',
                DB::raw("TIME_FORMAT(suat_chieus.gio_bat_dau,'%H:%i') as gio_bat_dau"),
                DB::raw("TIME_FORMAT(suat_chieus.gio_ket_thuc,'%H:%i') as gio_ket_thuc")
            )->with([
                        'ves.suatChieu' => function ($query) {
                            $query->select(
                                'suat_chieus.id',
                                'suat_chieus.phim_id',
                                'suat_chieus.phong_chieu_id',
                                DB::raw("TIME_FORMAT(suat_chieus.gio_bat_dau,'%H:%i') as gio_bat_dau"),
                                DB::raw("TIME_FORMAT(suat_chieus.gio_ket_thuc,'%H:%i') as gio_ket_thuc")
                            )->with('phim');
                        },
                        'ves.user'
                    ])->find($id);

            $gioBatDau = \Carbon\Carbon::createFromFormat('H:i', $suatchieu->gio_bat_dau);
            //dd($gioBatDau);
            $gioBatDauTru15Phut = $gioBatDau->subMinutes(15)->format('H:i');

            if ($suatchieu->ngay < $date) {
                return back()->with('khongthehuy', 'Không thể huỷ vì suất chiếu đã hết hạn!');
            } elseif ($suatchieu->ngay == $date) {
                if ($gioBatDauTru15Phut > $currentTime) {
                    $check = true;
                } else {
                    $check = false;
                }
            } else {
                $check = true;
            }
            if ($check == false) {
                return back()->with('khongthehuy', 'Không thể huỷ vì suất chiếu đã hết hạn!');
            }
            if (count($suatchieu->ves) <= 0) {
                return back()->with('khongthehuy', 'Suất chiếu không có người mua hoặc bạn đã huỷ từ trước');
            }
            DB::beginTransaction();
            foreach ($suatchieu->ves as $key => $value) {
                MailHuyVe::dispatch($value->user->email, $value);
                $this->congxukhihuyve($value);
                $value->delete();
                //dd($value->toArray());
            }
            DB::commit();
            return back()->with('success', 'Huỷ thành công');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('khongthehuy', 'Không thể huỷ suất chiếu này');
        }
    }
    public function congxukhihuyve($ve)
    {
        $user = NguoiDung::query()->find($ve->nguoi_dung_id);
        $quydoixu = $ve->tong_tien / 1000;
        $user->gold = $user->gold + $quydoixu;
        $user->save();
    }

    public function show($id)
    {
        // Lấy thông tin về suất chiếu và phim liên quan
        // $phongChieus = PhongChieu::where('trang_thai', 1)->get();
        // $suatChieu = SuatChieu::with('phim') // Quan hệ với bảng Phim
        //                        ->where('id', $id)
        //                        ->first();

        // // Nếu không tìm thấy suất chiếu
        // if (!$suatChieu) {
        //     return redirect()->back()->with('error', 'Không tìm thấy suất chiếu.');
        // }

        // // Lấy phim thông qua quan hệ đã định nghĩa
        // $phim = $suatChieu->phim;

        // return view('admin.contents.suatChieus.show', compact('phongChieus', 'suatChieu', 'phim'));
        // Lấy thông tin về suất chiếu và phim liên quan
        $suatChieu = SuatChieu::with('phim', 'phongChieu') // Quan hệ với bảng Phim và PhongChieu
            ->where('id', $id)
            ->first();

        // Nếu không tìm thấy suất chiếu
        if (!$suatChieu) {
            return redirect()->back()->with('error', 'Không tìm thấy suất chiếu.');
        }

        // Lấy phim thông qua quan hệ đã định nghĩa
        $phim = $suatChieu->phim;
        $phongChieu = $suatChieu->phongChieu; // Phòng chiếu của suất chiếu hiện tại

        return view('nhanvien.suatchieu.show', compact('suatChieu', 'phim', 'phongChieu'));
    }
    public function create()
    {
        $phongChieus = PhongChieu::query()->with(
            ['rap']
        )
        ->where('trang_thai', 1)->get();
        $phims = Phim::where('trang_thai', 1)->get();
        //dd($phongChieus->toArray());
        return view('nhanvien.suatchieu.creater', compact('phongChieus', 'phims'));
    }
    public function store(StoreSuatChieuRequest $request)
    {

        $phim = Phim::findOrFail($request->phim_id);
        $thoiLuong = $phim->thoi_luong;
        $ngay = $request->ngay;
        $timestamp_bat_dau = Carbon::createFromFormat('Y-m-d H:i', $ngay . ' ' . $request->gio_bat_dau);
        // $timestamp_ket_thuc = Carbon::createFromFormat('Y-m-d H:i', $ngay . ' ' . $request->gio_ket_thuc);
        // $timestamp_ket_thuc = $timestamp_bat_dau->copy()->addMinutes($thoiLuong);
        $timestamp_ket_thuc = $timestamp_bat_dau->copy()->addMinutes($thoiLuong);
        SuatChieu::create([
            'phong_chieu_id' => $request->phong_chieu_id,
            'phim_id' => $request->phim_id,
            'gio_bat_dau' => $timestamp_bat_dau,
            'gio_ket_thuc' => $timestamp_ket_thuc,
            'gia' => $request->gia,
            'ngay' => $ngay,
        ]);
        return redirect()->route('nhanvienSuatchieu.index')->with('success', 'Thêm suất chiếu thành công!');
    }
    public function edit(SuatChieu $nhanvienSuatchieu)
    {
        $suatChieu = $nhanvienSuatchieu;
        $veDaBan = Ve::where('suat_chieu_id', $suatChieu->id)
        ->where('ngay_ve_mo', $suatChieu->ngay)->exists();
       // dd($veDaBan->toArray());
        if ($veDaBan) {
            return redirect()->route('nhanvienSuatchieu.index')->with('error', 'Không thể cập nhật suất chiếu vì đã có vé được bán cho suất chiếu này.');
        }
        $phongChieus = PhongChieu::query()->with(
            ['rap']
        )->where('trang_thai', 1)->get();
        $phims = Phim::where('trang_thai', 1)->get();
       
        return view('nhanvien.suatchieu.edit', compact('suatChieu', 'phongChieus', 'phims'));
    }
    public function update(NhanvienSuatchieuRequest $request, SuatChieu $nhanvienSuatchieu)
    {
        $suatChieu = $nhanvienSuatchieu;
        $phim = Phim::findOrFail($request->phim_id);
        $thoiLuong = $phim->thoi_luong;
        $ngay = $request->ngay;
        $timestamp_bat_dau = Carbon::createFromFormat('Y-m-d H:i', $ngay . ' ' . $request->gio_bat_dau);
        // $timestamp_ket_thuc = Carbon::createFromFormat('Y-m-d H:i', $ngay . ' ' . $request->gio_ket_thuc);
        $timestamp_ket_thuc = $timestamp_bat_dau->copy()->addMinutes($thoiLuong);
        //dd($timestamp_bat_dau,$timestamp_ket_thuc);
        $suatChieu->update([
            'phong_chieu_id' => $request->phong_chieu_id,
            'phim_id' => $request->phim_id,
            'gio_bat_dau' => $timestamp_bat_dau,
            'gio_ket_thuc' => $timestamp_ket_thuc,
            'gia' => $request->gia,
            'ngay' => $ngay,
        ]);
        return redirect()->route('nhanvienSuatchieu.index')->with('success', 'Cập nhật suất chiếu thành công!');
    }
    public function listSoftDelete()
    {
        $suatChieus = SuatChieu::onlyTrashed()->with(['phim', 'phongChieu.rap'])->paginate(5);

        return view('nhanvien.suatchieu.listSoftDelete', compact('suatChieus'));
    }
    public function softDelete($id)
    {
        $suatChieu = SuatChieu::query()->with([
            'ves'
        ])->findOrFail($id);

        $suatChieu->delete();
        return redirect()->route('nhanvienSuatchieu.index')->with('success', 'Xóa mềm thành công!');
    }
    public function restore($id)
    {
        $suatChieu = SuatChieu::onlyTrashed()->findOrFail($id);
        $suatChieu->restore();
        return redirect()->route('nhanvien.suatChieu.listSoftDelete')->with('success', 'Khôi phục thành công!');
    }
}
