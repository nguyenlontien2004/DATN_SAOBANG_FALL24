<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'dashboard']);
});
// Route::resources('phims');
Route::resource('daoDien', App\Http\Controllers\DaoDienController::class);
Route::resource('phim', App\Http\Controllers\PhimController::class);
Route::resource('dienVien', App\Http\Controllers\DienVienController::class);

Route::resource('theLoaiPhim', App\Http\Controllers\TheLoaiPhimController::class);
Route::resource('rap', App\Http\Controllers\RapController::class);
Route::resource('suatChieu', App\Http\Controllers\SuatChieuController::class);