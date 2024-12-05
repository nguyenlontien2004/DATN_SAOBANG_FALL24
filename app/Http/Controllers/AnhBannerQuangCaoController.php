<?php

namespace App\Http\Controllers;

use App\Models\AnhBannerQuangCao;
use App\Http\Requests\StoreAnhBannerQuangCaoRequest;
use App\Http\Requests\UpdateAnhBannerQuangCaoRequest;
use App\Models\BannerQuangCao;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AnhBannerQuangCaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $anhbanner = AnhBannerQuangCao::withTrashed()->with('banner')->latest('id')->paginate(6);
        return view('admin.contents.anhbanner.list', compact('anhbanner'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $banner = BannerQuangCao::all();

        return view('admin.contents.anhbanner.add', compact('banner'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnhBannerQuangCaoRequest $request)
    {
        $anhbanner = $request->all();

        if ($request->hasFile('hinh_anh')) {
            $hinhanh = $request->file('hinh_anh')->store('uploads/anhbanner', 'public');
        } else {
            $hinhanh = null;
        }

        $anhbanner['hinh_anh'] = $hinhanh;

        AnhBannerQuangCao::create($anhbanner);

        return redirect()->route('anh-banner-quang-cao.index')
            ->with('success', 'Thêm ảnh banner thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(AnhBannerQuangCao $anhBannerQuangCao)
    {
        $vitri = BannerQuangCao::all();
        return view('admin.contents.anhbanner.show', compact('anhBannerQuangCao', 'vitri'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AnhBannerQuangCao $anhBannerQuangCao)
    {
        $vitri = BannerQuangCao::all();
        return view('admin.contents.anhbanner.edit', compact('anhBannerQuangCao', 'vitri'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AnhBannerQuangCao $anhBannerQuangCao)
    {
        $anhbanner = $request->all();

        if ($request->hasFile('hinh_anh')) {
            if ($anhBannerQuangCao->hinh_anh) {
                Storage::disk('public')->delete($anhBannerQuangCao->hinh_anh);
            }

            $hinhanh = $request->file('hinh_anh')->store('uploads/baiviet', 'public');
        } else {
            $hinhanh = $anhBannerQuangCao->hinh_anh;
        }

        $anhbanner['hinh_anh'] = $hinhanh;

        $anhBannerQuangCao->update($anhbanner);

        return redirect()->route('anh-banner-quang-cao.index')
            ->with('success', 'Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnhBannerQuangCao $anhBannerQuangCao)
    {
        $anhBannerQuangCao->delete();
        return redirect()->route('anh-banner-quang-cao.index')
            ->with('success', 'Ẩn danh mục thành công');
    }

    public function restore($id)
    {
        $anhBannerQuangCao = AnhBannerQuangCao::onlyTrashed()->findOrFail($id);

        $anhBannerQuangCao->restore();

        return redirect()->route('anh-banner-quang-cao.index')
            ->with('success', 'Khôi phục danh mục thành công');
    }

    public function forceDelete($id)
    {
        $anhBannerQuangCao = AnhBannerQuangCao::onlyTrashed()->findOrFail($id);

        $anhBannerQuangCao->forceDelete();

        return redirect()->route('anh-banner-quang-cao.index')
            ->with('success', 'Xóa danh mục thành công');
    }
}
