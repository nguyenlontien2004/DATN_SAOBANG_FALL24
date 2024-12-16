<?php

namespace App\Http\Controllers\NhanVien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DaoDien;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreDaoDienRequest;
use App\Http\Requests\UpdateDaoDienRequest;
use App\Http\Requests\NhanvienDaoDienRequest;

class NhanVienDaoDienController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query('query');
        $daoDiens = DaoDien::query();
        if ($query) {
            $daoDiens->where(function ($q) use ($query) {
                $q->where('id', $query)
                    ->orWhere('ten_dao_dien', 'LIKE', '%' . $query . '%');
            });
        }
        $daoDiens = $daoDiens->orderBy('id', 'desc')->paginate(5);
        return view('nhanVien.daoDiens.index', compact('daoDiens'));
    }
    public function create()
    {
        return view('nhanVien.daoDiens.creater');
    } 
    public function show($id)
    {
        $daoDiens = DaoDien::findOrFail($id);
        return view('nhanVien.daoDiens.show', compact('daoDiens'));
    }
    public function store(StoreDaoDienRequest $request)
    {
        $path = $request->file('anh_dao_dien')->store('dao_dien', 'public');

        DaoDien::create([
            'ten_dao_dien' => $request->ten_dao_dien,
            'anh_dao_dien' => $path,
            'nam_sinh' => $request->nam_sinh,
            'quoc_tich' => $request->quoc_tich,
            'gioi_tinh' => $request->gioi_tinh,
            'tieu_su' => $request->tieu_su,
        ]);

        return redirect()->route('nhanviendaoDien.index')->with('success', 'Thêm mới Đạo diễn thành công!');
    }
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $path = $request->file('upload')->storeAs('dao_dien', $fileName, 'public');
            $url = Storage::url($path);
            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }
    public function edit(DaoDien $nhanviendaoDien)
    {
        $daoDien = $nhanviendaoDien;
        return view('nhanVien.daoDiens.edit', compact('daoDien'));
    }
    public function update(NhanvienDaoDienRequest $request, DaoDien $nhanviendaoDien)
    {
        $daoDien = $nhanviendaoDien;
        if ($request->hasFile('anh_dao_dien')) {
            $path = $request->file('anh_dao_dien')->store('dao_dien', 'public');
            $daoDien->anh_dao_dien = $path;
        }

        $daoDien->ten_dao_dien = $request->ten_dao_dien;
        $daoDien->nam_sinh = $request->nam_sinh;
        $daoDien->quoc_tich = $request->quoc_tich;
        $daoDien->gioi_tinh = $request->gioi_tinh;
        $daoDien->trang_thai = $request->trang_thai;
        $daoDien->tieu_su = $request->tieu_su;
        $daoDien->save();

        return redirect()->route('nhanviendaoDien.index')->with('success', 'Cập nhật Đạo diễn thành công!');
    }
    public function listSoftDelete()
    {
        $daoDiens = DaoDien::onlyTrashed()->paginate(5);

        // return view('admin.contents.daoDiens.listSoftDelete', compact('daoDiens'));
        return view('nhanVien.daoDiens.listSoftDelete',compact(['daoDiens']));
    }
    public function softDelete($id)
    {
        $daoDien = DaoDien::findOrFail($id);
        $daoDien->delete();
        return redirect()->route('nhanviendaoDien.index')->with('success', 'Xóa mềm thành công!');
    }

    // Khôi phục
    public function restore($id)
    {
        $daoDien = DaoDien::onlyTrashed()->findOrFail($id);
        $daoDien->restore();

        return redirect()->route('nhanVien.daoDien.listSoftDelete')->with('success', 'Khôi phục thành công!');
    }
    public function destroy(DaoDien $daoDien)
    {
        $daoDien->trang_thai = 0;
        $daoDien->save();
        return redirect()->route('nhanviendaoDien.index')->with('success', 'Đạo Diễn đã được xóa thành công.');
    }
}
