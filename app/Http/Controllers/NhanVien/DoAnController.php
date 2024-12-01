<?php

namespace App\Http\Controllers\NhanVien;

use App\Models\DoAn;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDoAnRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateDoAnRequest;

class DoAnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Danh sách món ăn";
        $listDoAn = DoAn::query()->orderByDesc('id')->paginate(5);
        return view('nhanVien.doans.index', compact('title', 'listDoAn'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Thêm món ăn";
        return view('nhanVien.doans.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDoAnRequest $request)
    {
        if ($request->isMethod('POST')) {
            // Lấy tất cả các tham số ngoại trừ _token
            $params = $request->except('_token');

            // Kiểm tra xem có hình ảnh được tải lên hay không
            if ($request->hasFile('hinh_anh')) {
                // Lưu trữ file hình ảnh vào thư mục 'uploads/doans' trong storage và trả về đường dẫn
                $filepath = $request->file('hinh_anh')->store('uploads/doans', 'public');
            } else {
                $filepath = null;
            }

            // Gán đường dẫn của hình ảnh vào mảng tham số
            $params['hinh_anh'] = $filepath;

            // Tạo bản ghi mới cho bảng 'DoAn' (tên bảng được giả định)
            DoAn::create($params);

            // Chuyển hướng về trang danh sách với thông báo thành công
            return redirect()->route('do-an.index')->with('success', 'Thêm dữ liệu thành công');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DoAn $doAn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Sửa thông tin món ăn";

        $doAn = DoAn::findOrFail($id);
        return view('nhanVien.doans.edit', compact('title', 'doAn'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDoAnRequest $request, string $id)
    {
        if ($request->isMethod('PUT')) {
            $params = $request->except('_token', '_method');

            $doAn = DoAn::findOrFail($id);

            if ($request->hasFile('hinh_anh')) {
                // Xóa ảnh cũ nếu có
                if ($doAn->hinh_anh && Storage::disk('public')->exists($doAn->hinh_anh)) {
                    Storage::disk('public')->delete($doAn->hinh_anh);
                }
                // Lưu ảnh mới
                $filepath = $request->file('hinh_anh')->store('uploads/doans', 'public');
            } else {
                // Giữ lại đường dẫn ảnh cũ nếu không có ảnh mới được tải lên
                $filepath = $doAn->hinh_anh;
            }

            // Cập nhật đường dẫn hình ảnh vào $params
            $params['hinh_anh'] = $filepath;

            // Cập nhật thông tin sản phẩm
            $doAn->update($params);

            return redirect()->route('do-an.index')->with('success', 'Cập nhật dữ liệu thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $doAn = DoAn::findOrFail($id);

        // Xóa sản phẩm
        $doAn->delete();

        // Kiểm tra và xóa hình ảnh nếu tồn tại
        if ($doAn->hinh_anh && Storage::disk('public')->exists($doAn->hinh_anh)) {
            Storage::disk('public')->delete($doAn->hinh_anh);
        }

        return redirect()->route('do-an.index')->with('success', 'Xóa dữ liệu thành công');
    }
}
