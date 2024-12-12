<?php

namespace App\Http\Controllers;

use App\Models\Rap;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRapRequest;
use App\Http\Requests\UpdateRapRequest;

class RapController extends Controller
{
    public function index()
    {
        $raps = Rap::orderBy('id', 'desc')->get(); 
        return view('admin.contents.raps.index', compact('raps')); 

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
    public function softDelete($id)
    {
        $rap =Rap::findOrFail($id);
        $rap->delete();
        return redirect()->route('rap.index')->with('success', 'Xóa mềm thành công!');
    }
    public function restore($id)
    {
        $rap =Rap::onlyTrashed()->findOrFail($id);
        $rap->restore();
        return redirect()->route('rap.listSoftDelete')->with('success', 'Khôi phục thành công!');
    }
    public function destroy(Rap $rap)
    {
        $rap->trang_thai = 0;
        $rap->save();
        return redirect()->route('rap.index')->with('success', 'Rạp đã được xóa thành công.');
    }
}
