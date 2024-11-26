<?php

namespace App\Http\Controllers;

use App\Models\DaoDien;
use App\Models\DienVien;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        // Tìm kiếm trong bảng daoDiens và dienViens
        $daoDiens = DaoDien::where('ten_dao_dien', 'like', '%'.$query.'%')->get();
        $dienViens = DienVien::where('ten_dien_vien', 'like', '%'.$query.'%')->get();
        
        // Kết hợp kết quả từ cả hai bảng
        $results = $daoDiens->merge($dienViens);
    
        // Trả kết quả về dưới dạng JSON
        return response()->json($results);
    }
}
