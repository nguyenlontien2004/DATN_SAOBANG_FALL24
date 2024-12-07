<?php

namespace App\Http\Controllers;

use App\Models\Rap;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRapRequest;
use App\Http\Requests\UpdateRapRequest;
use App\Models\PhongChieu;

class RapController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query('query');
        if ($query) {
            $raps = Rap::where('id', $query)->paginate(5);
        } else {
            $raps = Rap::orderBy('id', 'desc')->paginate(5);
        }
        return view('admin.contents.raps.index', compact('raps'));
    }
public function show($id)
{
    $rap = Rap::findOrFail($id);
    $phong_chieus = PhongChieu::where('rap_id', $id)->get();

    foreach ($phong_chieus as $phong) {
        $phong->current_suat_chieus = $phong->suatChieus()
            ->with('phim')
            ->whereRaw("
                TIMESTAMP(date, gio_bat_dau) <= ?
                AND TIMESTAMP(date, gio_ket_thuc) >= ?
            ", [now(), now()])
            ->get();
    }

    return view('admin.contents.raps.show', compact('rap', 'phong_chieus'));
}



    public function create()
    {
        return view('admin.contents.raps.creater');
    }
    public function store(StoreRapRequest $request)
    {
        Rap::create([
            'ten_rap' => $request->ten_rap,
            'dia_diem' => $request->dia_diem,
        ]);

        return redirect()->route('rap.index')->with('success', 'Rạp đã được tạo thành công.');
    }

    public function edit(Rap $rap)
    {
        return view('admin.contents.raps.edit', compact('rap'));
    }
    public function update(UpdateRapRequest $request, Rap $rap)
    {
        $rap->update([
            'ten_rap' => $request->ten_rap,
            'dia_diem' => $request->dia_diem,
            'trang_thai' => $request->trang_thai,
        ]);

        return redirect()->route('rap.index')->with('success', 'Rạp đã được cập nhật thành công.');
    }

    // public function destroy(Rap $rap)
    // {
    //     $rap->trang_thai = 0;
    //     $rap->save();
    //     return redirect()->route('rap.index')->with('success', 'Rạp đã được xóa thành công.');
    // }
    public function listSoftDelete()
    {
        $raps =Rap::onlyTrashed()->paginate(5);
        return view('admin.contents.raps.listSoftDelete', compact('raps'));
    }
    public function softDelete($id)
    {
        $rap =Rap::findOrFail($id);
        $rap->delete();
        return redirect()->route('rap.index')->with('success', 'Xóa mềm thành công!');
    }

    // Khôi phục
    public function restore($id)
    {
        $rap =Rap::onlyTrashed()->findOrFail($id);
        $rap->restore();
        return redirect()->route('rap.listSoftDelete')->with('success', 'Khôi phục thành công!');
    }
    public function forceDelete($id)
    {
        $rap =Rap::onlyTrashed()->findOrFail($id);
        $rap->forceDelete();
        return redirect()->route('rap.listSoftDelete')->with('success', 'Xóa vĩnh viễn thành công!');
    }
}
