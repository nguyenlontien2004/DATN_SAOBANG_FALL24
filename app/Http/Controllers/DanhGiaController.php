<?php

namespace App\Http\Controllers;

use App\Models\DanhGia;
use App\Http\Requests\StoreDanhGiaRequest;
use App\Http\Requests\UpdateDanhGiaRequest;

class DanhGiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $danhSachDanhGia = DanhGia::query()->get();
        // return view('user.chitietphim', compact('danhSachDanhGia'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDanhGiaRequest $request)
    {
        if($request->isMethod('POST')){
            $params = $request->except('_token');
            // dd($params);
            DanhGia::query()->create($params);
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(DanhGia $danhGia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DanhGia $danhGia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDanhGiaRequest $request, DanhGia $danhGia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DanhGia $danhGia)
    {
        //
    }
}
