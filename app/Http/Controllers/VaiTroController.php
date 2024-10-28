<?php

namespace App\Http\Controllers;

use App\Models\VaiTro;
use App\Http\Requests\StoreVaiTroRequest;
use App\Http\Requests\UpdateVaiTroRequest;

class VaiTroController extends Controller
{
    const PATH_VIEW = 'admin.role.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = VaiTro::query()->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('role'));
    }
    public function listRoleSoft()
    {
        $role = VaiTro::query()->onlyTrashed()->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('role'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVaiTroRequest $request)
    {
        VaiTro::query()->create($request->all());
        return back()->with('success', 'Thêm vai trò thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(VaiTro $vaiTro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $roleId = VaiTro::query()->find($id);
        return view(self::PATH_VIEW . __FUNCTION__, compact('roleId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreVaiTroRequest $request, $id)
    {
        $vaitro = VaiTro::query()->find($id);
        $vaitro->ten_vai_tro = $request->ten_vai_tro;
        $vaitro->save();
        return back()->with('success', 'Cập nhật thành công');
    }
    public function restore($id)
    {
        $vaitro = VaiTro::query()->onlyTrashed()->find($id);
        $vaitro->deleted_at = null;
        $vaitro->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        VaiTro::query()->find($id)->delete();
        return back();
    }
    public function destroy(VaiTro $vaiTro)
    {
        //
    }
}
