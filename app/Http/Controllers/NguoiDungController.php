<?php

namespace App\Http\Controllers;

use App\Models\NguoiDung;
use App\Http\Requests\StoreNguoiDungRequest;
use App\Http\Requests\UpdateNguoiDungRequest;
use App\Models\VaiTro;
use Illuminate\Support\Facades\Storage;

class NguoiDungController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nguoidung = NguoiDung::withTrashed()
            ->with('vaiTros')->paginate(10);
        return view('admin.contents.nguoidung.list', compact('nguoidung'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vaitro = VaiTro::all();

        return view('admin.contents.nguoidung.add', compact('vaitro'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNguoiDungRequest $request)
    {
        $nguoidung = $request->all();

        if ($request->hasFile('hinh_anh')) {
            $hinhanh = $request->file('hinh_anh')->store('uploads/nguoidung', 'public');
        } else {
            $hinhanh = null;
        }

        $nguoidung['hinh_anh'] = $hinhanh;

        NguoiDung::create($nguoidung);

        return redirect()->route('nguoi-dung.index')
            ->with('success', 'Thêm người dùng thành công');
    }



    /**
     * Display the specified resource.
     */
    public function show(NguoiDung $nguoiDung)
    {
        $vaitro = VaiTro::all();

        return  view('admin.contents.nguoidung.show', compact('nguoiDung', 'vaitro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NguoiDung $nguoiDung)
    {
        $vaitro = VaiTro::all();
        
        return  view('admin.contents.nguoidung.edit', compact('nguoiDung', 'vaitro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNguoiDungRequest $request, NguoiDung $nguoiDung)
    {
        $nguoidung = $request->all();

        if ($request->hasFile('hinh_anh')) {
            if ($nguoiDung->hinhanh) {
                Storage::disk('public')->delete($nguoiDung);
            }

            $hinhanh = $request->file('hinh_anh')->store('uploads/nguoidung', 'public');
        } else {
            $hinhanh = $nguoiDung->hinhanh;
        }

        $nguoidung['hinh_anh'] = $hinhanh;

        $nguoiDung->update($nguoidung);

        return redirect()->route('nguoi-dung.index')
            ->with('success', 'Sửa người dùng thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NguoiDung $nguoiDung)
    {
        $nguoiDung->delete();

        return redirect()->route('nguoi-dung.index')
            ->with('success', 'Ẩn người dùng thành công');
    }

    public function restore($id)
    {
        $nguoiDung = NguoiDung::onlyTrashed()->findOrFail($id);

        $nguoiDung->restore();

        return redirect()->route('nguoi-dung.index')
            ->with('success', 'Khôi phục người dùng thành công');
    }

    public function forceDelete($id)
    {
        $nguoiDung = NguoiDung::onlyTrashed()->findOrFail($id);

        if ($nguoiDung->hinh_anh) {
            Storage::disk('public')->delete($nguoiDung->hinh_anh);
        }

        $nguoiDung->forceDelete();

        return redirect()->route('nguoi-dung.index')
            ->with('success', 'Xóa người dùng thành công');
    }
}