<?php

namespace App\Http\Controllers;

use App\Models\VaiTroVaNguoiDung;
use App\Models\VaiTro;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\StoreVaiTroVaNguoiDungRequest;
use App\Http\Requests\UpdateVaiTroVaNguoiDungRequest;

class VaiTroVaNguoiDungController extends Controller
{
    const PATH_VIEW = 'admin.userRole.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roleAndUser = VaiTroVaNguoiDung::query()
            ->select(['nguoi_dung_id', 'vai_tro_id'])
            ->with([
                'user:id,ho_ten,email,anh_dai_dien,so_dien_thoai',
                'role:id,ten_vai_tro'
            ])->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact(['roleAndUser']));
    }

    public function edit($id)
    {
        $roleAndUser = VaiTroVaNguoiDung::query()
            ->select(['nguoi_dung_id', 'vai_tro_id'])
            ->with([
                'user:id,ho_ten,email',
            ])->where('nguoi_dung_id', $id)->first();
        $role = VaiTro::query()->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact(['role', 'roleAndUser']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        DB::table('vai_tro_va_nguoi_dungs')
            ->where('nguoi_dung_id', $id) 
            ->update(['vai_tro_id' => $request->vai_tro_id]);

        return back()->with('success', 'Cập nhật thành công');
    }
}
