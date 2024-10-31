<?php

namespace App\Http\Controllers;

use App\Models\Phim;
use App\Models\DaoDien;
use App\Models\DienVien;
use App\Models\TheLoaiPhim;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePhimRequest;
use App\Http\Requests\UpdatePhimRequest;

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

    public function store(StorePhimRequest $request)
    {
        $phim = Phim::create($request->all());
    
        if ($request->has('dao_dien_ids')) {
            $phim->daoDiens()->attach($request->dao_dien_ids);
        }
    
        if ($request->has('dien_vien_ids')) {
            foreach ($request->dien_vien_ids as $index => $dienVienId) {
                $vaiTro = $request->input('vai_tro_dien_vien')[$index] ?? null;
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
    public function update(UpdatePhimRequest $request, Phim $phim)
    {
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
    public function destroy(Phim $phim)
    {
        $phim->trang_thai = 0;
        $phim->save();
        return redirect()->route('phim.index')->with('success', 'Đạo Diễn đã được xóa thành công.');
    }
}
