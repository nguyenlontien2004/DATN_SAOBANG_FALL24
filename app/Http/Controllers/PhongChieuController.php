<?php

namespace App\Http\Controllers;

use App\Models\PhongChieu;
use App\Http\Requests\StorePhongChieuRequest;
use App\Http\Requests\UpdatePhongChieuRequest;
use App\Models\Rap;

class PhongChieuController extends Controller
{
    const PATH_VIEW = 'admin.phong_chieu.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = PhongChieu::query()
            ->select(['id', 'rap_id', 'ten_phong_chieu', 'trang_thai', 'deleted_at'])
            ->with('rap:id,ten_rap')->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact(['list']));
    }
    public function listSoftDelete()
    {
        $list = PhongChieu::query()
            ->select(['id', 'rap_id', 'ten_phong_chieu', 'trang_thai', 'deleted_at'])
            ->with('rap:id,ten_rap')
            ->onlyTrashed()
            ->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact(['list']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list_rap = Rap::query()->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('list_rap'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePhongChieuRequest $request)
    {
        $data = $request->all();
        $data['gio_chieu'] = date('Y-m-d H:i:s');
        PhongChieu::query()->create($data);
        return back()->with('success', 'Đã thêm một phòng chiếu vào hệ thống rạp');
    }

    /**
     * Display the specified resource.
     */
    public function quanLyGhecuaphong($id)
    {
        $phongChieu = PhongChieu::query()->find($id);
        return view(self::PATH_VIEW . 'quanlyGhe',compact(['phongChieu']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PhongChieu $phongChieu)
    {
        $data = $phongChieu->all()[0];
        $list_rap = Rap::query()->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact(['data', 'list_rap']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePhongChieuRequest $request, PhongChieu $phongChieu)
    {
        $phongChieu = $phongChieu->all()[0];
        $data = $request->all();
        $phongChieu->update($data);
        return back()->with('success', 'Đã thêm một phòng chiếu vào hệ thống rạp');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        PhongChieu::query()->find($id)->delete();
        return back();
    }
    public function destroy(PhongChieu $phongChieu)
    {
        //
    }
}
