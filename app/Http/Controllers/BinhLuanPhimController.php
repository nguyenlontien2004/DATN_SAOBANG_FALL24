<?php

namespace App\Http\Controllers;

use App\Models\BinhLuanPhim;
use App\Http\Requests\StoreBinhLuanPhimRequest;
use App\Http\Requests\UpdateBinhLuanPhimRequest;

class BinhLuanPhimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreBinhLuanPhimRequest $request)
    {
        if($request->isMethod('POST')){
            $params = $request->except('_token');
            // dd($params);
            BinhLuanPhim::query()->create($params);
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(BinhLuanPhim $binhLuanPhim)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BinhLuanPhim $binhLuanPhim)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBinhLuanPhimRequest $request, BinhLuanPhim $binhLuanPhim)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BinhLuanPhim $binhLuanPhim)
    {
        //
    }
}
