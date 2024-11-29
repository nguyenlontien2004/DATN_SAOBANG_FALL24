<?php

namespace App\Http\Controllers;

use App\Models\NguoiDung;
use App\Http\Requests\StoreNguoiDungRequest;
use App\Http\Requests\UpdateNguoiDungRequest;
use App\Models\VaiTro;
use Illuminate\Support\Facades\DB;
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
        $vaitro = VaiTro::pluck('ten_vai_tro', 'id')->all();
        // dd($vaitro);
        return view('admin.contents.nguoidung.add', compact('vaitro'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNguoiDungRequest $request)
    {
        // try {
        //     DB::transaction(function () use ($request) {
        // dd($request->all());
        $nguoidung = $request->only(['ho_ten', 'email', 'so_dien_thoai', 'gioi_tinh', 'dia_chi', 'nam_sinh']);

        if ($request->hasFile('hinh_anh')) {
            $hinhanh = $request->file('hinh_anh')->store('uploads/nguoidung', 'public');
        } else {
            $hinhanh = null;
        }
        $nguoidung['hinh_anh'] = $hinhanh;
        $nguoidung['password'] = bcrypt($request->input('password'));
        // dd($nguoidung);

        $nguoiDung = NguoiDung::create($nguoidung);

        // dd($nguoiDung);

        $nguoiDung->vaiTros()->attach($request->vai_tros);
        // dd("Gán vai trò thành công");
        // });

        return redirect()->route('nguoi-dung.index')->with('success', 'Thêm người dùng thành công');
        // } catch (\Throwable $th) {
        //     // // Xem lỗi chi tiết
        //     // dd($th->getMessage());
        //     return back()->with('error', $th->getMessage());
        // }
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
        $nguoiDung->load('vaiTros');
        $nguoidungvt = $nguoiDung->vaiTros->pluck('id')->all();
        $vaitro = VaiTro::pluck('ten_vai_tro', 'id');


        return  view('admin.contents.nguoidung.edit', compact('nguoiDung', 'vaitro', 'nguoidungvt'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNguoiDungRequest $request, NguoiDung $nguoiDung)
    {
        // dd($request->all());
        // try {
        //     DB::transaction(function () use ($request, $nguoiDung) {

        $nguoidung = $request->only(['ho_ten', 'email', 'so_dien_thoai', 'gioi_tinh', 'dia_chi', 'nam_sinh']);

        if ($request->hasFile('hinh_anh')) {
            $hinhanh = $request->file('hinh_anh')->store('uploads/nguoidung', 'public');
        } else {
            $hinhanh = $nguoiDung->hinh_anh;
        }

        $nguoidung['hinh_anh'] = $hinhanh;

        $nguoiDung->update($nguoidung);

        $nguoiDung->vaiTros()->sync($request->vai_tros);
        // });

        return redirect()->route('nguoi-dung.index')
            ->with('success', 'Sửa người dùng thành công');
        // } catch (\Throwable $th) {
        //     return back()->with('error', $th->getMessage());
        // }
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
