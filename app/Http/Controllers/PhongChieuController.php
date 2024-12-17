<?php

namespace App\Http\Controllers;

use App\Models\PhongChieu;
use App\Http\Requests\StorePhongChieuRequest;
use App\Http\Requests\UpdatePhongChieuRequest;
use App\Models\Rap;
use App\Models\GheNgoi;
use Carbon\Carbon;

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

        return view(self::PATH_VIEW . 'quanlyGhe', compact(['phongChieu']));
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
    public function restore($id){
        $restore = PhongChieu::query()->onlyTrashed()->find($id);
        $restore->deleted_at = null;
        $restore->save();
        return back();
    }
    public function delete($id)
    {
        $curdate = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $phongchieu = PhongChieu::query()
        ->with([
            'suatChieu'=>function($query)use($curdate){
              $query->whereDate('ngay','>=',$curdate)
              ->withCount([
                'ves'
              ])
              ->having('ves_count','>',0);
            }
        ])
        ->find($id);
        if(count($phongchieu->suatChieu) > 0){
            return back()->with('error','Phòng chiếu này không thể xoá vì vẫn còn suất chiếu đã có khách hành mua vé');
        }
       $phongchieu->delete();
        return back();
    }
    public function forceDelete($id)
    {
        $phongchieu = PhongChieu::onlyTrashed()->findOrFail($id);
        $phongchieu->forceDelete();

        return back()->with('success', 'Xóa vĩnh viễn thành công!');
    }
    public function destroy(PhongChieu $phongChieu)
    {
        //
    }
}
