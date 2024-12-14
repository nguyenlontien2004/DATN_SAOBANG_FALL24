<?php

namespace App\Http\Controllers;

use App\Models\DanhMucBaiVietTinTuc;
use App\Http\Requests\StoreDanhMucBaiVietTinTucRequest;
use App\Http\Requests\UpdateDanhMucBaiVietTinTucRequest;

class DanhMucBaiVietTinTucController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $danhmuc = DanhMucBaiVietTinTuc::withTrashed()->get();
        return view('nhanVien.danhmucbaiviet.list', compact('danhmuc'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('nhanVien.danhmucbaiviet.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDanhMucBaiVietTinTucRequest $request)
    {
        $danhmuc = $request->all();
        DanhMucBaiVietTinTuc::create($danhmuc);
        return redirect()->route('danh-muc-bai-viet-tin-tuc.index')
            ->with('success', 'Thêm danh mục thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(DanhMucBaiVietTinTuc $danhMucBaiVietTinTuc)
    {
        return view('nhanVien.danhmucbaiviet.show', compact('danhMucBaiVietTinTuc'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DanhMucBaiVietTinTuc $danhMucBaiVietTinTuc)
    {
        return view('nhanVien.danhmucbaiviet.edit', compact('danhMucBaiVietTinTuc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDanhMucBaiVietTinTucRequest $request, DanhMucBaiVietTinTuc $danhMucBaiVietTinTuc)
    {
        $danhMucBaiVietTinTuc->update($request->all());

        return redirect()->route('danh-muc-bai-viet-tin-tuc.index')
            ->with('success', 'Cập nhật danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DanhMucBaiVietTinTuc $danhMucBaiVietTinTuc)
    {
        $danhMucBaiVietTinTuc->delete();
        return redirect()->route('danh-muc-bai-viet-tin-tuc.index')
            ->with('success', 'Ẩn danh mục thành công');
    }

    public function restore($id)
    {
        $danhMucBaiVietTinTuc = DanhMucBaiVietTinTuc::onlyTrashed()->findOrFail($id);
        $danhMucBaiVietTinTuc->restore();
        return redirect()->route('danh-muc-bai-viet-tin-tuc.index')
            ->with('success', 'Khôi phục danh mục thành công');
    }

    public function forceDelete($id)
    {
        $danhMucBaiVietTinTuc = DanhMucBaiVietTinTuc::onlyTrashed()->findOrFail($id);
        $danhMucBaiVietTinTuc->forceDelete();
        return redirect()->route('danh-muc-bai-viet-tin-tuc.index')
            ->with('success', 'Xóa danh mục thành công');
    }
}