<?php

namespace App\Http\Controllers;

use App\Models\NguoiDung;
use App\Http\Requests\StoreNguoiDungRequest;
use App\Http\Requests\UpdateNguoiDungRequest;
use App\Models\VaiTro;

class NguoiDungController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nguoidung = NguoiDung::withTrashed()
            ->with('vaitro')->paginate(10);
        return view('admin.contents.baiviettintuc.list', compact('nguoidung'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(NguoiDung $nguoiDung)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NguoiDung $nguoiDung)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNguoiDungRequest $request, NguoiDung $nguoiDung)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NguoiDung $nguoiDung)
    {
        //
    }
}
