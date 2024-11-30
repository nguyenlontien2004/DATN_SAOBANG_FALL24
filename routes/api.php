<?php

use App\Http\Controllers\MaGiamGiaController;
use App\Models\SuatChieu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuatChieuController;
use App\Http\Controllers\API\DatVeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('add-ma-giam-gia', [MaGiamGiaController::class, 'store']);

Route::get('/phim/{phim_id}/dates', [SuatChieuController::class, 'getPhimDates']);
Route::get('suat-chieu/phim/{id}/{date}',                     [DatVeController::class, 'laySuatChieuTheoNgay']);
Route::post('ghe/suat-chieu/{id}/{ngay}',                     [DatVeController::class, 'idghe']);
Route::post('ma-giam-gia',                                    [DatVeController::class, 'magiamgia']);
Route::middleware('web')->post('post/thanh-toan/{id}/{ngay}',                    [DatVeController::class, 'chuyenquatrangthanhtoan']);
