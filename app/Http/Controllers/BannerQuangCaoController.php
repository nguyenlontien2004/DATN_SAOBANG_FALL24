<?php

namespace App\Http\Controllers;

use App\Models\BannerQuangCao;
use App\Http\Requests\StoreBannerQuangCaoRequest;
use App\Http\Requests\UpdateBannerQuangCaoRequest;

class BannerQuangCaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banner = BannerQuangCao::withTrashed()->get();
        return view('nhanVien.bannerquangcao.list', compact('banner'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('nhanVien.bannerquangcao.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBannerQuangCaoRequest $request)
    {
        $danhmuc = $request->all();
        BannerQuangCao::create($danhmuc);
        return redirect()->route('banner-quang-cao.index')
            ->with('success', 'Thêm danh mục thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(BannerQuangCao $bannerQuangCao)
    {
        return view('nhanVien.bannerquangcao.show', compact('bannerQuangCao'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BannerQuangCao $bannerQuangCao)
    {
        return view('nhanVien.bannerquangcao.edit', compact('bannerQuangCao'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBannerQuangCaoRequest $request, BannerQuangCao $bannerQuangCao)
    {

        $bannerQuangCao->update($request->all());

        return redirect()->route('banner-quang-cao.index')
            ->with('success', 'Cập nhật danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BannerQuangCao $bannerQuangCao)
    {
        $bannerQuangCao->delete();
        return redirect()->route('banner-quang-cao.index')
            ->with('success', 'Ẩn danh mục thành công');
    }

    public function restore($id)
    {
        $bannerQuangCao = BannerQuangCao::onlyTrashed()->findOrFail($id);

        $bannerQuangCao->restore();

        return redirect()->route('banner-quang-cao.index')
            ->with('success', 'Khôi phục danh mục thành công');
    }

    public function forceDelete($id)
    {
        $bannerQuangCao = BannerQuangCao::onlyTrashed()->findOrFail($id);

        $bannerQuangCao->forceDelete();

        return redirect()->route('banner-quang-cao.index')
            ->with('success', 'Xóa danh mục thành công');
    }
}
