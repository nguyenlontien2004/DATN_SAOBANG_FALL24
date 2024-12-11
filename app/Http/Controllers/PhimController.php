<?php

namespace App\Http\Controllers;

use App\Models\Phim;
use App\Models\DaoDien;
use App\Models\DienVien;
use App\Models\TheLoaiPhim;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePhimRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdatePhimRequest;
use App\Models\MaGiamGia;
use Illuminate\Support\Facades\DB;

class PhimController extends Controller
{
    public function index(Request $request)
    {
        $theLoaiId = $request->input('the_loai');
        $phims = Phim::with('daoDiens', 'dienViens', 'theLoaiPhims')
            ->when($theLoaiId, function ($query, $theLoaiId) {
                $query->whereHas('theLoaiPhims', function ($query) use ($theLoaiId) {
                    $query->where('id', $theLoaiId);
                });
            })
            ->orderBy('id', 'desc')
            ->get();
        $theLoaiPhims = TheLoaiPhim::where('trang_thai', 1)->get();

        return view('admin.contents.phims.index', compact('phims', 'theLoaiPhims', 'theLoaiId'));
    }

    public function show($id)
    {
        $phim = Phim::with('daoDiens', 'dienViens', 'theLoaiPhims')->findOrFail($id);
        return view('admin.contents.phims.show', compact('phim'));
    }
    public function create()
    {
        $daoDiens = DaoDien::where('trang_thai', 1)->get();
        $dienViens = DienVien::where('trang_thai', 1)->get();
        $theLoais = TheLoaiPhim::where('trang_thai', 1)->get();
        return view('admin.contents.phims.creater', compact('daoDiens', 'dienViens', 'theLoais'));
    }

    public function store(StorePhimRequest $request)
    {
       DB::beginTransaction();
       $path = $request->file('anh_phim')->store('anh_phim', 'public');
       $phim = Phim::create(array_merge($request->all(), ['anh_phim' => $path]));

       if ($request->has('dao_dien_ids')) {
           $phim->daoDiens()->attach($request->dao_dien_ids);
       }

       if ($request->has('dien_vien_ids')) {
           foreach ($request->dien_vien_ids as $index => $dienVienId) {
               $vaiTro = $request->input('vai_tro_dien_vien')[0] ?? null;
               $phim->dienViens()->attach($dienVienId, ['vai_tro_dien_vien' => $vaiTro]);
           }
       }

       if ($request->has('the_loai_phim_ids')) {
           $phim->theLoaiPhims()->attach($request->the_loai_phim_ids);
       }
       DB::commit();
       DB::rollBack();

        return redirect()->route('phim.index')->with('success', 'Phim đã được thêm thành công.');
    }
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $path = $request->file('upload')->storeAs('anh_phim', $fileName, 'public');
            $url = Storage::url($path);
            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }
    public function edit(Phim $phim)
    {
        $daoDiens = DaoDien::where('trang_thai', 1)->get();
        $dienViens = DienVien::where('trang_thai', 1)->get();
        $theLoaiPhims = TheLoaiPhim::where('trang_thai', 1)->get();
        return view('admin.contents.phims.edit', compact('phim', 'daoDiens', 'dienViens', 'theLoaiPhims'));
    }
    public function update(UpdatePhimRequest $request, Phim $phim)
    {
        if ($request->hasFile('anh_phim')) {
            if ($phim->anh_phim && file_exists(public_path('storage/' . $phim->anh_phim))) {
                unlink(public_path('storage/' . $phim->anh_phim));
            }
            $path = $request->file('anh_phim')->store('anh_phim', 'public');
            $phim->anh_phim = $path;
        }

        $phim->update($request->except('anh_phim')); // Không cập nhật ảnh phim từ request

        $phim->daoDiens()->sync($request->dao_dien_ids);


        $phim->dienViens()->detach();
        foreach ($request->dien_vien_ids as $index => $dienVienId) {
            $vaiTro = $request->input('vai_tro_dien_vien')[0] ?? null;
            $phim->dienViens()->attach($dienVienId, ['vai_tro_dien_vien' => $vaiTro]);
        }

        $phim->theLoaiPhims()->sync($request->the_loai_phim_ids);


        return redirect()->route('phim.index')->with('success', 'Phim đã được cập nhật thành công.');
    }


    // public function maGiamGia()
    // {
    //     return $this->hasMany(MaGiamGia::class);
    // }

    public function destroy(Phim $phim)
    {
        $phim->trang_thai = 0;
        $phim->save();
        return redirect()->route('phim.index')->with('success', 'Đạo Diễn đã được xóa thành công.');
    }
}