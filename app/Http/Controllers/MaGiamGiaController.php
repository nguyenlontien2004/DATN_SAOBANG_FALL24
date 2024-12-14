<?php

namespace App\Http\Controllers;

use App\Models\MaGiamGia;
use App\Http\Requests\StoreMaGiamGiaRequest;
use App\Http\Requests\UpdateMaGiamGiaRequest;
use App\Models\Phim;

class MaGiamGiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $magiamgia = MaGiamGia::withTrashed()->get();
        return view('nhanVien.magiamgia.list', compact('magiamgia'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $phim = Phim::select('ten_phim', 'id')
            ->orderBy('created_at', 'desc')
            ->get();
        // ->paginate(1);
        return view('nhanVien.magiamgia.add', compact('phim'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMaGiamGiaRequest $request)
    {
        $magiamgia = $request->all();

        MaGiamGia::create($magiamgia);

        // $maGiamGia->phim()->attach($request->phim);
        
        return redirect()->route('ma_giam_gia.index')
            ->with('success', 'Thêm mã giảm giá thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $maGiamGia = MaGiamGia::findOrFail($id);

        return view('nhanVien.magiamgia.show', compact('maGiamGia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Tìm mã giảm giá theo ID
        $maGiamGia = MaGiamGia::findOrFail($id);

        // Truyền mã giảm giá tìm được sang view
        return view('nhanVien.magiamgia.edit', compact('maGiamGia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMaGiamGiaRequest $request, $id)
    {
        $maGiamGia = MaGiamGia::findOrFail($id);

        $maGiamGia->update($request->validated());

        return redirect()->route('ma_giam_gia.index')
            ->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $maGiamGia = MaGiamGia::findOrFail($id);

        $maGiamGia->delete();

        return redirect()->route('ma_giam_gia.index')
            ->with('success', 'Mã giảm giá đã được ẩn thành công.');
    }

    public function restore($id)
    {
        $maGiamGia = MaGiamGia::onlyTrashed()->findOrFail($id); // Tìm bản ghi đã bị xóa mềm
        $maGiamGia->restore();
        return redirect()->route('ma_giam_gia.index')
            ->with('success', 'Mã giảm giá đã được khôi phục thành công.');
    }

    public function forceDelete($id)
    {
        $maGiamGia = MaGiamGia::onlyTrashed()->findOrFail($id); // Tìm bản ghi đã bị xóa mềm
        $maGiamGia->forceDelete();

        return redirect()->route('ma_giam_gia.index')
            ->with('success', 'Mã giảm giá đã được xóa vĩnh viễn.');
    }
}