<?php

namespace App\Http\Controllers;

use App\Models\Phim;
use App\Models\DaoDien;
use App\Models\DienVien;
use App\Models\TheLoaiPhim;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MaGiamGia;

class PhimController extends Controller
{
    public function index()
    {
        $phims = Phim::with('daoDiens', 'dienViens', 'theLoaiPhims')->orderBy('id', 'desc')->get();
        return view('admin.contents.phims.index', compact('phims'));
    }
    public function create()
    {
        $daoDiens = DaoDien::where('trang_thai', 1)->get();
        $dienViens = DienVien::where('trang_thai', 1)->get();
        $theLoais = TheLoaiPhim::where('trang_thai', 1)->get();
        return view('admin.contents.phims.creater', compact('daoDiens', 'dienViens', 'theLoais'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten_phim' => 'required|string|max:255',
            'mo_ta' => 'nullable|string',
            'thoi_luong' => 'required|integer',
            'ngay_khoi_chieu' => 'required|date',
            'ngay_ket_thuc' => 'nullable|date|after_or_equal:ngay_khoi_chieu',
            'dao_dien_ids' => 'required|array',
            'dao_dien_ids.*' => 'exists:dao_diens,id',
            'dien_vien_ids' => 'required|array',
            'dien_vien_ids.*' => 'exists:dien_viens,id',
            'vai_tro_dien_vien' => 'required|array',
            'vai_tro_dien_vien.*' => 'string',
            'the_loai_phim_ids' => 'required|array',
            'the_loai_phim_ids.*' => 'exists:the_loai_phims,id',

        ]);

        $phim = Phim::create($request->all());

        if ($request->has('dao_dien_ids')) {
            $phim->daoDiens()->attach($request->dao_dien_ids);
        }

        if ($request->has('dien_vien_ids')) {
            foreach ($request->dien_vien_ids as $index => $dienVienId) {
                $vaiTro = $request->input('vai_tro_dien_vien')[$index] ?? null; // Lấy vai trò tương ứng
                $phim->dienViens()->attach($dienVienId, ['vai_tro_dien_vien' => $vaiTro]);
            }
        }
        if ($request->has('the_loai_phim_ids')) {
            $phim->theLoaiPhims()->attach($request->the_loai_phim_ids);
        }


        return redirect()->route('phim.index')->with('success', 'Phim đã được thêm thành công.');
    }
    public function edit(Phim $phim)
    {
        $daoDiens = DaoDien::where('trang_thai', 1)->get();
        $dienViens = DienVien::where('trang_thai', 1)->get();
        $theLoaiPhims = TheLoaiPhim::where('trang_thai', 1)->get();
        return view('admin.contents.phims.edit', compact('phim', 'daoDiens', 'dienViens', 'theLoaiPhims'));
    }
    public function update(Request $request, Phim $phim)
    {
        $request->validate([
            'ten_phim' => 'required|string|max:255',
            'mo_ta' => 'nullable|string',
            'thoi_luong' => 'required|integer',
            'ngay_khoi_chieu' => 'required|date',
            'ngay_ket_thuc' => 'nullable|date|after_or_equal:ngay_khoi_chieu',
            'dao_dien_ids' => 'required|array',
            'dao_dien_ids.*' => 'exists:dao_diens,id',
            'dien_vien_ids' => 'required|array',
            'dien_vien_ids.*' => 'exists:dien_viens,id',
            'vai_tro_dien_vien' => 'required|array',
            'vai_tro_dien_vien.*' => 'string',
            'the_loai_phim_ids' => 'required|array',
            'the_loai_phim_ids.*' => 'exists:the_loai_phims,id',
        ]);

        $phim->update($request->all());

        $phim->daoDiens()->sync($request->dao_dien_ids);

        $phim->dienViens()->detach();
        foreach ($request->dien_vien_ids as $index => $dienVienId) {
            $vaiTro = $request->input('vai_tro_dien_vien')[$index] ?? null;
            $phim->dienViens()->attach($dienVienId, ['vai_tro_dien_vien' => $vaiTro]);
        }

        $phim->theLoaiPhims()->sync($request->the_loai_phim_ids);

        return redirect()->route('phim.index')->with('success', 'Phim đã được cập nhật thành công.');
    }

    // public function maGiamGia()
    // {
    //     return $this->hasMany(MaGiamGia::class);
    // }

    public function destroy(Phim $phim)
    {
        $phim->trang_thai = 0;
        $phim->save();
        return redirect()->route('phim.index')->with('success', 'Đạo Diễn đã được xóa thành công.');
    }
}