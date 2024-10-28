<?php

namespace App\Http\Controllers;

use App\Models\BaiVietTinTuc;
use App\Http\Requests\StoreBaiVietTinTucRequest;
use App\Http\Requests\UpdateBaiVietTinTucRequest;
use App\Models\DanhMucBaiVietTinTuc;
use Illuminate\Support\Facades\Storage;


class BaiVietTinTucController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $baiviet = BaiVietTinTuc::withTrashed()
            ->with('danhMuc')->latest('id')->paginate(6);
        return view('admin.contents.baiviettintuc.list', compact('baiviet'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $danhmuc = DanhMucBaiVietTinTuc::all();

        return view('admin.contents.baiviettintuc.add', compact('danhmuc'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBaiVietTinTucRequest $request)
    {
        $baiviet = $request->all();

        if ($request->hasFile('hinh_anh')) {
            $hinhanh = $request->file('hinh_anh')->store('uploads/baiviet', 'public');
        } else {
            $hinhanh = null;
        }

        $baiviet['hinh_anh'] = $hinhanh;

        BaiVietTinTuc::create($baiviet);

        return redirect()->route('bai-viet-tin-tuc.index')
            ->with('success', 'Thêm bài viết thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(BaiVietTinTuc $baiVietTinTuc)
    {
        $danhmuc = DanhMucBaiVietTinTuc::all();
        return view('admin.contents.baiviettintuc.show', compact('baiVietTinTuc', 'danhmuc'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BaiVietTinTuc $baiVietTinTuc)
    {
        $danhmuc = DanhMucBaiVietTinTuc::all();
        return view('admin.contents.baiviettintuc.edit', compact('baiVietTinTuc', 'danhmuc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBaiVietTinTucRequest $request, BaiVietTinTuc $baiVietTinTuc)
    {
        $baiviet = $request->all();

        if ($request->hasFile('hinh_anh')) {
            if ($baiVietTinTuc->hinhanh) {
                Storage::disk('public')->delete($baiVietTinTuc->hinhanh);
            }

            $hinhanh = $request->file('hinh_anh')->store('uploads/baiviet', 'public');
        } else {
            $hinhanh = $baiVietTinTuc->hinhanh;
        }

        $baiviet['hinh_anh'] = $hinhanh;

        $baiVietTinTuc->update($baiviet);

        return redirect()->route('bai-viet-tin-tuc.index')
            ->with('success', 'Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BaiVietTinTuc $baiVietTinTuc)
    {
        $baiVietTinTuc->delete();
        return redirect()->route('bai-viet-tin-tuc.index')
            ->with('success', 'Ẩn bài viết thành công');
    }

    public function restore($id)
    {
        $baiVietTinTuc = BaiVietTinTuc::onlyTrashed()->findOrFail($id);
        $baiVietTinTuc->restore();
        return redirect()->route('bai-viet-tin-tuc.index')
            ->with('success', 'Khôi phục bài viết thành công');
    }

    public function forceDelete($id)
    {
        $baiVietTinTuc = BaiVietTinTuc::onlyTrashed()->findOrFail($id);
        if ($baiVietTinTuc->hinh_anh) {
            Storage::disk('public')->delete($baiVietTinTuc->hinh_anh);
        }

        $baiVietTinTuc->forceDelete();

        return redirect()->route('bai-viet-tin-tuc.index')
            ->with('success', 'Xóa bài viết thành công');
    }
}
